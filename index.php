<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">

  <section class="hero">
    <h2>Cozy season essentials</h2>
    <p>Handmade crochet pieces designed for comfort and cozy everyday style.</p>
  </section>

  <section class="cards">
    <div class="card">
      <h3>New Arrivals</h3>
      <p>Check out our newest handmade crochet pieces.</p>
    </div>

    <div class="card">
      <h3>Discounts</h3>
      <p>Limited-time cozy deals on select items.</p>
    </div>

    <div class="card">
      <h3>Best Sellers</h3>
      <p>Customer favorites everyone is loving.</p>
    </div>
  </section>

  <section class="newsletter">
    <h3>Join the newsletter</h3>
    <p>Get updates on new crochet drops and cozy collections.</p>

    <form class="newsletter-form">
      <input
        type="email"
        class="input"
        placeholder="Enter your email address"
        required
      >
      <button class="btn btn--hero" type="submit">Subscribe</button>
    </form>
  </section>

</div>

<?php include('parts/footer.php'); ?>