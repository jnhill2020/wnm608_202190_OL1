<?php
$json = file_get_contents("data/users.json");
$users = json_decode($json, true);

$id = $_GET['id'] ?? 0;
$user = $users[$id];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $users[$id]['name'] = $_POST['name'];
    $users[$id]['type'] = $_POST['type'];
    $users[$id]['email'] = $_POST['email'];
    $users[$id]['classes'] = $_POST['classes'];

    file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));
    $user = $users[$id];
}
?>

<?php include('parts/header.php'); ?>
<?php include('parts/nav.php'); ?>

<div class="container">
  <section class="page-intro">
    <h2>User Editor</h2>
    <p>Select a user and update their information below.</p>
  </section>

  <section class="shop-layout">
    <aside class="filters card">
      <h3>Select User</h3>
      <ul>
        <?php foreach($users as $i => $u): ?>
          <li>
            <a href="user.php?id=<?=$i?>"><?=$u['name']?> (<?=$u['type']?>)</a>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>

    <div class="card" style="padding:20px; width:100%;">
      <h3>Edit User</h3>

      <form method="post">
        <label>Name</label><br>
        <input type="text" name="name" value="<?php echo $user['name']; ?>">

        <br><br>

        <label>Type</label><br>
        <input type="text" name="type" value="<?php echo $user['type']; ?>">

        <br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="<?php echo $user['email']; ?>">

        <br><br>

        <label>Classes</label><br>
        <input type="text" name="classes" value="<?php echo $user['classes']; ?>">

        <br><br>

        <button type="submit" class="btn">Save User</button>
      </form>
    </div>
  </section>
</div>

<?php include('parts/footer.php'); ?>