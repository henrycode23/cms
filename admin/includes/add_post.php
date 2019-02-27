<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts (post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date) ";
        $query .= "VALUES ('$post_title', '$post_category_id', '$post_author', '$post_status', '$post_image', '$post_tags', '$post_content', now())";
        $create_post = mysqli_query($connection, $query);

        if(!$create_post){
            die("QUERY FAILED " . mysqli_error($connection));
        }

        $get_post_id = mysqli_insert_id($connection); // PULL OUT THE LAST CREATED ID

        echo "Post Created: ". " ". "<a href='../post.php?p_id=$get_post_id' target='_blank'>View Post</a> or <a href='posts.php'>View All Posts</a>" ;
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category" id="" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $select_category = mysqli_query($connection, $query);
                if(!$select_category){
                    die("QUERY FAILED " . mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($select_category)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>     
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control">
            <option value="draft">draft</option>
             <option value='publish'>publish</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control-static">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
    </div>
</form>