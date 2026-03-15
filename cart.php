<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="page-intro">
    <h2>Your Cart</h2>
    <p>Review the items you selected before moving to checkout.</p>
  </section>

  <section class="shop-layout">
    <div class="card">
      <h3>Cart Items</h3>

      <div class="cart-item">
        <p><strong>Chunky Crochet Sweater</strong></p>
        <p>Quantity: 1</p>
        <p>Price: $48.00</p>
        <p>Remove Item</p>
      </div>

      <div class="cart-item">
        <p><strong>Mini Bear Plushie</strong></p>
        <p>Quantity: 1</p>
        <p>Price: $22.00</p>
        <p>Remove Item</p>
      </div>
    </div>

    <aside class="card">
      <h3>Order Summary</h3>
      <p>Subtotal: $70.00</p>
      <p>Shipping: $5.00</p>
      <p><strong>Total: $75.00</strong></p>
      <a class="btn" href="checkout.php">Proceed to Checkout</a>
    </aside>
  </section>
</div>

<?php include('parts/footer.php'); ?>