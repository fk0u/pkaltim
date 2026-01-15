from fastapi import APIRouter, Depends, HTTPException, status, UploadFile, File, Form
from sqlalchemy.orm import Session
from typing import List, Optional
from ..database import get_db
from ..models import Article, Category, ArticleImage, User
from ..schemas import ArticleCreate, ArticleUpdate, ArticleResponse, CategoryResponse
from ..auth import get_current_user
from sqlalchemy import func
import os
import uuid
from pathlib import Path
from PIL import Image
import shutil

router = APIRouter(prefix="/api/articles", tags=["Articles"])

# Setup upload directory
UPLOAD_DIR = Path("uploads/images")
UPLOAD_DIR.mkdir(parents=True, exist_ok=True)


def generate_slug(title: str) -> str:
    """Generate slug from title"""
    import re
    slug = re.sub(r'[^\w\s-]', '', title.lower())
    slug = re.sub(r'[-\s]+', '-', slug)
    return slug.strip('-')


def save_image(file: UploadFile) -> str:
    """Save uploaded image and return path"""
    # Generate unique filename
    file_ext = Path(file.filename).suffix
    unique_filename = f"{uuid.uuid4()}{file_ext}"
    file_path = UPLOAD_DIR / unique_filename
    
    # Save file
    with open(file_path, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)
    
    # Resize image if needed (optional optimization)
    try:
        img = Image.open(file_path)
        if img.width > 1920:
            img.thumbnail((1920, 1920), Image.Resampling.LANCZOS)
            img.save(file_path, optimize=True, quality=85)
    except Exception:
        pass
    
    return f"uploads/images/{unique_filename}"


@router.get("/", response_model=List[ArticleResponse])
async def get_articles(
    skip: int = 0,
    limit: int = 10,
    category_id: Optional[int] = None,
    published_only: bool = True,
    db: Session = Depends(get_db)
):
    """Get all articles (public)"""
    query = db.query(Article)
    
    if published_only:
        query = query.filter(Article.is_published == True)
    
    if category_id:
        query = query.filter(Article.category_id == category_id)
    
    articles = query.order_by(Article.created_at.desc()).offset(skip).limit(limit).all()
    return articles


@router.get("/admin", response_model=List[ArticleResponse])
async def get_articles_admin(
    skip: int = 0,
    limit: int = 10,
    db: Session = Depends(get_db),
    current_user: User = Depends(get_current_user)
):
    """Get all articles (admin - includes unpublished)"""
    articles = db.query(Article).order_by(Article.created_at.desc()).offset(skip).limit(limit).all()
    return articles


@router.get("/{article_id}", response_model=ArticleResponse)
async def get_article(article_id: int, db: Session = Depends(get_db)):
    """Get single article by ID"""
    article = db.query(Article).filter(Article.id == article_id).first()
    if not article:
        raise HTTPException(status_code=404, detail="Article not found")
    
    # Increment views
    article.views += 1
    db.commit()
    db.refresh(article)
    
    return article


@router.get("/slug/{slug}", response_model=ArticleResponse)
async def get_article_by_slug(slug: str, db: Session = Depends(get_db)):
    """Get article by slug"""
    article = db.query(Article).filter(Article.slug == slug).first()
    if not article:
        raise HTTPException(status_code=404, detail="Article not found")
    
    # Increment views
    article.views += 1
    db.commit()
    db.refresh(article)
    
    return article


