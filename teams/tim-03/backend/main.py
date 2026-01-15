from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from .database import Base, engine
from .routes import auth, articles, categories
import os

# Create database tables
Base.metadata.create_all(bind=engine)

app = FastAPI(
    title="PKaltim Kuliner API",
    description="API untuk Website Artikel Wisata Kuliner Kalimantan Timur",
    version="1.0.0"
)

# CORS middleware
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost:5173", "http://localhost:3000"],  # Vue dev server
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Mount static files for uploaded images
if os.path.exists("uploads"):
    app.mount("/uploads", StaticFiles(directory="uploads"), name="uploads")

# Include routers
app.include_router(auth.router)
app.include_router(articles.router)
app.include_router(categories.router)


@app.get("/")
async def root():
    return {
        "message": "PKaltim Kuliner API",
        "version": "1.0.0",
        "docs": "/docs"
    }


@app.get("/api/health")
async def health_check():
    return {"status": "healthy"}
