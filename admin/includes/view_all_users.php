<table class="table table-hover table-bordered">
    <thead>
        <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>

<?php

$query = "SELECT * FROM users ORDER BY user_id DESC";
$select_users = mysqli_query($connection,$query);

while ($row = mysqli_fetch_assoc($select_users)) {
   $user_id = $row['user_id'];
   $user_image = $row['user_image'];
   $username = $row['username'];
   $user_password = $row['user_password'];
   $user_firstname = $row['user_firstname'];
   $user_lastname = $row['user_lastname'];
   $user_email = $row['user_email'];
   $user_role = $row['user_role'];

  
?>

<tbody>
    <tr>
        <td><?php echo $user_id; ?></td>
        <td><?php echo "<img width='100' src='../user_images/$user_image'>"; ?></td>
        <td><?php echo $username; ?></td>
        <td><?php echo $user_firstname; ?></td>
        <td><?php echo $user_lastname; ?></td>

        <?php
            //  $query = "SELECT * FROM comments WHERE comment_id = {$comment_id}";
            //  $select_comment_id = mysqli_query($connection,$query);

            // while ($row = mysqli_fetch_assoc($select_comment_id)) {
            //       $comment_id = $row['comment_id'];
            //       $cat_title = $row['cat_title'];
            // } 
        ?> 

        <td><?php echo $user_email; ?></td>
        <td><?php echo $user_role; ?></td>

       <?php
    //    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
    //    $select_post_id_query = mysqli_query($connection,$query);
    //    while ($row = mysqli_fetch_assoc($select_post_id_query)) {
    //        $post_id = $row['post_id'];
    //        $post_title = $row['post_title'];
    //        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
           
    //    }
       ?>
       
        <td class='text-center'><?php echo "<a class='btn btn-success' href='users.php?change_to_admin=$user_id'>Admin</a>"; ?></td>
        <td class='text-center'><?php echo "<a class='btn btn-warning' href='users.php?change_to_sub=$user_id'>Subscriber</a>"; ?></td>
        <td class='text-center'><?php echo "<a class='btn btn-info' href='users.php?source=edit_user&edit_user=$user_id'>Edit</a>"; ?></td>
        <td class='text-center'><?php echo "<a class='btn btn-danger' href='users.php?delete=$user_id'>Delete</a>"; ?></td>
    </tr>


<?php }?>

</tbody>
</table>


<?php


if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];
    
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $change_to_admin_query = mysqli_query($connection,$query);
    confirm($change_to_admin_query);
    header("location: users.php");
    
    }
    


if(isset($_GET['change_to_sub'])){
$the_user_id = $_GET['change_to_sub'];

$query = "UPDATE users SET user_role = 'subscriber'  WHERE user_id = $the_user_id";
$change_to_sub_query = mysqli_query($connection,$query);
confirm($change_to_sub_query);
header("location: users.php");

}



if(isset($_GET['delete'])){
$the_user_id = $_GET['delete'];

$query = "DELETE FROM users WHERE user_id = {$the_user_id}";
$delete_user_query = mysqli_query($connection,$query);
confirm($delete_user_query);
header("location: users.php");


}
?>