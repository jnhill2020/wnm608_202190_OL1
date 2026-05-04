<?php include('db_connect.php'); ?>

<?php
if (isset($_POST['add_product'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sdss", $name, $price, $description, $image);
  $stmt->execute();
}
?>

<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">

  <section class="page-intro">
    <h2>Product Admin Page</h2>
    <p>This page is for managing products in the database.</p>
  </section>

  <section class="card">
    <h3>Add New Product</h3>

    <form class="product-form" method="post">
      <input type="text" name="name" placeholder="Product name" required>
      <input type="number" name="price" placeholder="Price" step="0.01" required>
      <input type="text" name="image" placeholder="Image file name ex: keychain.jpeg" required>
      <textarea name="description" placeholder="Product description" required></textarea>

      <button class="btn" type="submit" name="add_product">Add Product</button>
    </form>
  </section>

  <section class="card">
    <h3>Current Products</h3>

    <table class="admin-table">
      <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Price</th>
        <th>Description</th>
        <th>Image</th>
      </tr>

      <?php
      $result = $conn->query("SELECT * FROM products ORDER BY id DESC");

      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>

        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td>$<?= number_format($row['price'], 2) ?></td>
          <td><?= htmlspecialchars($row['description']) ?></td>
          <td>
            <img 
              src="images/<?= htmlspecialchars($row['image']) ?>" 
              alt="<?= htmlspecialchars($row['name']) ?>" 
              class="admin-img"
            >
          </td>
        </tr>

      <?php
        endwhile;
      else:
      ?>

        <tr>
          <td colspan="5">No products found.</td>
        </tr>

      <?php endif; ?>
    </table>
  </section>

</div>

<?php include('parts/footer.php'); ?>