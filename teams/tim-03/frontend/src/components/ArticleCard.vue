<template>
  <div class="article-card">
    <router-link :to="`/article/${article.slug}`" class="article-link">
      <div v-if="article.featured_image" class="article-image">
        <img :src="getImageUrl(article.featured_image)" :alt="article.title" />
      </div>
      <div class="article-content">
        <div class="article-category">{{ article.category.name }}</div>
        <h3 class="article-title">{{ article.title }}</h3>
        <p v-if="article.excerpt" class="article-excerpt">{{ article.excerpt }}</p>
        <div class="article-meta">
          <span>{{ formatDate(article.created_at) }}</span>
          <span>•</span>
          <span>{{ article.views }} views</span>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'ArticleCard',
  props: {
    article: {
      type: Object,
      required: true
    }
  },
  methods: {
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
.article-card {
  background: var(--bg-primary);
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--shadow-md);
  transition: var(--transition);
  height: 100%;
  display: flex;
  flex-direction: column;
}

.article-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-xl);
}

.article-link {
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.article-image {
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: var(--bg-tertiary);
}

.article-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.article-card:hover .article-image img {
  transform: scale(1.05);
}

.article-content {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.article-category {
  display: inline-block;
  background: var(--primary-color);
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 1rem;
  font-size: 0.75rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  width: fit-content;
}

.article-title {
  font-size: 1.25rem;
  margin-bottom: 0.75rem;
  color: var(--text-primary);
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.article-excerpt {
  color: var(--text-secondary);
  font-size: 0.9rem;
  margin-bottom: 1rem;
  flex: 1;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.article-meta {
  display: flex;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: var(--text-light);
  margin-top: auto;
}
</style>
