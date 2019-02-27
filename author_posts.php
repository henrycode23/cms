<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Posts published by
                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

                <?php
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                    $the_post_author = $_GET['author'];
                }

                // BLOG POSTS
                    $query = "SELECT * FROM posts WHERE post_author = '$the_post_author' ";
                    $select_all_posts = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0,250);
                    
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

                <?php
                    }
                ?>

            </div>

            <?php include "includes/sidebar.php"; ?>

        <hr>

        <?php include "includes/footer.php"; ?>
