<?php
$page_title = "Blog Post";
$page_description = "Read our latest insights on web development, technology trends, and business growth strategies.";

require_once '../includes/config.php';

$post = null;
$slug = $_GET['slug'] ?? null;

try {
  $pdo = getDBConnection();
  if ($pdo && $slug) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ? AND published = 1 LIMIT 1");
    $stmt->execute([$slug]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    $social_meta = true;
    $meta_title = $post['meta_title'];
    $meta_description = $post['meta_description'];
  }
} catch (Exception $e) {
  // fallback (static example)
  if ($slug === 'why-business-needs-professional-website-2025') {
    $post = [
      'id' => 1,
      'title' => 'Why Your Business Needs a Professional Website in 2025',
      'slug' => 'why-business-needs-professional-website-2025',
      'content' => '<p>In today\'s digital landscape, a professional website is not just an option—it\'s a necessity for business success. Here’s why...</p>',
      'created_at' => '2025-08-15 10:00:00'
    ];
  }
}
require_once '../includes/header.php';
?>

<main>
  <!-- =========== Hero Section =========== -->
  <section class="gradient-hero-dark text-white pt-32 pb-20">
    <div class="container mx-auto px-6 text-center">
      <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in"><?= htmlspecialchars($post['title']) ?></h1>
      <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
      <?= $post['excerpt'] ?>
      </p>
    </div>
  </section>

  <?php if ($post): ?>
    <!-- =========== Blog Post Detail =========== -->
    <section class="py-20 bg-dark-secondary">
      <div class="container mx-auto px-6">
        <p class="text-dark-secondary mb-6">
          Published on <?= date("F j, Y h:i A", strtotime($post['published_at'])) ?>
        </p>
        <p class="text-dark-secondary mb-6">
          AUthor: <?= $post['author'] ?>
        </p>
        <article class="prose prose-lg max-w-none text-dark-primary">
          <?= $post['content'] ?? $post['excerpt'] ?>
        </article>
      </div>
    </section>
  <?php else: ?>
    <!-- =========== Not Found =========== -->
    <section class="pt-32 pb-20 text-center">
      <h2 class="text-3xl font-bold text-dark-accent">Post not found</h2>
      <p class="text-dark-secondary mt-2">The blog post you’re looking for doesn’t exist.</p>
    </section>
  <?php endif; ?>

  <!-- =========== Categories =========== -->
  <section class="py-20 bg-dark-tertiary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Explore Topics</h2>
        <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Browse articles by category to find exactly what you're looking for.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Web Development</h3>
          <p class="text-dark-secondary text-sm">Latest trends and best practices</p>
        </a>

        <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Business Growth</h3>
          <p class="text-dark-secondary text-sm">Strategies for digital success</p>
        </a>

        <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Technology</h3>
          <p class="text-dark-secondary text-sm">Emerging tech and innovations</p>
        </a>

        <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-4">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Case Studies</h3>
          <p class="text-dark-secondary text-sm">Real project insights</p>
        </a>
      </div>
    </div>
  </section>
</main>

<?php require_once '../includes/footer.php'; ?>