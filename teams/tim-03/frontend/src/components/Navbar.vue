<template>
  <nav class="navbar">
    <div class="container">
      <div class="navbar-content">
        <router-link to="/" class="navbar-brand">
          <h2>
            <i class="fi fi-rr-restaurant"></i>
            Kaltim Kuliner
          </h2>
        </router-link>
        <div class="navbar-menu">
          <router-link to="/" class="navbar-link">Beranda</router-link>
          <router-link to="/articles" class="navbar-link">Artikel</router-link>
          <template v-if="isAuthenticated">
            <router-link to="/admin" class="navbar-link">Admin</router-link>
            <button @click="handleLogout" class="btn btn-sm btn-secondary">Logout</button>
          </template>
          <router-link v-else to="/login" class="btn btn-sm btn-primary">Login</router-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  computed: {
    isAuthenticated() {
      return !!localStorage.getItem('token')
    }
  },
  methods: {
    handleLogout() {
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      this.$router.push('/login')
    }
  }
}
</script>

<style scoped>
.navbar {
  background-color: var(--bg-primary);
  box-shadow: var(--shadow-md);
  padding: 1rem 0;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.navbar-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar-brand {
  text-decoration: none;
  color: var(--text-primary);
}

.navbar-brand h2 {
  margin: 0;
  font-size: 1.5rem;
}

.navbar-menu {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.navbar-link {
  text-decoration: none;
  color: var(--text-secondary);
  font-weight: 500;
  transition: var(--transition);
  padding: 0.5rem 0;
}

.navbar-link:hover,
.navbar-link.router-link-active {
  color: var(--primary-color);
}

@media (max-width: 768px) {
  .navbar-content {
    flex-direction: column;
    gap: 1rem;
  }
  
  .navbar-menu {
    flex-wrap: wrap;
    justify-content: center;
  }
}
</style>