@router.post("/", response_model=ArticleResponse)
async def create_article(
    title: str = Form(...),
    content: str = Form(...),
    excerpt: Optional[str] = Form(None),
    category_id: int = Form(...),
    is_published: bool = Form(True),
    featured_image: Optional[UploadFile] = File(None),
    db: Session = Depends(get_db),
    current_user: User = Depends(get_current_user)
):
    """Create new article"""
    # Check category exists
    category = db.query(Category).filter(Category.id == category_id).first()
    if not category:
        raise HTTPException(status_code=404, detail="Category not found")
    
    # Generate slug
    slug = generate_slug(title)
    
    # Check if slug exists
    existing = db.query(Article).filter(Article.slug == slug).first()
    if existing:
        slug = f"{slug}-{uuid.uuid4().hex[:8]}"
    
    # Save featured image if provided
    featured_image_path = None
    if featured_image:
        featured_image_path = save_image(featured_image)
    
    # Create article
    article = Article(
        title=title,
        slug=slug,
        content=content,
        excerpt=excerpt,
        category_id=category_id,
        author_id=current_user.id,
        is_published=is_published,
        featured_image=featured_image_path
    )
    
    db.add(article)
    db.commit()
    db.refresh(article)
    return article


@router.put("/{article_id}", response_model=ArticleResponse)
async def update_article(
    article_id: int,
    title: Optional[str] = Form(None),
    content: Optional[str] = Form(None),
    excerpt: Optional[str] = Form(None),
    category_id: Optional[int] = Form(None),
    is_published: Optional[bool] = Form(None),
    featured_image: Optional[UploadFile] = File(None),
    db: Session = Depends(get_db),
    current_user: User = Depends(get_current_user)
):
    """Update article"""
    article = db.query(Article).filter(Article.id == article_id).first()
    if not article:
        raise HTTPException(status_code=404, detail="Article not found")
    
    # Update fields
    if title is not None:
        article.title = title
        article.slug = generate_slug(title)
    if content is not None:
        article.content = content
    if excerpt is not None:
        article.excerpt = excerpt
    if category_id is not None:
        category = db.query(Category).filter(Category.id == category_id).first()
        if not category:
            raise HTTPException(status_code=404, detail="Category not found")
        article.category_id = category_id
    if is_published is not None:
        article.is_published = is_published
    
    # Update featured image if provided
    if featured_image:
        # Delete old image if exists
        if article.featured_image and os.path.exists(article.featured_image):
            os.remove(article.featured_image)
        article.featured_image = save_image(featured_image)
    
    db.commit()
    db.refresh(article)
    return article


@router.delete("/{article_id}")
async def delete_article(
    article_id: int,
    db: Session = Depends(get_db),
    current_user: User = Depends(get_current_user)
):
    """Delete article"""
    article = db.query(Article).filter(Article.id == article_id).first()
    if not article:
        raise HTTPException(status_code=404, detail="Article not found")
    
    # Delete images
    for img in article.images:
        if os.path.exists(img.image_path):
            os.remove(img.image_path)
    
    # Delete featured image
    if article.featured_image and os.path.exists(article.featured_image):
        os.remove(article.featured_image)
    
    db.delete(article)
    db.commit()
    return {"message": "Article deleted successfully"}


@router.post("/{article_id}/images", response_model=ArticleResponse)
async def add_article_image(
    article_id: int,
    image: UploadFile = File(...),
    alt_text: Optional[str] = Form(None),
    display_order: int = Form(0),
    db: Session = Depends(get_db),
    current_user: User = Depends(get_current_user)
):
    """Add image to article"""
    article = db.query(Article).filter(Article.id == article_id).first()
    if not article:
        raise HTTPException(status_code=404, detail="Article not found")
    
    image_path = save_image(image)
    
    article_image = ArticleImage(
        article_id=article_id,
        image_path=image_path,
        alt_text=alt_text,
        display_order=display_order
    )
    
    db.add(article_image)
    db.commit()
    db.refresh(article_image)
    return article_image


@router.delete("/images/{image_id}")
async def delete_article_image(
    image_id: int,
    db: Session = Depends(get_db),
    current_user: User = Depends(get_current_user)
):
    """Delete article image"""
    article_image = db.query(ArticleImage).filter(ArticleImage.id == image_id).first()
    if not article_image:
        raise HTTPException(status_code=404, detail="Image not found")
    
    # Delete file
    if os.path.exists(article_image.image_path):
        os.remove(article_image.image_path)
    
    db.delete(article_image)
    db.commit()
    return {"message": "Image deleted successfully"}
