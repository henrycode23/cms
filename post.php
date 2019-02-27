<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];


                        // OLD CODE: UPDATING COMMENT COUNT
                        // $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                        // $update_views_count = mysqli_query($connection, $query);

                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id"; // SELECT POSTS
                        $select_all_posts = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_posts)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                    
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

                <?php
                        } // WHILE LOOP FETCH
                    } else{
                        header("Location: index.php");
                    } 
                ?>

                <!-- Blog Comments -->
                <?php
                    // CREATE_COMMENT SUBMIT GET P_ID = $THE_POST_ID
                    if(isset($_POST['create_comment'])){
                        $the_post_id = $_GET['p_id'];   // WHERE POST_ID || COMMENT_POST_ID = $THE_POST_ID

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        // VALIDATION BEFORE INSERT COMMENTS
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            // INSERT COMMENTS IN RELATION TO THE_POST_ID
                            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $query .= "VALUES( '$the_post_id', '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                            $insert_comments = mysqli_query($connection, $query);

                            if(!$insert_comments){
                                die('QUERY FAILED '. mysqli_error($connection));
                            }

                            // UPDATE POST_COMMENT_COUNT
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = $the_post_id";
                            $update_comment_count = mysqli_query($connection, $query);

                        } else{
                            // echo "<script>alert('Fields cannot be empty');</script>";
                            echo "<p class='bg-danger'>Fields cannot be empty</p>";
                        }
                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <!-- FORM RELATED TO THE INSERT COMMENTS QUERY -->
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="comment_author"></label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment_email"></label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                // SELECT COMMENT TO OUTPUT WITH WHILE LOOP
                    $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC ";
                    $select_comment = mysqli_query($connection, $query);
                    if(!$select_comment){
                        die('QUERY FAILED '. mysqli_error($connection));
                    }

                    while($row = mysqli_fetch_array($select_comment)){
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <?php      
                    }
                ?>

            </div>

            <?php include "includes/sidebar.php"; ?>

        <hr>

        <?php include "includes/footer.php"; ?>
