import api from './axios'

export const articleService = {
  // Get all articles (public)
  getAll(skip = 0, limit = 10, categoryId = null) {
    const params = { skip, limit }
    if (categoryId) params.category_id = categoryId
    return api.get('/articles/', { params })
  },

  // Get all articles (admin)
  getAllAdmin(skip = 0, limit = 10) {
    return api.get('/articles/admin', { params: { skip, limit } })
  },

  // Get article by ID
  getById(id) {
    return api.get(`/articles/${id}`)
  },

  // Get article by slug
  getBySlug(slug) {
    return api.get(`/articles/slug/${slug}`)
  },

  // Create article
  create(formData) {
    return api.post('/articles/', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  // Update article
  update(id, formData) {
    return api.put(`/articles/${id}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  // Delete article
  delete(id) {
    return api.delete(`/articles/${id}`)
  },

  // Add image to article
  addImage(articleId, imageFile, altText = null, displayOrder = 0) {
    const formData = new FormData()
    formData.append('image', imageFile)
    if (altText) formData.append('alt_text', altText)
    formData.append('display_order', displayOrder)
    
    return api.post(`/articles/${articleId}/images`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  // Delete article image
  deleteImage(imageId) {
    return api.delete(`/articles/images/${imageId}`)
  }
}
