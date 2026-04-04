<?php include_once "parts/templates.php"; ?>

<?php
$json = file_get_contents("data/users.json");
$users = json_decode($json, true);

$id = $_GET['id'] ?? 0;
$user = $users[$id];
?>

<?=makePage('User Editor', [
    "css" => "style.css"
])?>

<section class="view-window">
    <div class="container">

        <h2>User Editor</h2>

        <div class="grid gap">

            <div>
                <h3>Select a User</h3>
                <ul>
                    <?php foreach($users as $i => $u): ?>
                        <li>
                            <a href="user.php?id=<?=$i?>">
                                <?=$u['name']?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div>
                <h3>Edit User</h3>

                <form method="post">
                    <label>Name</label>
                    <input type="text" name="name" value="<?=$user['name']?>">

                    <br><br>

                    <label>Type</label>
                    <input type="text" name="type" value="<?=$user['type']?>">

                    <br><br>

                    <label>Email</label>
                    <input type="email" name="email" value="<?=$user['email']?>">

                    <br><br>

                    <label>Classes</label>
                    <input type="text" name="classes" value="<?=$user['classes']?>">

                    <br><br>

                    <button type="submit" class="button">Save User</button>
                </form>
            </div>

        </div>

    </div>
</section>

<?=makeFooter()?>