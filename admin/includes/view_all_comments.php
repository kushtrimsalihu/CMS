<table class="table table-hover table-bordered">
    <thead>
        <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>

<?php

$query = "SELECT * FROM comments ORDER BY comment_id DESC";
$select_comments = mysqli_query($connection,$query);

while ($row = mysqli_fetch_assoc($select_comments)) {
   $comment_id = $row['comment_id'];
   $comment_post_id = $row['comment_post_id'];
   $comment_author = $row['comment_author'];
   $comment_content = $row['comment_content'];
   $comment_email = $row['comment_email'];
   $comment_status = $row['comment_status'];
   $comment_date = $row['comment_date'];
?>

<tbody>
    <tr>
        <td><?php echo $comment_id; ?></td>
        <td><?php echo $comment_author; ?></td>
        <td><?php echo $comment_content; ?></td>
        <td><?php echo $comment_email; ?></td>

        <?php
            //  $query = "SELECT * FROM comments WHERE comment_id = {$comment_id}";
            //  $select_comment_id = mysqli_query($connection,$query);

            // while ($row = mysqli_fetch_assoc($select_comment_id)) {
            //       $comment_id = $row['comment_id'];
            //       $cat_title = $row['cat_title'];
            // } 
        ?> 

        <td><?php echo $comment_status; ?></td>


       <?php
       $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
       $select_post_id_query = mysqli_query($connection,$query);
       while ($row = mysqli_fetch_assoc($select_post_id_query)) {
           $post_id = $row['post_id'];
           $post_title = $row['post_title'];
           echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
           
       }
       ?>
       
       
        <td><?php echo $comment_date; ?></td>

        <td><?php echo "<a class='btn btn-success' href='comments.php?approve={$comment_id}'>Approve</a>"; ?></td>
        <td><?php echo "<a class='btn btn-warning' href='comments.php?unapprove={$comment_id}'>Unapprove</a>"; ?></td>
        <td><?php echo "<a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a>"; ?></td>
    </tr>


<?php }?>

</tbody>
</table>


<?php


if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection,$query);
    confirm($approve_comment_query);
    header("location: comments.php");
    
    }
    


if(isset($_GET['unapprove'])){
$the_comment_id = $_GET['unapprove'];

$query = "UPDATE comments SET comment_status = 'unnaproved'  WHERE comment_id = $the_comment_id";
$unapprove_comment_query = mysqli_query($connection,$query);
confirm($unapprove_comment_query);
header("location: comments.php");

}



if(isset($_GET['delete'])){
$the_comment_id = $_GET['delete'];

$query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
$delete_query = mysqli_query($connection,$query);
confirm($delete_query);
header("location: comments.php");


}
?>