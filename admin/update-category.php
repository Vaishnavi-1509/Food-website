<?php include('partials/menu.php'); ?>

<div class="main-content">
    <h1>Update Category</h1>

    <br><br>

    <?php
    if(isset($_GET['id'])){
        //echo "Getting the data";
        $id = $_GET['id'];  
        $sql = "SELECT * FROM tbl_category WHERE id=$id";

        $res= mysqli_query($conn, $sql);    

        $count= mysqli_num_rows($res);

        if($count==1){

            $row= mysqli_fetch_assoc($res);
            $title= $row['title'];
            $current_image= $row['image_name'];
            $feature= $row['feature'];
            $active= $row['active'];
        }
        else{
            $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        header('location:'.SITEURL,'admin/manage-category.php');
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </td>
        </tr>
        <tr>
            <td>Current image: </td>
            <td>
                <?php
                if($current_image != ""){
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                    <?php
                }
                else{
                    echo "<div class='error'>Image not added</div>";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>New image: </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>Feature: </td>
                <td>
                    <input <?php if($feature=='Yes'){echo 'checked';}?> type="radio" name="feature" value="Yes"> Yes
                    <input <?php if($feature=='No'){echo 'checked';}?> type="radio" name="feature" value="No"> No
                </td>
        </tr>
        <tr>
            <td>Active: </td>
                <td>
                    <input <?php if($active=='Yes'){echo 'checked';}?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=='No'){echo 'checked';}?> type="radio" name="active" value="No"> No
                </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
            </td>
        </tr>

    </table>
    </form>

    <?php
    
    if(isset($_POST['submit'])){
        //echo "Clicked";

        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $feature= $_POST['feature'];
        $active= $_POST['active'];  

        $sql2= "UPDATE tbl_category SET
        title= '$title',
        feature='$feature',
        active= '$active'
        WHERE id=$id
        ";

        $res2= mysqli_query($conn,$sql2);

        if($res2==true){
            $_SESSION['update']="<div class='success'>Category updated successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['update']="<div class='error'>Failed to update Category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    ?>

</div>

<?php include('partials/footer.php'); ?>