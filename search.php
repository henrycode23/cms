<?php // include "includes/db.php"; ?>

<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <?php
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                        $search_post_tags = mysqli_query($connection, $query);

                        if(!$search_post_tags){
                            die("QUERY FAILED " . mysqli_error($connection));
                        }

                        $count = mysqli_num_rows($search_post_tags);
                        if($count == 0 || $search == ""){
                            echo "NO RESULT";
                        } else {
                            while($row == mysqli_fetch_assoc($search_post_tags)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                    
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php
                            }
                        }
                    }
                ?>

            </div>

            <?php include "includes/sidebar.php"; ?>

        <hr>

        <?php include "includes/footer.php"; ?>
