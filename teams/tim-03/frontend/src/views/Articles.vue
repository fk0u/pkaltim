<template>
  <div>
    <Navbar />
    <main class="section">
      <div class="container">
        <h1 class="text-center mb-4">Semua Artikel</h1>
        
        <!-- Category Filter -->
        <div class="filter-section mb-4">
          <select v-model="selectedCategory" @change="loadArticles" class="form-select" style="max-width: 300px;">
            <option value="">Semua Kategori</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
              {{ cat.name }}
            </option>
          </select>
        </div>

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

        <!-- Pagination -->
        <div v-if="articles.length > 0" class="pagination mt-4">
          <button
            @click="loadArticles(skip - limit)"
            :disabled="skip === 0"
            class="btn btn-secondary"
          >
            Sebelumnya
          </button>
          <span>Halaman {{ Math.floor(skip / limit) + 1 }}</span>
          <button
            @click="loadArticles(skip + limit)"
            :disabled="articles.length < limit"
            class="btn btn-secondary"
          >
            Selanjutnya
          </button>
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import ArticleCard from '../components/ArticleCard.vue'
import { articleService } from '../api/articles'
import { categoryService } from '../api/categories'

export default {
  name: 'Articles',
  components: {
    Navbar,
    Footer,
    ArticleCard
  },
  data() {
    return {
      articles: [],
      categories: [],
      loading: true,
      selectedCategory: '',
      skip: 0,
      limit: 12
    }
  },
  async mounted() {
    await this.loadCategories()
    await this.loadArticles()
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
    async loadArticles(newSkip = 0) {
      this.loading = true
      this.skip = newSkip
      try {
        const response = await articleService.getAll(
          this.skip,
          this.limit,
          this.selectedCategory || null
        )
        this.articles = response.data
      } catch (error) {
        console.error('Error loading articles:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.filter-section {
  display: flex;
  justify-content: center;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
}
</style>
