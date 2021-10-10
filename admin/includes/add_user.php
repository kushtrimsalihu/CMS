<?php
if (isset($_POST['create_user'])) {

    if ($_POST['create_user']) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];

        $user_password = $_POST['user_password'];
        //$user_hashed = password_hash($user_password, PASSWORD_BCRYPT);

        move_uploaded_file($user_image_temp, "../user_images/$user_image");

        if (!empty($user_firstname) && !empty($user_lastname) && !empty($user_role) && !empty($user_image)
            && !empty($username) && !empty($user_email) && !empty($user_password)) {

            $query = "INSERT INTO users (user_image,user_firstname, user_lastname, user_role, username, user_email, user_password)
    VALUES ('{$user_image}','{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";

            $create_user_query = mysqli_query($connection, $query);

            confirm($create_user_query);

            $message = "<div class='alert alert-success'>User Created: <a href='users.php'>View Users</a></div> ";

        } else {
            $message = "<div class='alert alert-warning'>All fields are required.</div> ";
        }
    }
} else {
    $message = "";
}

?>




<form action="" method="post" enctype="multipart/form-data">
 <?php echo $message; ?>
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>




    <div class="form-group">

        <select class="form-select form-select-lg" name="user_role" id="user_role">

            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>

        </select>
    </div>




    <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" class="form-control" name="user_email" id="">
    </div>

    <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" class="form-control" name="user_password" id="">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>