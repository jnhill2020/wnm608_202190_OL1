<?php include('db_connect.php'); ?>
<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="page-intro">
    <h2>Shop All Products</h2>
    <p>Browse handmade crochet pieces in a cozy and simple shopping layout.</p>
  </section>

  <section class="shop-layout">
    <aside class="filters card">
      <h3>Filters</h3>
      <p>Category</p>
      <p>Color</p>
      <p>Price Range</p>
      <p>Sort By</p>
    </aside>

    <div class="product-grid">

      <?php
      $result = $conn->query("SELECT * FROM products");

      if($result && $result->num_rows > 0):
        while($row = $result->fetch_assoc()):
      ?>

        <div class="card">
          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <p>$<?= number_format($row['price'], 2) ?></p>
          <p><?= htmlspecialchars($row['description']) ?></p>
          <a class="btn" href="product.php?id=<?= $row['id'] ?>">View Product</a>
        </div>

      <?php
        endwhile;
      else:
      ?>

        <p>No products found.</p>

      <?php endif; ?>

    </div>
  </section>
</div>

<?php include('parts/footer.php'); ?>