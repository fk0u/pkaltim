<template>
  <div class="admin-layout">
    <aside class="admin-sidebar">
      <div class="sidebar-header">
        <h2> Admin Panel</h2>
      </div>
      <nav class="sidebar-nav">
        <router-link to="/admin" class="nav-item" active-class="active">
           Dashboard
        </router-link>
        <router-link to="/admin/articles" class="nav-item" active-class="active">
           Artikel
        </router-link>
        <router-link to="/admin/categories" class="nav-item" active-class="active">
           Kategori
        </router-link>
        <router-link to="/" class="nav-item">
           Kembali ke Website
        </router-link>
        <button @click="handleLogout" class="nav-item nav-item-button">
          🔙 Logout
        </button>
      </nav>
    </aside>
    <main class="admin-main">
      <div class="admin-header">
        <h1>{{ title }}</h1>
        <div class="admin-user">
          <span>{{ user?.username }}</span>
        </div>
      </div>
      <div class="admin-content">
        <slot />
      </div>
    </main>
  </div>
</template>

<script>
export default {
  name: 'AdminLayout',
  props: {
    title: {
      type: String,
      default: 'Admin'
    }
  },
  data() {
    return {
      user: null
    }
  },
  mounted() {
    const userStr = localStorage.getItem('user')
    if (userStr) {
      this.user = JSON.parse(userStr)
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
.admin-layout {
  display: flex;
  min-height: 100vh;
  background: var(--bg-secondary);
}

.admin-sidebar {
  width: 250px;
  background: var(--bg-primary);
  box-shadow: var(--shadow-md);
  display: flex;
  flex-direction: column;
  position: fixed;
  height: 100vh;
  overflow-y: auto;
}

.sidebar-header {
  padding: 1.5rem;
  border-bottom: 2px solid var(--border-color);
}

.sidebar-header h2 {
  margin: 0;
  font-size: 1.25rem;
}

.sidebar-nav {
  padding: 1rem 0;
  flex: 1;
}

.nav-item {
  display: block;
  padding: 1rem 1.5rem;
  color: var(--text-secondary);
  text-decoration: none;
  transition: var(--transition);
  border-left: 3px solid transparent;
}

.nav-item:hover,
.nav-item.active {
  background: var(--bg-secondary);
  color: var(--primary-color);
  border-left-color: var(--primary-color);
}

.nav-item-button {
  width: 100%;
  background: none;
  border: none;
  text-align: left;
  cursor: pointer;
  font-size: 1rem;
}

.admin-main {
  flex: 1;
  margin-left: 250px;
  display: flex;
  flex-direction: column;
}

.admin-header {
  background: var(--bg-primary);
  padding: 1.5rem 2rem;
  box-shadow: var(--shadow-sm);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.admin-header h1 {
  margin: 0;
  font-size: 1.75rem;
}

.admin-user {
  color: var(--text-secondary);
  font-weight: 500;
}

.admin-content {
  flex: 1;
  padding: 2rem;
}

@media (max-width: 768px) {
  .admin-sidebar {
    width: 200px;
  }
  
  .admin-main {
    margin-left: 200px;
  }
  
  .admin-content {
    padding: 1rem;
  }
}
</style>
