import api from './axios'

export const authService = {
  // Login
  login(username, password) {
    const formData = new FormData()
    formData.append('username', username)
    formData.append('password', password)
    
    return api.post('/auth/login', formData, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    })
  },

  // Get current user
  getMe() {
    return api.get('/auth/me')
  },

  // Register (for initial setup)
  register(data) {
    return api.post('/auth/register', data)
  }
}
