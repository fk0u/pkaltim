<template>
  <div class="page">
    <Navbar />

    <main>
      <!-- Hero Section -->
      <section class="hero animate-on-load" :style="{ backgroundImage: `url(${heroBg})` }">
        <div class="hero-overlay"></div>

        <div class="container hero-wrapper">
          <div class="hero-content">
            <h1>Wisata Kuliner Kalimantan Timur</h1>
            <p class="hero-subtitle">
              Jelajahi kelezatan kuliner khas Kaltim, dari makanan tradisional hingga modern
            </p>

            <router-link to="/articles" class="btn btn-primary btn-cta">
              Jelajahi Artikel
            </router-link>
          </div>
        </div>
      </section>

      <!-- Featured Articles -->
      <section class="section section-soft animate-on-scroll">
        <div class="container">
          <h2 class="section-title">Artikel Terbaru</h2>

          <div v-if="loading" class="loading">
            <div class="spinner"></div>
          </div>

          <div v-else-if="articles.length > 0" class="articles-grid animate-on-scroll">
            <article-card
              v-for="article in articles"
              :key="article.id"
              :article="article"
            />
          </div>

          <div v-else class="empty-state">
            <p>Belum ada artikel tersedia.</p>
          </div>

          <div class="text-center mt-5">
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
import heroBg from '../assets/home-bg.jpg'

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
      loading: true,
      heroBg: heroBg
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

    // ⬇️ Tunggu DOM selesai render
    this.$nextTick(() => {
      this.initScrollAnimation()
    })
  }
},
  methods: {
  initScrollAnimation() {
    const observer = new IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('show')
            observer.unobserve(entry.target)
          }
        })
      },
      { threshold: 0.15 }
    )

    document
      .querySelectorAll('.animate-on-scroll')
      .forEach(el => observer.observe(el))
  }
}
}
</script>

<style scoped>

.page {
  background-color: #fafafa;
}


.hero {
  position: relative;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 80vh;
  display: flex;
  align-items: center;
  color: #fff;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.65),
    rgba(0, 0, 0, 0.35)
  );
}

.hero-wrapper {
  position: relative;
  z-index: 1;
}

.hero-content {
  max-width: 720px;
  text-align: center;
  margin: 0 auto;
}

.hero-content h1 {
  font-size: clamp(2.2rem, 4vw, 3.2rem);
  font-weight: 700;
  margin-bottom: 1.25rem;
  line-height: 1.2;
  color: #ffffff;
}

.hero-subtitle {
  font-size: 1.125rem;
  line-height: 1.6;
  opacity: 0.95;
  margin-bottom: 2.5rem;
  color: #fff;
}

.btn-cta {
  padding: 0.9rem 2.2rem;
  font-size: 1rem;
  border-radius: 999px;
}

/* ===== Section ===== */
.section {
  padding: 5rem 0;
}

.section-soft {
  background-color: #ffffff;
}

.section-title {
  text-align: center;
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 3rem;
}

/* ===== Articles Grid ===== */
.articles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.75rem;
}

/* ===== Loading ===== */
.loading {
  display: flex;
  justify-content: center;
  padding: 4rem 0;
}

.spinner {
  width: 42px;
  height: 42px;
  border: 4px solid #e5e7eb;
  border-top-color: #2563eb;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* ===== Empty State ===== */
.empty-state {
  text-align: center;
  color: #6b7280;
  padding: 2rem 0;
}

/* ===== Utilities ===== */
.mt-5 {
  margin-top: 3rem;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
  .hero {
    min-height: 70vh;
  }

  .hero-content {
    padding: 0 1rem;
  }
}
/* ===== Scroll Animation ===== */
.animate-on-scroll {
  opacity: 0;
  transform: translateY(40px);
  transition: all 0.8s ease;
}

.animate-on-scroll.show {
  opacity: 1;
  transform: translateY(0);
}

/* ===== Hero Load Animation ===== */
.animate-on-load {
  animation: heroFade 1.2s ease forwards;
}

@keyframes heroFade {
  from {
    opacity: 0;
    transform: scale(1.03);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

</style>
