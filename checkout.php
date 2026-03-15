<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="page-intro">
    <h2>Checkout</h2>
    <p>Enter your shipping and billing information to complete your order.</p>
  </section>

  <section class="shop-layout">
    <div class="card">
      <h3>Shipping Information</h3>

      <form class="form-stack">
        <input type="text" class="input" placeholder="Full Name">
        <input type="text" class="input" placeholder="Street Address">
        <input type="text" class="input" placeholder="City">
        <input type="text" class="input" placeholder="State">
        <input type="text" class="input" placeholder="Zip Code">

        <h3>Billing Information</h3>

        <input type="text" class="input" placeholder="Cardholder Name">
        <input type="text" class="input" placeholder="Card Number">
        <input type="text" class="input" placeholder="Expiration Date">
        <input type="text" class="input" placeholder="CVV">
      </form>
    </div>

    <aside class="card">
      <h3>Order Summary</h3>
      <p>Subtotal: $70.00</p>
      <p>Shipping: $5.00</p>
      <p><strong>Total: $75.00</strong></p>
      <a class="btn" href="confirmation.php">Complete Purchase</a>
    </aside>
  </section>
</div>

<?php include('parts/footer.php'); ?>