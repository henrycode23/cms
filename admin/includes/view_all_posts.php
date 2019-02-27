<?php
    if(isset($_POST['checkboxArray'])){
        foreach($_POST['checkboxArray'] as $checkbox_post_id){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){
                case 'publish':
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkbox_post_id ";
                    $update_publish_checkbox = mysqli_query($connection, $query);
                    if(!$update_publish_checkbox){
                        die("ERROR QUERY ". mysqli_error($connection));
                    }
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkbox_post_id ";
                    $update_draft_checkbox = mysqli_query($connection, $query);
                    if(!$update_draft_checkbox){
                        die("ERROR QUERY ". mysqli_error($connection));
                    }
                    break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = '$checkbox_post_id' ";
                    $select_posts = mysqli_query($connection, $query);
                    if(!$select_posts){
                        die("ERROR QUERY ". mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_array($select_posts)){
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
                    $query = "INSERT INTO posts (post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date) ";
                    $query .= "VALUES ('$post_title', '$post_category_id', '$post_author', '$post_status', '$post_image', '$post_tags', '$post_content', now())";
                    $clone_posts = mysqli_query($connection, $query);
                    if(!$clone_posts){
                        die("ERROR QUERY ". mysqli_error($connection));
                    }
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $checkbox_post_id ";
                    $delete_posts_checkbox = mysqli_query($connection, $query);
                    if(!$delete_posts_checkbox){
                        die("ERROR QUERY ". mysqli_error($connection));
                    }
                    break;
            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" value="Apply" class="btn btn-success">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <br><br><br>
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Date</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
        // VIEW ALL POSTS - SELECT POSTS THEN DISPLAY INFO
        // post_id post_author post_title post_category_id post_status post_image post_tags post_comment_count post_date
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
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
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
                    echo "<td><input type='checkbox' name='checkboxArray[]' value='$post_id' class='checkboxes'></td>";
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";

            $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                    $select_category = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_category)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<td>$cat_title</td>";
                    }

                    echo "<td>$post_status</td>";
                    echo "<td><img src='../images/$post_image' width='100'></td>";
                    echo "<td>$post_tags</td>";
                    // $comments_count = mysqli_query($connection, "SELECT * FROM comments WHERE comment_post_id = $post_id" );
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                    $comments_count = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($comments_count);
                    $comment_id = $row['comment_id'];
                    $comments_num_rows = mysqli_num_rows($comments_count);
                    echo "<td><a href='post_comments.php?id=$post_id'>$comments_num_rows</a></td>";
                    echo "<td><a href='posts.php?reset=$post_id' onclick=\"javascript: return confirm('Are you sure you want to reset views count?'); \">$post_views_count</a></td>";
                    echo "<td>$post_date</td>";
                    echo "<td><a href='../post.php?p_id=$post_id' target='_blank' class='btn btn-primary'>View Post</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&post_id_edit=$post_id' class='btn btn-primary'>Edit</a></td>";
                    echo "<td><a href='posts.php?delete=$post_id' onclick=\"javascript: return confirm('Are you sure you want to delete?'); \" class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
            }
        ?>

        </tbody>
    </table>
</form>

<?php
    if(isset($_GET['delete'])){
        $get_delete_post = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = $get_delete_post";
        $delete_post = mysqli_query($connection, $query);

        $query = "DELETE FROM comments WHERE comment_post_id = $get_delete_post";
        $delete_comment = mysqli_query($connection, $query);

        header("Location: posts.php");
    }

    if(isset($_GET['reset'])){
        $the_post_id = $_GET['reset'];

        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = ". mysqli_real_escape_string($connection, $the_post_id) ." ";
        $reset_views_count = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
?>