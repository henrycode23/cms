<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="POST">
        <div class="input-group">
            <input type="text" name="search" class="form-control">
            <span class="input-group-btn">
                <button name="submit" type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login -->
<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="POST">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
        </div>
        <div class="input-group">
            <input type="password" name="user_password" class="form-control" placeholder="Enter Password">
            <span class="input-group-btn">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </span>
        </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">

                <?php
                // BLOG CATEGORIES CATEGORY TITLE SIDEBAR LIST
                    $query = "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a>";
                    }
                ?>

            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<?php include "includes/widget.php"; ?>

</div>

</div>
<!-- /.row -->