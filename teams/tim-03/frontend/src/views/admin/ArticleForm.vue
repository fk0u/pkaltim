<template>
  <div>
    <AdminLayout :title="isEdit ? 'Edit Artikel' : 'Buat Artikel Baru'">
      <div class="article-form">
        <form @submit.prevent="handleSubmit" class="form">
          <div v-if="error" class="alert alert-error">
            {{ error }}
          </div>

          <div class="form-group">
            <label class="form-label">Judul Artikel *</label>
            <input
              v-model="form.title"
              type="text"
              class="form-input"
              placeholder="Masukkan judul artikel"
              required
            />
          </div>

          <div class="form-group">
            <label class="form-label">Kategori *</label>
            <select v-model="form.category_id" class="form-select" required>
              <option value="">Pilih Kategori</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                {{ cat.name }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Ringkasan (Excerpt)</label>
            <textarea
              v-model="form.excerpt"
              class="form-textarea"
              placeholder="Ringkasan singkat artikel (opsional)"
              rows="3"
            ></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Konten Artikel *</label>
            <textarea
              v-model="form.content"
              class="form-textarea"
              placeholder="Tulis konten artikel di sini..."
              rows="15"
              required
            ></textarea>
            <small class="form-hint">Gunakan HTML untuk formatting (p, strong, em, ul, ol, etc.)</small>
          </div>

          <div class="form-group">
            <label class="form-label">Featured Image</label>
            <input
              type="file"
              accept="image/*"
              @change="handleImageChange"
              class="form-input"
            />
            <div v-if="form.featured_image_preview || currentFeaturedImage" class="image-preview mt-2">
              <img
                :src="form.featured_image_preview || getImageUrl(currentFeaturedImage)"
                alt="Preview"
                class="img-thumbnail"
              />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">
              <input
                v-model="form.is_published"
                type="checkbox"
              />
              Publish artikel
            </label>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-lg" :disabled="loading">
              <span v-if="loading" class="spinner" style="width: 20px; height: 20px; border-width: 2px;"></span>
              <span v-else>{{ isEdit ? 'Update Artikel' : 'Buat Artikel' }}</span>
            </button>
            <router-link to="/admin/articles" class="btn btn-secondary btn-lg">
              Batal
            </router-link>
          </div>
        </form>

        <!-- Image Gallery (Edit Mode) -->
        <div v-if="isEdit && articleImages.length > 0" class="image-gallery-section mt-4">
          <h3>Galeri Gambar</h3>
          <div class="image-gallery">
            <div v-for="img in articleImages" :key="img.id" class="gallery-item">
              <img :src="getImageUrl(img.image_path)" :alt="img.alt_text" />
              <button @click="handleDeleteImage(img.id)" class="btn btn-sm btn-danger">
                Hapus
              </button>
            </div>
          </div>
          <div class="mt-2">
            <input
              type="file"
              accept="image/*"
              @change="handleAddImage"
              class="form-input"
              style="max-width: 300px;"
            />
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
  name: 'ArticleForm',
  components: {
    AdminLayout
  },
  data() {
    return {
      form: {
        title: '',
        content: '',
        excerpt: '',
        category_id: '',
        is_published: true,
        featured_image: null,
        featured_image_preview: null
      },
      categories: [],
      articleImages: [],
      currentFeaturedImage: null,
      loading: false,
      error: ''
    }
  },
  computed: {
    isEdit() {
      return !!this.$route.params.id
    }
  },
  async mounted() {
    await this.loadCategories()
    if (this.isEdit) {
      await this.loadArticle()
    }
  },
  methods: {
    async loadCategories() {
      try {
        const response = await categoryService.getAll()
        this.categories = response.data
      } catch (error) {
        console.error('Error loading categories:', error)
      }
    },
    async loadArticle() {
      try {
        const response = await articleService.getById(this.$route.params.id)
        const article = response.data
        this.form.title = article.title
        this.form.content = article.content
        this.form.excerpt = article.excerpt || ''
        this.form.category_id = article.category_id
        this.form.is_published = article.is_published
        this.currentFeaturedImage = article.featured_image
        this.articleImages = article.images || []
      } catch (error) {
        console.error('Error loading article:', error)
        this.error = 'Error memuat artikel'
      }
    },
    handleImageChange(event) {
      const file = event.target.files[0]
      if (file) {
        this.form.featured_image = file
        const reader = new FileReader()
        reader.onload = (e) => {
          this.form.featured_image_preview = e.target.result
        }
        reader.readAsDataURL(file)
      }
    },
    async handleAddImage(event) {
      const file = event.target.files[0]
      if (!file) return
      
      try {
        await articleService.addImage(this.$route.params.id, file)
        await this.loadArticle()
      } catch (error) {
        alert('Error menambahkan gambar')
        console.error(error)
      }
    },
    async handleDeleteImage(imageId) {
      if (!confirm('Hapus gambar ini?')) return
      
      try {
        await articleService.deleteImage(imageId)
        await this.loadArticle()
      } catch (error) {
        alert('Error menghapus gambar')
        console.error(error)
      }
    },
    async handleSubmit() {
      this.loading = true
      this.error = ''
      
      try {
        const formData = new FormData()
        formData.append('title', this.form.title)
        formData.append('content', this.form.content)
        formData.append('excerpt', this.form.excerpt)
        formData.append('category_id', this.form.category_id)
        formData.append('is_published', this.form.is_published)
        
        if (this.form.featured_image) {
          formData.append('featured_image', this.form.featured_image)
        }
        
        if (this.isEdit) {
          await articleService.update(this.$route.params.id, formData)
        } else {
          await articleService.create(formData)
        }
        
        this.$router.push('/admin/articles')
      } catch (error) {
        this.error = error.response?.data?.detail || 'Error menyimpan artikel'
      } finally {
        this.loading = false
      }
    },
    getImageUrl(path) {
      if (!path) return '/placeholder.jpg'
      if (path.startsWith('http')) return path
      return `http://localhost:8000/${path}`
    }
  }
}
</script>

<style scoped>
.article-form {
  max-width: 900px;
}

.form-hint {
  display: block;
  margin-top: 0.5rem;
  color: var(--text-light);
  font-size: 0.875rem;
}

.image-preview {
  margin-top: 1rem;
}

.form-actions {
  display: flex;
  gap: 1rem;
  margin-top: 2rem;
}

.image-gallery-section {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  padding: 2rem;
  box-shadow: var(--shadow-md);
}

.image-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
  margin-top: 1rem;
}

.gallery-item {
  position: relative;
  border-radius: var(--border-radius);
  overflow: hidden;
}

.gallery-item img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  display: block;
}

.gallery-item .btn {
  position: absolute;
  bottom: 0.5rem;
  right: 0.5rem;
}
</style>
