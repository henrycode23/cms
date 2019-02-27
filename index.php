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
                    $per_page = 5;
                    if(isset($_GET['page'])){ // CATCH PAGE
                        $page = $_GET['page'];
                    } else{
                        $page = 1; // IF NOT FOUND, ASSIGN TO EMPTY STRING
                    }

                    if($page == "" || $page == 1){ // IF PAGE EMPTY OR PAGE = 1
                        $page_one = 0; // ASSIGN PAGE_ONE = 0
                    } else{
                        $page_one = ($page * $per_page) - $per_page ; // PAGE_ONE = ( # X 5 ) - 5, E.G. 0=(1*5)-5, 5=(2*5)-5, 10=(3*5)-5
                    }

                    $query_post_count = "SELECT * FROM posts"; // PAGINATION
                    $all_post_count = mysqli_query($connection, $query_post_count);
                    $count = mysqli_num_rows($all_post_count);
                    $count = ceil($count / $per_page); // CREATING EACH NUMBERED PAGINATION BUTTON

                    $query = "SELECT * FROM posts LIMIT $page_one, $per_page"; // BLOG POSTS, PAGINATION LIMIT
                    $select_all_posts = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,250);
                        $post_status = $row['post_status'];

                        if($post_status == 'publish'){ // IF POST_STATUS IS PUBLISH

                ?>

                <!-- First Blog Post -->
                <!-- <h1><?php // echo $count; ?></h1> -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php
                        }  
                    }
                ?>

                <!-- Pagination -->
                <div class="text-center">
                    <ul class="pagination">
                        <?php
                            if($page == 1){
                                echo "";
                            } else{
                                echo "<li><a href='index.php?page=".($page-1)."'>&larr; </a></li>";
                            }

                            for($i = 1; $i <= $count; $i++){
                                if($i == $page){
                                    echo "<li class='active'><a href='index.php?page=$i'>$i</a></li>";
                                } else{
                                    echo "<li><a href='index.php?page=$i'>$i</a></li>";
                                }
                            }

                            if($page >= $count){
                                echo "";
                            } else{
                                echo "<li><a href='index.php?page=".($page+1)."'>&rarr; </a></li>";
                            }
                        ?>
                    </ul>
                </div>

            </div>

            <?php include "includes/sidebar.php"; ?>

        <hr>

        <?php include "includes/footer.php"; ?>
