<?php
    if(isset($_GET['post_id_edit'])){
        $get_edit_post_id = $_GET['post_id_edit'];

        $query = "SELECT * FROM posts WHERE post_id = $get_edit_post_id";
        $select_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
        }
    }

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category']; // connected to select tag name
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $get_edit_post_id";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '$post_title', ";
        $query .= "post_category_id = '$post_category_id', ";
        $query .= "post_author = '$post_author', ";
        $query .= "post_status = '$post_status', ";
        $query .= "post_image = '$post_image', ";
        $query .= "post_tags = '$post_tags', ";
        $query .= "post_content = '$post_content', ";
        $query .= "post_date = now() ";
        $query .= "WHERE post_id = '$get_edit_post_id' ";

        $update_post = mysqli_query($connection, $query);

        if(!$update_post){
            die("QUERY FAILED " . mysqli_error($connection));
        }

        echo "Post Updated: ". " ". "<a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php'>View All Posts</a>" ;

    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category" id="" class="form-control">
            <?php
                $query = "SELECT * FROM categories";
                $select_category = mysqli_query($connection, $query);
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
        <input type="text" name="post_author" class="form-control" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
                if($post_status == 'publish'){
                    echo "<option value='draft'>draft</option>";
                } else {
                    echo "<option value='publish'>publish</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control-static">
        <img src="../images/<?php echo $post_image; ?>" width="100" alt="">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="form-control" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="update_post" class="btn btn-primary" value="Edit Post">
    </div>
</form>

