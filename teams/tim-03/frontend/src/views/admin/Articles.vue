<template>
  <div>
    <AdminLayout title="Kelola Artikel">
      <div class="admin-articles">
        <div class="page-header">
          <router-link to="/admin/articles/create" class="btn btn-primary">
            + Buat Artikel Baru
          </router-link>
        </div>

        <div v-if="loading" class="loading">
          <div class="spinner"></div>
        </div>

        <div v-else-if="articles.length > 0" class="articles-table">
          <table>
            <thead>
              <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Views</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="article in articles" :key="article.id">
                <td>
                  <strong>{{ article.title }}</strong>
                </td>
                <td>{{ article.category.name }}</td>
                <td>
                  <span :class="['badge', article.is_published ? 'badge-success' : 'badge-warning']">
                    {{ article.is_published ? 'Published' : 'Draft' }}
                  </span>
                </td>
                <td>{{ article.views }}</td>
                <td>{{ formatDate(article.created_at) }}</td>
                <td>
                  <div class="action-buttons">
                    <router-link :to="`/admin/articles/edit/${article.id}`" class="btn btn-sm btn-secondary">
                      Edit
                    </router-link>
                    <button @click="handleDelete(article)" class="btn btn-sm btn-danger">
                      Hapus
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-else class="empty-state">
          <p>Belum ada artikel. <router-link to="/admin/articles/create">Buat artikel pertama</router-link></p>
        </div>
      </div>
    </AdminLayout>
  </div>
</template>

<script>
import AdminLayout from '../../components/admin/AdminLayout.vue'
import { articleService } from '../../api/articles'

export default {
  name: 'AdminArticles',
  components: {
    AdminLayout
  },
  data() {
    return {
      articles: [],
      loading: true
    }
  },
  async mounted() {
    await this.loadArticles()
  },
  methods: {
    async loadArticles() {
      this.loading = true
      try {
        const response = await articleService.getAllAdmin(0, 1000)
        this.articles = response.data
      } catch (error) {
        console.error('Error loading articles:', error)
      } finally {
        this.loading = false
      }
    },
    async handleDelete(article) {
      if (!confirm(`Apakah Anda yakin ingin menghapus artikel "${article.title}"?`)) {
        return
      }
      
      try {
        await articleService.delete(article.id)
        await this.loadArticles()
      } catch (error) {
        alert('Error menghapus artikel')
        console.error(error)
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
.admin-articles {
  padding: 0;
}

.page-header {
  margin-bottom: 2rem;
}

.articles-table {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-md);
  overflow: hidden;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: var(--bg-secondary);
}

th {
  padding: 1rem;
  text-align: left;
  font-weight: 600;
  color: var(--text-primary);
  border-bottom: 2px solid var(--border-color);
}

td {
  padding: 1rem;
  border-bottom: 1px solid var(--border-color);
}

tbody tr:hover {
  background: var(--bg-secondary);
}

.action-buttons {
  display: flex;
  gap: 0.5rem;
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

.empty-state {
  text-align: center;
  padding: 3rem;
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-md);
}

@media (max-width: 768px) {
  .articles-table {
    overflow-x: auto;
  }
  
  table {
    min-width: 800px;
  }
}
</style>
