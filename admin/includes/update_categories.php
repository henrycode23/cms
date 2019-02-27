<?php
// EDIT - FETCH DATA THEN DISPLAY INFO
    if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $select_category_id = mysqli_query($connection, $query) ;
        while($row = mysqli_fetch_assoc($select_category_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

?>
<!-- EDIT CATEGORY FORM -->
<form action="" method="POST">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <input type="text" class="form-control" name="cat_title" value="<?php if(isset($cat_title)){echo $cat_title;} ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_category" value="Edit Category">
    </div>
</form>
<?php
        }
    }
?>
<?php
// UPDATE CATEGORIES
    if(isset($_POST['update_category'])){
        $post_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '$post_cat_title' WHERE cat_id = $cat_id";
        $update_category = mysqli_query($connection, $query);
            if(!$update_category){
                die("QUERY FAILED ". mysqli_error($connection));
            }
            header("Location: categories.php?edit=$cat_id");
    }

?>