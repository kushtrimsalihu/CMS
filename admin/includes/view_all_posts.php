<table class="table table-hover table-bordered">
    <thead>
        <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>

<?php

$query = "SELECT * From posts";
$select_all_posts = mysqli_query($connection,$query);

while ($row = mysqli_fetch_assoc($select_all_posts)) {
   $post_id = $row['post_id'];
   $post_author = $row['post_author'];
   $post_title = $row['post_title'];
   $post_category = $row['post_category_id'];
   $post_status = $row['post_status'];
   $post_image = $row['post_image'];
   $post_tags = $row['post_tags'];
   $post_comments = $row['post_comment_count'];
   $post_date = $row['post_date'];
?>

<tbody>
    <tr>
        <td><?php echo $post_id; ?></td>
        <td><?php echo $post_author; ?></td>
        <td><?php echo $post_title; ?></td>

        <?php
             $query = "SELECT * FROM categories WHERE cat_id = {$post_category}";
             $select_categories_id = mysqli_query($connection,$query);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                  $cat_id = $row['cat_id'];
                  $cat_title = $row['cat_title'];
            } 
        ?>

        <td><?php echo $cat_title; ?></td>


        <td><?php echo $post_status; ?></td>
        <td><?php echo "<img width='100' src='../images/$post_image'>"; ?></td>
        <td><?php echo $post_tags; ?></td>
        <td><?php echo $post_comments; ?></td>
        <td><?php echo $post_date; ?></td>
        <td><?php echo "<a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a>"; ?></td>
        <td><?php echo "<a class='btn btn-danger' href='posts.php?delete={$post_id}'>Delete</a>"; ?></td>
    </tr>


<?php }?>

</tbody>
</table>

<?php

if(isset($_GET['delete'])){
$the_post_id = $_GET['delete'];

$query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
$delete_query = mysqli_query($connection,$query);
confirm($delete_query);
header("location: posts.php");


}
?>