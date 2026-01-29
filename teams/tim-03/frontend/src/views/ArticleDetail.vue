<template>
  <div>
    <Navbar />
    <main class="section">
      <div class="container container-sm">
        <div v-if="loading" class="loading">
          <div class="spinner"></div>
        </div>
        
        <article v-else-if="article" class="article-detail">
          <div class="article-header">
            <div class="article-category">{{ article.category.name }}</div>
            <h1>{{ article.title }}</h1>
            <div class="article-meta">
              <span>{{ formatDate(article.created_at) }}</span>
              <span>•</span>
              <span>{{ article.views }} views</span>
              <span>•</span>
              <span>Author : NvsNox </span>
            </div>
          </div>

          <div v-if="article.featured_image" class="article-featured-image">
            <img :src="getImageUrl(article.featured_image)" :alt="article.title" />
          </div>

          <div v-if="article.excerpt" class="article-excerpt">
            <p>{{ article.excerpt }}</p>
          </div>

          <div class="article-content" v-html="article.content"></div>

          <div v-if="article.images && article.images.length > 0" class="article-images">
            <h3>Galeri Foto</h3>
            <div class="image-gallery">
              <div
                v-for="img in article.images"
                :key="img.id"
                class="gallery-item"
              >
                <img :src="getImageUrl(img.image_path)" :alt="img.alt_text || article.title" />
              </div>
            </div>
          </div>

          <div class="article-footer">
            <router-link to="/articles" class="btn btn-secondary">
              ← Kembali ke Artikel
            </router-link>
          </div>
        </article>

        <div v-else class="text-center">
          <p>Artikel tidak ditemukan.</p>
          <router-link to="/articles" class="btn btn-primary mt-2">
            Kembali ke Artikel
          </router-link>
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import { articleService } from '../api/articles'

export default {
  name: 'ArticleDetail',
  components: {
    Navbar,
    Footer
  },
  data() {
    return {
      article: null,
      loading: true
    }
  },
  async mounted() {
    await this.loadArticle()
  },
  methods: {
    async loadArticle() {
      try {
        const slug = this.$route.params.slug
        const response = await articleService.getBySlug(slug)
        this.article = response.data
      } catch (error) {
        console.error('Error loading article:', error)
      } finally {
        this.loading = false
      }
    },
    getImageUrl(path) {
      if (!path) return '/placeholder.jpg'
      if (path.startsWith('http')) return path
      return `http://localhost:8000/${path}`
    },
    formatDate(dateString) {
      const date = new Date(dateString)
      return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
    }
  }
}
</script>

<style scoped>
.article-detail {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  padding: 2rem;
  box-shadow: var(--shadow-md);
}

.article-header {
  margin-bottom: 2rem;
}

.article-category {
  display: inline-block;
  background: var(--primary-color);
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 1rem;
  font-size: 0.875rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.article-header h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.article-meta {
  display: flex;
  gap: 0.5rem;
  color: var(--text-light);
  font-size: 0.9rem;
}

.article-featured-image {
  width: 100%;
  margin-bottom: 2rem;
  border-radius: var(--border-radius);
  overflow: hidden;
}

.article-featured-image img {
  width: 100%;
  height: auto;
  display: block;
}

.article-excerpt {
  font-size: 1.125rem;
  color: var(--text-secondary);
  font-style: italic;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: var(--bg-secondary);
  border-left: 4px solid var(--primary-color);
  border-radius: var(--border-radius);
}

.article-content {
  line-height: 1.8;
  margin-bottom: 3rem;
}

.article-content :deep(p) {
  margin-bottom: 1.5rem;
}

.article-content :deep(img) {
  max-width: 100%;
  height: auto;
  border-radius: var(--border-radius);
  margin: 1.5rem 0;
}

.article-images {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 2px solid var(--border-color);
}

.article-images h3 {
  margin-bottom: 1.5rem;
}

.image-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
}

.gallery-item {
  border-radius: var(--border-radius);
  overflow: hidden;
  aspect-ratio: 1;
}

.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.article-footer {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 2px solid var(--border-color);
}

@media (max-width: 768px) {
  .article-detail {
    padding: 1.5rem;
  }
  
  .article-header h1 {
    font-size: 1.75rem;
  }
}
</style>
