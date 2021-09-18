<?php

if (isset($_GET['edit_user'])) {

    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $user_id = $row['user_id'];
        $user_image = $row['user_image'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

    }
}
if (isset($_POST['edit_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    // $options = [12];
    $user_password = $_POST['user_password'];
    //$user_password=password_hash($user_password,PASSWORD_BCRYPT);

    move_uploaded_file($user_image_temp, "../user_images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id= $the_user_id";
        $the_image_edit = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($the_image_edit)) {
            $user_image = $row['user_image'];
        }
    }

    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);

    $query = "UPDATE users SET ";
    $query .= "user_image = '{$user_image}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname='{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$the_user_id} ";

    $update_user = mysqli_query($connection, $query);
    confirm($update_user);
}

?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_image">Image</label>
        <img width="100" src="../user_images/<?php echo $user_image; ?>" alt="">
        <input type="file" value="<?php echo ''; ?>" name="image">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>




    <div class="form-group">

        <select class="form-select form-select-lg" name="user_role" id="user_role">
            <option value="subscriber"><?php echo $user_role; ?></option>
            <?php
if ($user_role == 'admin') {
    echo "<option value='subscriber'>subscriber</option>";
} else {
    echo "<option value='admin'>admin</option>";
}
?>

        </select>
    </div>




    <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" id="">
    </div>

    <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password" id="">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>