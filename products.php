<?php include('db_connect.php'); ?>
<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="page-intro">
    <h2>Shop All Products</h2>
    <p>Browse handmade crochet pieces in a cozy and simple shopping layout.</p>
  </section>

  <section class="shop-controls card">
    <input type="text" id="searchInput" placeholder="Search products...">

    <select id="sortSelect">
      <option value="">Sort By</option>
      <option value="low">Price: Low to High</option>
      <option value="high">Price: High to Low</option>
    </select>

    <select id="filterSelect">
      <option value="all">All Products</option>
      <option value="crochet">Crochet</option>
      <option value="hat">Hats</option>
      <option value="bag">Bags</option>
      <option value="blanket">Blankets</option>
    </select>
  </section>

  <section class="product-grid" id="productGrid">

    <?php
    $result = $conn->query("SELECT * FROM products");

    if ($result && $result->num_rows > 0):
      while ($row = $result->fetch_assoc()):

        $name = htmlspecialchars($row['name']);
        $price = number_format($row['price'], 2);
        $description = htmlspecialchars($row['description']);
        $image = !empty($row['image']) ? htmlspecialchars($row['image']) : 'images/placeholder.jpg';

        $category = "crochet";

        if (stripos($name, "hat") !== false || stripos($description, "hat") !== false) {
          $category = "hat";
        } elseif (stripos($name, "bag") !== false || stripos($description, "bag") !== false) {
          $category = "bag";
        } elseif (stripos($name, "blanket") !== false || stripos($description, "blanket") !== false) {
          $category = "blanket";
        }
    ?>

      <div class="card product-card"
        data-name="<?= strtolower($name) ?>"
        data-price="<?= $row['price'] ?>"
        data-category="<?= $category ?>">

        <img src="<?= $image ?>" alt="<?= $name ?>" class="product-img">

        <h3><?= $name ?></h3>
        <p class="product-price">$<?= $price ?></p>
        <p><?= $description ?></p>
        <a class="btn" href="product.php?id=<?= $row['id'] ?>">View Product</a>
      </div>

    <?php
      endwhile;
    else:
    ?>

      <p>No products found.</p>

    <?php endif; ?>

  </section>
</div>

<script>
const searchInput = document.getElementById("searchInput");
const sortSelect = document.getElementById("sortSelect");
const filterSelect = document.getElementById("filterSelect");
const productGrid = document.getElementById("productGrid");
const products = Array.from(document.querySelectorAll(".product-card"));

function updateProducts() {
  let searchValue = searchInput.value.toLowerCase();
  let sortValue = sortSelect.value;
  let filterValue = filterSelect.value;

  let filteredProducts = products.filter(product => {
    let name = product.dataset.name;
    let category = product.dataset.category;

    return name.includes(searchValue) &&
      (filterValue === "all" || category === filterValue);
  });

  if (sortValue === "low") {
    filteredProducts.sort((a, b) => Number(a.dataset.price) - Number(b.dataset.price));
  }

  if (sortValue === "high") {
    filteredProducts.sort((a, b) => Number(b.dataset.price) - Number(a.dataset.price));
  }

  products.forEach(product => {
    product.style.display = "none";
  });

  filteredProducts.forEach(product => {
    product.style.display = "block";
    productGrid.appendChild(product);
  });

  let noResults = document.getElementById("noResults");

  if (filteredProducts.length === 0) {
    if (!noResults) {
      noResults = document.createElement("p");
      noResults.id = "noResults";
      noResults.textContent = "No matching products found.";
      productGrid.appendChild(noResults);
    }
  } else if (noResults) {
    noResults.remove();
  }
}

searchInput.addEventListener("input", updateProducts);
sortSelect.addEventListener("change", updateProducts);
filterSelect.addEventListener("change", updateProducts);
</script>

<?php include('parts/footer.php'); ?>