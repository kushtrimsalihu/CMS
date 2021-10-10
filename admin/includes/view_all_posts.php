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

                case 'clone':
         
                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
                    $select_post_query = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_array($select_post_query)){
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    }

    $query = "INSERT INTO posts (post_category_id, post_title, post_author,
    post_date, post_image, post_content, post_tags, post_status) 
    VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),
    '{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";


    $clone_post_query = mysqli_query($connection,$query);
  
    confirm($clone_post_query);
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
                <option value="clone">Clone</option>

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
                    <th>Viewed</th>
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
   $post_views_count = $row['post_views_count'];
?>

            <tbody>
                <tr>
                    <td><input class="checkBoxes" type="checkbox" name='checkBoxArray[]'
                            value='<?php echo $post_id; ?>'></td>
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
                    <td><?php echo "<a class='btn btn-warning' href='../post.php?p_id={$post_id}'>View Post</a>"; ?>
                    </td>
                    <td><?php echo "<a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a>"; ?>
                    </td>
                    <td><?php echo "<a class='btn btn-danger' href='posts.php?delete={$post_id}'>Delete</a>"; ?></td>
                    <td class="text-center"><?php echo "<a href='posts.php?reset={$post_id}'>  $post_views_count <span class='glyphicon glyphicon-eye-open'></span></a>"; ?> </td>
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
header("Location: posts.php");

}

if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection,$_GET['reset']) ." ";
    $reset_query = mysqli_query($connection,$query);
    confirm($reset_query);
    header("Location: posts.php");
    
    }

?>