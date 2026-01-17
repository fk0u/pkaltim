<template>
  <div class="login-page">
    <div class="login-container">
      <div class="login-card">
        <div class="login-header">
          <h1>🍜 PKaltim Kuliner</h1>
          <h2>Admin Login</h2>
          <p>Masuk untuk mengelola artikel</p>
        </div>

        <form @submit.prevent="handleLogin" class="login-form">
          <div v-if="error" class="alert alert-error">
            {{ error }}
          </div>

          <div class="form-group">
            <label class="form-label">Username</label>
            <input
              v-model="form.username"
              type="text"
              class="form-input"
              placeholder="Masukkan username"
              required
            />
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input
              v-model="form.password"
              type="password"
              class="form-input"
              placeholder="Masukkan password"
              required
            />
          </div>

          <button type="submit" class="btn btn-primary btn-lg" :disabled="loading">
            <span v-if="loading" class="spinner" style="width: 20px; height: 20px; border-width: 2px;"></span>
            <span v-else>Masuk</span>
          </button>
        </form>

        <div class="login-footer">
          <router-link to="/" class="text-link">← Kembali ke Beranda</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { authService } from '../api/auth'

export default {
  name: 'Login',
  data() {
    return {
      form: {
        username: '',
        password: ''
      },
      loading: false,
      error: ''
    }
  },
  methods: {
    async handleLogin() {
      this.loading = true
      this.error = ''
      
      try {
        const response = await authService.login(this.form.username, this.form.password)
        const { access_token } = response.data
        
        // Get user info
        localStorage.setItem('token', access_token)
        const userResponse = await authService.getMe()
        localStorage.setItem('user', JSON.stringify(userResponse.data))
        
        // Redirect
        const redirect = this.$route.query.redirect || '/admin'
        this.$router.push(redirect)
      } catch (error) {
        this.error = error.response?.data?.detail || 'Username atau password salah'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.login-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
  padding: 2rem;
}

.login-container {
  width: 100%;
  max-width: 450px;
}

.login-card {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-xl);
  padding: 3rem;
}

.login-header {
  text-align: center;
  margin-bottom: 2rem;
}

.login-header h1 {
  font-size: 2rem;
  margin-bottom: 0.5rem;
}

.login-header h2 {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

.login-header p {
  color: var(--text-secondary);
  margin-bottom: 0;
}

.login-form {
  margin-bottom: 1.5rem;
}

.login-footer {
  text-align: center;
  padding-top: 1.5rem;
  border-top: 1px solid var(--border-color);
}

.text-link {
  color: var(--primary-color);
  text-decoration: none;
  font-weight: 500;
  transition: var(--transition);
}

.text-link:hover {
  text-decoration: underline;
}

@media (max-width: 768px) {
  .login-card {
    padding: 2rem;
  }
}
</style>
