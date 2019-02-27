<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Panel
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->      
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        // POSTS COUNT OUTPUT
                                            $query = "SELECT * FROM posts";
                                            $select_posts = mysqli_query($connection, $query);
                                            $posts_count = mysqli_num_rows($select_posts);
                                        ?>
                                        <div class='huge'><?php echo $posts_count; ?></div>
                                            <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        // COMMENTS COUNT OUTPUT
                                            $query = "SELECT * FROM comments";
                                            $select_comments = mysqli_query($connection, $query);
                                            $comments_count = mysqli_num_rows($select_comments);
                                        ?>
                                    <div class='huge'><?php echo $comments_count; ?></div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        // USERS COUNT OUTPUT
                                            $query = "SELECT * FROM users";
                                            $select_users = mysqli_query($connection, $query);
                                            $users_count = mysqli_num_rows($select_users);
                                        ?>
                                    <div class='huge'><?php echo $users_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        // CATEGORIES COUNT OUTPUT
                                            $query = "SELECT * FROM categories";
                                            $select_categories = mysqli_query($connection, $query);
                                            $categories_count = mysqli_num_rows($select_categories);
                                        ?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                                <!-- /.row -->


                <?php
                // SELECT PUBLISHED POSTS
                    $query = "SELECT * FROM posts WHERE post_status = 'publish' ";
                    $select_publish_posts = mysqli_query($connection, $query);
                    $publish_posts_count = mysqli_num_rows($select_publish_posts);

                // SELECT DRAFT POSTS
                    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                    $select_draft_posts = mysqli_query($connection, $query);
                    $draft_posts_count = mysqli_num_rows($select_draft_posts);

                // SELECT UNAPPROVED COMMENTS
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                    $select_unapprove_comments = mysqli_query($connection, $query);
                    $unapprove_comments_count = mysqli_num_rows($select_unapprove_comments);

                // SELECT USER_ROLE SUBSCRIBERS
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                    $select_subscribers = mysqli_query($connection, $query);
                    $subscribers_count = mysqli_num_rows($select_subscribers);
                    
                ?>

                <div class="row">
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                            <?php
                                $element_text = ['All Posts','Published Posts','Draft Posts','Comments','Pending Comments','Users','Subscribers','Categories'];
                                $element_count = [$posts_count, $publish_posts_count, $draft_posts_count, $comments_count, $unapprove_comments_count, $users_count, $subscribers_count, $categories_count];

                                for($i=0; $i<8; $i++){
                                    echo "['$element_text[$i]'". ",". "$element_count[$i]],";
                                }
                            ?>

                        // ['Posts', 1000],
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>