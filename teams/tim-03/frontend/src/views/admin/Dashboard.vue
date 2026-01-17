<template>
  <div>
    <AdminLayout>
      <div class="dashboard">
        <h1>Dashboard Admin</h1>
        
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon">📝</div>
            <div class="stat-content">
              <h3>{{ stats.totalArticles }}</h3>
              <p>Total Artikel</p>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">📂</div>
            <div class="stat-content">
              <h3>{{ stats.totalCategories }}</h3>
              <p>Kategori</p>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">👁️</div>
            <div class="stat-content">
              <h3>{{ stats.totalViews }}</h3>
              <p>Total Views</p>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-content">
              <h3>{{ stats.publishedArticles }}</h3>
              <p>Artikel Published</p>
            </div>
          </div>
        </div>

        <div class="dashboard-actions">
          <router-link to="/admin/articles/create" class="btn btn-primary btn-lg">
            + Buat Artikel Baru
          </router-link>
          <router-link to="/admin/articles" class="btn btn-secondary btn-lg">
            Kelola Artikel
          </router-link>
          <router-link to="/admin/categories" class="btn btn-secondary btn-lg">
            Kelola Kategori
          </router-link>
        </div>

        <div class="recent-articles mt-4">
          <h2>Artikel Terbaru</h2>
          <div v-if="loading" class="loading">
            <div class="spinner"></div>
          </div>
          <div v-else-if="recentArticles.length > 0" class="articles-list">
            <div
              v-for="article in recentArticles"
              :key="article.id"
              class="article-item"
            >
              <div class="article-info">
                <h3>{{ article.title }}</h3>
                <p class="article-meta">
                  {{ article.category.name }} • {{ formatDate(article.created_at) }}
                </p>
              </div>
              <div class="article-actions">
                <span :class="['badge', article.is_published ? 'badge-success' : 'badge-warning']">
                  {{ article.is_published ? 'Published' : 'Draft' }}
                </span>
                <router-link :to="`/admin/articles/edit/${article.id}`" class="btn btn-sm btn-secondary">
                  Edit
                </router-link>
              </div>
            </div>
          </div>
          <div v-else>
            <p>Belum ada artikel.</p>
          </div>
        </div>
      </div>
    </AdminLayout>
  </div>
</template>

<script>
import AdminLayout from '../../components/admin/AdminLayout.vue'
import { articleService } from '../../api/articles'
import { categoryService } from '../../api/categories'

export default {
  name: 'AdminDashboard',
  components: {
    AdminLayout
  },
  data() {
    return {
      stats: {
        totalArticles: 0,
        totalCategories: 0,
        totalViews: 0,
        publishedArticles: 0
      },
      recentArticles: [],
      loading: true
    }
  },
  async mounted() {
    await this.loadStats()
    await this.loadRecentArticles()
  },
  methods: {
    async loadStats() {
      try {
        const [articlesRes, categoriesRes] = await Promise.all([
          articleService.getAllAdmin(0, 1000),
          categoryService.getAll()
        ])
        
        const articles = articlesRes.data
        this.stats.totalArticles = articles.length
        this.stats.totalCategories = categoriesRes.data.length
        this.stats.totalViews = articles.reduce((sum, a) => sum + a.views, 0)
        this.stats.publishedArticles = articles.filter(a => a.is_published).length
      } catch (error) {
        console.error('Error loading stats:', error)
      }
    },
    async loadRecentArticles() {
      try {
        const response = await articleService.getAllAdmin(0, 5)
        this.recentArticles = response.data
      } catch (error) {
        console.error('Error loading recent articles:', error)
      } finally {
        this.loading = false
      }
    },
    formatDate(dateString) {
      const date = new Date(dateString)
      return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      })
    }
  }
}
</script>

<style scoped>
.dashboard {
  padding: 2rem 0;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  padding: 1.5rem;
  box-shadow: var(--shadow-md);
  display: flex;
  align-items: center;
  gap: 1rem;
}

.stat-icon {
  font-size: 2.5rem;
}

.stat-content h3 {
  font-size: 2rem;
  margin-bottom: 0.25rem;
  color: var(--primary-color);
}

.stat-content p {
  margin: 0;
  color: var(--text-secondary);
  font-size: 0.9rem;
}

.dashboard-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 3rem;
}

.recent-articles {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  padding: 2rem;
  box-shadow: var(--shadow-md);
}

.articles-list {
  margin-top: 1.5rem;
}

.article-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid var(--border-color);
}

.article-item:last-child {
  border-bottom: none;
}

.article-info h3 {
  font-size: 1.125rem;
  margin-bottom: 0.5rem;
}

.article-meta {
  font-size: 0.875rem;
  color: var(--text-light);
  margin: 0;
}

.article-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.badge {
  padding: 0.25rem 0.75rem;
  border-radius: 1rem;
  font-size: 0.75rem;
  font-weight: 600;
}

.badge-success {
  background: #d1fae5;
  color: #065f46;
}

.badge-warning {
  background: #fef3c7;
  color: #92400e;
}

@media (max-width: 768px) {
  .article-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }
  
  .article-actions {
    width: 100%;
    justify-content: space-between;
  }
}
</style>
