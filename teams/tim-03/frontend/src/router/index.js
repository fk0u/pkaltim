import { createRouter, createWebHistory } from 'vue-router'
import { authService } from '../api/auth'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue')
  },
  {
    path: '/articles',
    name: 'Articles',
    component: () => import('../views/Articles.vue')
  },
  {
    path: '/article/:slug',
    name: 'ArticleDetail',
    component: () => import('../views/ArticleDetail.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue'),
    meta: { requiresGuest: true }
  },
  {
    path: '/admin',
    name: 'AdminDashboard',
    component: () => import('../views/admin/Dashboard.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/articles',
    name: 'AdminArticles',
    component: () => import('../views/admin/Articles.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/articles/create',
    name: 'AdminArticleCreate',
    component: () => import('../views/admin/ArticleForm.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/articles/edit/:id',
    name: 'AdminArticleEdit',
    component: () => import('../views/admin/ArticleForm.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/admin/categories',
    name: 'AdminCategories',
    component: () => import('../views/admin/Categories.vue'),
    meta: { requiresAuth: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Navigation guard
router.beforeEach(async (to, from, next) => {
  const token = localStorage.getItem('token')
  
  if (to.meta.requiresAuth) {
    if (!token) {
      next({ name: 'Login', query: { redirect: to.fullPath } })
      return
    }
    
    // Verify token is still valid
    try {
      await authService.getMe()
      next()
    } catch (error) {
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      next({ name: 'Login', query: { redirect: to.fullPath } })
    }
  } else if (to.meta.requiresGuest && token) {
    next({ name: 'AdminDashboard' })
  } else {
    next()
  }
})

export default router
