<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h3>Kaltim Kuliner</h3>
          <p>Platform informasi tentang wisata kuliner khas Kalimantan Timur</p>
        </div>
        <div class="footer-section">
          <h4>Quick Links</h4>
          <router-link to="/">Beranda</router-link>
          <router-link to="/articles">Artikel</router-link>
        </div>
        <div class="footer-section">
          <h4>Kontak</h4>
          <p>Email: info@pkaltim.local</p>
          <p>SMK Negeri 7 Samarinda</p>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2026 Kaltim Kuliner. All rights reserved.</p>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style scoped>
.footer {
  background-color: var(--text-primary);
  color: white;
  padding: 3rem 0 1rem;
  margin-top: 4rem;
}

.footer-content {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  margin-bottom: 2rem;
}

.footer-section h3,
.footer-section h4 {
  color: white;
  margin-bottom: 1rem;
}

.footer-section p {
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 0.5rem;
}

.footer-section a {
  display: block;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  margin-bottom: 0.5rem;
  transition: var(--transition);
}

.footer-section a:hover {
  color: white;
}

.footer-bottom {
  text-align: center;
  padding-top: 2rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  color: rgba(255, 255, 255, 0.6);
}
</style>
