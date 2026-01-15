<template>
  <div>
    <Navbar />
    <main>
      <!-- Hero Section -->
      <section class="hero">
        <div class="container">
          <div class="hero-content">
            <h1>Wisata Kuliner Kalimantan Timur</h1>
            <p class="hero-subtitle">
              Jelajahi kelezatan kuliner khas Kaltim, dari makanan tradisional hingga modern
            </p>
            <router-link to="/articles" class="btn btn-primary btn-lg">
              Jelajahi Artikel
            </router-link>
          </div>
        </div>
      </section>

      <!-- Featured Articles -->
      <section class="section">
        <div class="container">
          <h2 class="text-center mb-4">Artikel Terbaru</h2>
          <div v-if="loading" class="loading">
            <div class="spinner"></div>
          </div>
          <div v-else-if="articles.length > 0" class="grid grid-3">
            <article-card
              v-for="article in articles"
              :key="article.id"
              :article="article"
            />
          </div>
          <div v-else class="text-center">
            <p>Belum ada artikel tersedia.</p>
          </div>
          <div class="text-center mt-4">
            <router-link to="/articles" class="btn btn-secondary">
              Lihat Semua Artikel
            </router-link>
          </div>
        </div>
      </section>
    </main>
    <Footer />
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import { articleService } from '../api/articles'
import ArticleCard from '../components/ArticleCard.vue'

export default {
  name: 'Home',
  components: {
    Navbar,
    Footer,
    ArticleCard
  },
  data() {
    return {
      articles: [],
      loading: true
    }
  },
  async mounted() {
    try {
      const response = await articleService.getAll(0, 6)
      this.articles = response.data
    } catch (error) {
      console.error('Error loading articles:', error)
    } finally {
      this.loading = false
    }
  }
}
</script>

<style scoped>
.hero {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
  color: white;
  padding: 6rem 0;
  text-align: center;
}

.hero-content h1 {
  color: white;
  font-size: 3rem;
  margin-bottom: 1rem;
}

.hero-subtitle {
  font-size: 1.25rem;
  margin-bottom: 2rem;
  color: rgba(255, 255, 255, 0.9);
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.section {
  padding: 4rem 0;
}

@media (max-width: 768px) {
  .hero-content h1 {
    font-size: 2rem;
  }
  
  .hero-subtitle {
    font-size: 1rem;
  }
}
</style>
