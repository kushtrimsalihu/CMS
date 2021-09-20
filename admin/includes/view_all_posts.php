<?php

if(isset($_POST['checkBoxArray'])){
    
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
        $update_to_published_status = mysqli_query($connection,$query);
         
        confirm($update_to_published_status);
        break;
        case 'draft':
            $query = " UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
            $update_to_draft_status = mysqli_query($connection,$query);
            confirm($update_to_draft_status);
            break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $delete_to_posts= mysqli_query($connection,$query);
                confirm($delete_to_posts);
                break;
        }
    }

}


?>


<form action="" method="POST">

    <table class="table table-responsive table-hover table-bordered">

        <div id="bulcOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>

            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
 

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <?php

$query = "SELECT * From posts ORDER BY post_id DESC";

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
            <td><input class="checkBoxes" type="checkbox" name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
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
            <td><?php echo "<a class='btn btn-warning' href='../post.php?p_id={$post_id}'>View Post</a>"; ?></td>
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