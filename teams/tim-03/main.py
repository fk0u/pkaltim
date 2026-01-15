"""
Main entry point untuk menjalankan FastAPI backend

Cara menjalankan:
1. Dari root project: uvicorn backend.main:app --reload
2. Atau: python main.py
"""
import sys
import os
from pathlib import Path

# Add backend directory to Python path
backend_dir = Path(__file__).parent / "backend"
sys.path.insert(0, str(backend_dir))

import uvicorn

if __name__ == "__main__":
    # Change to backend directory for relative imports
    os.chdir(backend_dir)
    uvicorn.run("main:app", host="0.0.0.0", port=8000, reload=True)
