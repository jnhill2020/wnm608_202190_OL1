<?php include('db_connect.php'); ?>

<?php
$edit_mode = false;
$edit_product = [
  'id' => '',
  'name' => '',
  'price' => '',
  'description' => '',
  'image' => ''
];

// DELETE PRODUCT
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  header("Location: admin.php");
  exit();
}

// GET PRODUCT FOR EDITING
if (isset($_GET['edit'])) {
  $edit_mode = true;
  $id = $_GET['edit'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();
  $edit_product = $result->fetch_assoc();
}

// ADD PRODUCT
if (isset($_POST['add_product'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sdss", $name, $price, $description, $image);
  $stmt->execute();

  header("Location: admin.php");
  exit();
}

// UPDATE PRODUCT
if (isset($_POST['update_product'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];

  $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?");
  $stmt->bind_param("sdssi", $name, $price, $description, $image, $id);
  $stmt->execute();

  header("Location: admin.php");
  exit();
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
    <h3><?= $edit_mode ? 'Edit Product' : 'Add New Product' ?></h3>

    <form class="product-form" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($edit_product['id']) ?>">

      <input 
        type="text" 
        name="name" 
        placeholder="Product name" 
        value="<?= htmlspecialchars($edit_product['name']) ?>" 
        required
      >

      <input 
        type="number" 
        name="price" 
        placeholder="Price" 
        step="0.01" 
        value="<?= htmlspecialchars($edit_product['price']) ?>" 
        required
      >

      <input 
        type="text" 
        name="image" 
        placeholder="Image file name ex: keychain.jpeg" 
        value="<?= htmlspecialchars($edit_product['image']) ?>" 
        required
      >

      <textarea name="description" placeholder="Product description" required><?= htmlspecialchars($edit_product['description']) ?></textarea>

      <?php if ($edit_mode): ?>
        <button class="btn" type="submit" name="update_product">Update Product</button>
        <a href="admin.php" class="btn">Cancel</a>
      <?php else: ?>
        <button class="btn" type="submit" name="add_product">Add Product</button>
      <?php endif; ?>
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
        <th>Actions</th>
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
          <td>
            <a href="admin.php?edit=<?= $row['id'] ?>" class="btn">Edit</a>
            <a 
              href="admin.php?delete=<?= $row['id'] ?>" 
              class="btn"
              onclick="return confirm('Are you sure you want to delete this product?');"
            >
              Delete
            </a>
          </td>
        </tr>

      <?php
        endwhile;
      else:
      ?>

        <tr>
          <td colspan="6">No products found.</td>
        </tr>

      <?php endif; ?>
    </table>
  </section>

</div>

<?php include('parts/footer.php'); ?>