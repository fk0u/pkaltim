<template>
  <div class="login-page">
    <!-- Bagian Kiri: Visual/Gambar -->
    <div class="login-visual">
      <div class="visual-overlay"></div>
      <div class="visual-content">
        <div class="logo-badge">
          <i class="fi fi-rr-restaurant"></i>
        </div>
        <h1>PKaltim Kuliner</h1>
        <p>Jelajahi dan kelola ragam cita rasa khas Kalimantan Timur dalam satu panel admin yang terintegrasi.</p>
      </div>
    </div>

    <!-- Bagian Kanan: Formulir Login -->
    <div class="login-container">
      <div class="login-card">
        <div class="login-header">
          <h2>Admin Login</h2>
          <p>Masuk untuk mengelola artikel dan konten</p>
        </div>

        <form @submit.prevent="handleLogin" class="login-form">
          <div v-if="error" class="alert alert-error">
            <span class="icon">⚠️</span> {{ error }}
          </div>

          <div class="form-group">
            <label class="form-label">Username</label>
            <div class="input-wrapper">
              <input
                v-model="form.username"
                type="text"
                class="form-input"
                placeholder="Masukkan username"
                required
              />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrapper">
              <input
                v-model="form.password"
                type="password"
                class="form-input"
                placeholder="Masukkan password"
                required
              />
            </div>
          </div>

          <button type="submit" class="btn-submit" :disabled="loading">
            <span v-if="loading" class="spinner"></span>
            <span v-else>Masuk ke Dashboard</span>
          </button>
        </form>

        <div class="login-footer">
          <router-link to="/" class="text-link">
            <span class="arrow">←</span> Kembali ke Beranda
          </router-link>
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
        
        localStorage.setItem('token', access_token)
        const userResponse = await authService.getMe()
        localStorage.setItem('user', JSON.stringify(userResponse.data))
        
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
/* Root Styling & Variables Context */
:host {
  --primary-color: #e67e22;
  --primary-dark: #d35400;
  --text-main: #2c3e50;
  --text-muted: #c3d3d4;
  --bg-card: #ffffff;
  --border-radius: 12px;
  --transition: all 0.3s ease;
}

.login-page {
  min-height: 100vh;
  display: flex;
  font-family: 'Inter', sans-serif;
  background-color: #f8f9fa;
}

/* Section Kiri: Visual */
.login-visual {
  flex: 1;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4rem;
  background-image: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop'); /* Placeholder image kuliner */
  background-size: cover;
  background-position: center;
  color: white;
  overflow: hidden;
}

.visual-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(34, 112, 230, 0.9) 0%, rgba(0, 88, 135, 0.95) 100%);
  z-index: 1;
  
}

.visual-content {
  position: relative;
  z-index: 2;
  max-width: 500px;
  text-align: left;
}

.logo-badge {
  font-size: 3.5rem;
  margin-bottom: 1.5rem;
  background: rgba(255, 255, 255, 0.2);
  width: fit-content;
  padding: 0.5rem 1rem;
  border-radius: 16px;
  backdrop-filter: blur(5px);
}

.visual-content h1 {
  font-size: 3rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  line-height: 1.1;
}

.visual-content p {
  font-size: 1.1rem;
  line-height: 1.6;
  opacity: 0.9;
  color: #ffffff;
}

/* Section Kanan: Container */
.login-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  background-color: white;
}

.login-card {
  width: 100%;
  max-width: 420px;
  animation: fadeInRight 0.6s ease-out;
}

.login-header {
  margin-bottom: 2.5rem;
}

.login-header h2 {
  font-size: 2rem;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 0.5rem;
}

.login-header p {
  color: #666;
  font-size: 1rem;
}

/* Form Styles */
.login-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  font-weight: 600;
  font-size: 0.9rem;
  color: #444;
}

.form-input {
  width: 100%;
  padding: 0.8rem 1rem;
  border: 2px solid #edf2f7;
  border-radius: 8px;
  font-size: 1rem;
  transition: var(--transition);
  outline: none;
}

.form-input:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.1);
}

/* Button & UI Elements */
.btn-submit {
  background: #2563eb;
  color: white;
  border: none;
  padding: 1rem;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: var(--transition);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 1rem;
}

.btn-submit:hover:not(:disabled) {
  background: #2563eb;
  transform: translateY(-1px);
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.alert-error {
  background-color: #fff5f5;
  border-left: 4px solid #2563eb;
  color: #c53030;
  padding: 1rem;
  border-radius: 4px;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.login-footer {
  margin-top: 2.5rem;
  text-align: center;
  border-top: 1px solid #f1f1f1;
  padding-top: 1.5rem;
}

.text-link {
  color: #2563eb;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.text-link:hover .arrow {
  transform: translateX(-4px);
}

.arrow {
  transition: transform 0.2s;
}

/* Loading Spinner */
.spinner {
  width: 20px;
  height: 20px;
  border: 2px solid rgba(255,255,255,0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

@keyframes fadeInRight {
  from { opacity: 0; transform: translateX(20px); }
  to { opacity: 1; transform: translateX(0); }
}

/* Responsivitas */
@media (max-width: 1024px) {
  .login-visual {
    padding: 2.5rem;
  }
  .visual-content h1 {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .login-page {
    flex-direction: column;
  }
  .login-visual {
    display: none; /* Sembunyikan visual di mobile untuk fokus ke form */
  }
  .login-container {
    padding: 3rem 1.5rem;
  }
}
</style>