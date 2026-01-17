from sqlalchemy import Column, Integer, String, Text, DateTime, ForeignKey, Boolean
from sqlalchemy.orm import relationship
from sqlalchemy.sql import func
from .database import Base


class User(Base):
    """Model untuk admin user"""
    __tablename__ = "users"
    
    id = Column(Integer, primary_key=True, index=True)
    username = Column(String(50), unique=True, index=True, nullable=False)
    email = Column(String(100), unique=True, index=True, nullable=False)
    hashed_password = Column(String(255), nullable=False)
    is_active = Column(Boolean, default=True)
    created_at = Column(DateTime(timezone=True), server_default=func.now())
    updated_at = Column(DateTime(timezone=True), onupdate=func.now())


class Category(Base):
    """Model untuk kategori artikel kuliner"""
    __tablename__ = "categories"
    
    id = Column(Integer, primary_key=True, index=True)
    name = Column(String(100), unique=True, nullable=False)
    description = Column(Text, nullable=True)
    created_at = Column(DateTime(timezone=True), server_default=func.now())
    
    # Relationship
    articles = relationship("Article", back_populates="category")


class Article(Base):
    """Model untuk artikel wisata kuliner"""
    __tablename__ = "articles"
    
    id = Column(Integer, primary_key=True, index=True)
    title = Column(String(200), nullable=False)
    slug = Column(String(200), unique=True, index=True, nullable=False)
    content = Column(Text, nullable=False)
    excerpt = Column(Text, nullable=True)
    featured_image = Column(String(255), nullable=True)
    category_id = Column(Integer, ForeignKey("categories.id"), nullable=False)
    author_id = Column(Integer, ForeignKey("users.id"), nullable=False)
    is_published = Column(Boolean, default=True)
    views = Column(Integer, default=0)
    created_at = Column(DateTime(timezone=True), server_default=func.now())
    updated_at = Column(DateTime(timezone=True), onupdate=func.now())
    
    # Relationships
    category = relationship("Category", back_populates="articles")
    author = relationship("User")
    images = relationship("ArticleImage", back_populates="article", cascade="all, delete-orphan")


class ArticleImage(Base):
    """Model untuk gambar artikel (multiple images per article)"""
    __tablename__ = "article_images"
    
    id = Column(Integer, primary_key=True, index=True)
    article_id = Column(Integer, ForeignKey("articles.id"), nullable=False)
    image_path = Column(String(255), nullable=False)
    alt_text = Column(String(200), nullable=True)
    display_order = Column(Integer, default=0)
    created_at = Column(DateTime(timezone=True), server_default=func.now())
    
    # Relationship
    article = relationship("Article", back_populates="images")
