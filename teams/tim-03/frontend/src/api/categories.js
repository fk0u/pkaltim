import api from './axios'

export const categoryService = {
  // Get all categories
  getAll() {
    return api.get('/categories/')
  },

  // Get category by ID
  getById(id) {
    return api.get(`/categories/${id}`)
  },

  // Create category
  create(data) {
    return api.post('/categories/', data)
  },

  // Update category
  update(id, data) {
    return api.put(`/categories/${id}`, data)
  },

  // Delete category
  delete(id) {
    return api.delete(`/categories/${id}`)
  }
}
