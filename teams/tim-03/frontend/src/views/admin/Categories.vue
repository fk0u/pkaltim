<template>
  <div>
    <AdminLayout title="Kelola Kategori">
      <div class="admin-categories">
        <div class="page-header">
          <button @click="showForm = true" class="btn btn-primary">
            + Tambah Kategori
          </button>
        </div>

        <!-- Category Form Modal -->
        <div v-if="showForm" class="modal-overlay" @click="closeForm">
          <div class="modal-content" @click.stop>
            <div class="modal-header">
              <h2>{{ editingCategory ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
              <button @click="closeForm" class="btn-close">×</button>
            </div>
            <form @submit.prevent="handleSubmit" class="form">
              <div class="form-group">
                <label class="form-label">Nama Kategori *</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-input"
                  placeholder="Masukkan nama kategori"
                  required
                />
              </div>
              <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea
                  v-model="form.description"
                  class="form-textarea"
                  placeholder="Deskripsi kategori (opsional)"
                  rows="3"
                ></textarea>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  {{ editingCategory ? 'Update' : 'Simpan' }}
                </button>
                <button type="button" @click="closeForm" class="btn btn-secondary">
                  Batal
                </button>
              </div>
            </form>
          </div>
        </div>

        <div v-if="loading" class="loading">
          <div class="spinner"></div>
        </div>

        <div v-else-if="categories.length > 0" class="categories-grid">
          <div v-for="category in categories" :key="category.id" class="category-card">
            <div class="category-content">
              <h3>{{ category.name }}</h3>
              <p v-if="category.description">{{ category.description }}</p>
              <p v-else class="text-muted">Tidak ada deskripsi</p>
            </div>
            <div class="category-actions">
              <button @click="editCategory(category)" class="btn btn-sm btn-secondary">
                Edit
              </button>
              <button @click="handleDelete(category)" class="btn btn-sm btn-danger">
                Hapus
              </button>
            </div>
          </div>
        </div>

        <div v-else class="empty-state">
          <p>Belum ada kategori. <button @click="showForm = true" class="text-link">Tambah kategori pertama</button></p>
        </div>
      </div>
    </AdminLayout>
  </div>
</template>

<script>
import AdminLayout from '../../components/admin/AdminLayout.vue'
import { categoryService } from '../../api/categories'

export default {
  name: 'AdminCategories',
  components: {
    AdminLayout
  },
  data() {
    return {
      categories: [],
      loading: true,
      showForm: false,
      editingCategory: null,
      form: {
        name: '',
        description: ''
      }
    }
  },
  async mounted() {
    await this.loadCategories()
  },
  methods: {
    async loadCategories() {
      this.loading = true
      try {
        const response = await categoryService.getAll()
        this.categories = response.data
      } catch (error) {
        console.error('Error loading categories:', error)
      } finally {
        this.loading = false
      }
    },
    editCategory(category) {
      this.editingCategory = category
      this.form.name = category.name
      this.form.description = category.description || ''
      this.showForm = true
    },
    closeForm() {
      this.showForm = false
      this.editingCategory = null
      this.form = { name: '', description: '' }
    },
    async handleSubmit() {
      this.loading = true
      try {
        if (this.editingCategory) {
          await categoryService.update(this.editingCategory.id, this.form)
        } else {
          await categoryService.create(this.form)
        }
        await this.loadCategories()
        this.closeForm()
      } catch (error) {
        alert(error.response?.data?.detail || 'Error menyimpan kategori')
      } finally {
        this.loading = false
      }
    },
    async handleDelete(category) {
      if (!confirm(`Hapus kategori "${category.name}"?`)) return
      
      try {
        await categoryService.delete(category.id)
        await this.loadCategories()
      } catch (error) {
        alert(error.response?.data?.detail || 'Error menghapus kategori')
      }
    }
  }
}
</script>

<style scoped>
.admin-categories {
  padding: 0;
}

.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.category-card {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  padding: 1.5rem;
  box-shadow: var(--shadow-md);
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 1rem;
}

.category-content {
  flex: 1;
}

.category-content h3 {
  margin-bottom: 0.5rem;
  font-size: 1.25rem;
}

.category-content p {
  margin: 0;
  color: var(--text-secondary);
}

.text-muted {
  color: var(--text-light);
  font-style: italic;
}

.category-actions {
  display: flex;
  gap: 0.5rem;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
}

.modal-content {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-xl);
  width: 100%;
  max-width: 500px;
  padding: 2rem;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.modal-header h2 {
  margin: 0;
}

.btn-close {
  background: none;
  border: none;
  font-size: 2rem;
  color: var(--text-secondary);
  cursor: pointer;
  line-height: 1;
  padding: 0;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-close:hover {
  color: var(--text-primary);
}

.text-link {
  color: var(--primary-color);
  text-decoration: none;
  background: none;
  border: none;
  cursor: pointer;
  font-weight: 500;
}

.text-link:hover {
  text-decoration: underline;
}
</style>
