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
                            <small>Username</small>
                        </h1>
                        <div class="col-xs-6">
                            
                            <?php 
                            // CREATE CATEGORY - INSERT INTO
                                if(isset($_POST['insert_category'])){
                                    $cat_title = $_POST['cat_title'];
                                    if($cat_title == "" || empty($cat_title)){
                                        echo "This should not be empty";
                                    } else {
                                        $query = "INSERT INTO categories(cat_title) VALUE('$cat_title')";
                                        $insert_categories = mysqli_query($connection, $query);
                                        if(!$insert_categories){
                                            die("QUERY FAILED " . mysqli_error($connection));
                                        }
                                    }
                                }
                            ?> 
                            
                            <!-- ADD CATEGORY FORM -->
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="insert_category" value="Add Category">
                                </div>
                            </form>

                            <?php
                            // INCLUDE "EDIT - FETCH DATA THEN DISPLAY INFO, EDIT CATEGORY FORM, UPDATE CATEGORIES"
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    include "includes/update_categories.php";
                                }
                            ?>

                        </div>
                        <div class="col-xs-6">

                            <?php
                                
                            ?>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                // SELECT CATEGORY THEN DISPLAY
                                    $query = "SELECT * FROM categories";
                                    $select_category = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($select_category)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        
                                        echo "<tr>";
                                        echo "<td>$cat_id</td>";
                                        echo "<td>$cat_title</td>";
                                        echo "<td><a href='categories.php?delete=$cat_id' class='btn btn-primary'>Delete</a></td>";
                                        echo "<td><a href='categories.php?edit=$cat_id' class='btn btn-primary'>Edit</a></td>";
                                        echo "</tr>";
                                    }

                                    
                                // DELETE CATEGORY
                                    if(isset($_GET['delete'])){
                                        $get_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = $get_cat_id";
                                        $delete_category = mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                    }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>