from pydantic import BaseModel, EmailStr
from typing import Optional, List
from datetime import datetime


# User Schemas
class UserBase(BaseModel):
    username: str
    email: EmailStr


class UserCreate(UserBase):
    password: str


class UserResponse(UserBase):
    id: int
    is_active: bool
    created_at: datetime
    
    class Config:
        from_attributes = True


# Category Schemas
class CategoryBase(BaseModel):
    name: str
    description: Optional[str] = None


class CategoryCreate(CategoryBase):
    pass


class CategoryResponse(CategoryBase):
    id: int
    created_at: datetime
    
    class Config:
        from_attributes = True


# Article Image Schemas
class ArticleImageBase(BaseModel):
    image_path: str
    alt_text: Optional[str] = None
    display_order: int = 0


class ArticleImageResponse(ArticleImageBase):
    id: int
    article_id: int
    created_at: datetime
    
    class Config:
        from_attributes = True


# Article Schemas
class ArticleBase(BaseModel):
    title: str
    content: str
    excerpt: Optional[str] = None
    category_id: int
    is_published: bool = True


class ArticleCreate(ArticleBase):
    pass


class ArticleUpdate(BaseModel):
    title: Optional[str] = None
    content: Optional[str] = None
    excerpt: Optional[str] = None
    category_id: Optional[int] = None
    is_published: Optional[bool] = None


class ArticleResponse(ArticleBase):
    id: int
    slug: str
    featured_image: Optional[str] = None
    author_id: int
    views: int
    created_at: datetime
    updated_at: Optional[datetime] = None
    category: CategoryResponse
    images: List[ArticleImageResponse] = []
    
    class Config:
        from_attributes = True


# Auth Schemas
class Token(BaseModel):
    access_token: str
    token_type: str


class TokenData(BaseModel):
    username: Optional[str] = None
