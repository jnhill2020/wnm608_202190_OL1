<?php
$json = file_get_contents("data/users.json");
$users = json_decode($json, true);

$id = $_GET['id'];
$user = $users[$id];
?>

<h2>Edit User</h2>

<form method="post">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>">

    <br><br>

    <label>Type</label>
    <input type="text" name="type" value="<?php echo $user['type']; ?>">

    <br><br>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>">

    <br><br>

    <label>Classes</label>
    <input type="text" name="classes" value="<?php echo $user['classes']; ?>">

    <br><br>

    <button type="submit">Save User</button>

</form>