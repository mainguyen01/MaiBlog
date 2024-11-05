
<?php 
    checkAuthentication();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $content = addslashes($_POST['content']);
        $user_id = getUserId();
        $blog_id = $_GET['blog_id'];
        $query = "INSERT INTO comments (`content`,`user_id`,`blog_id`,`parent_id`) VALUES ('$content','$user_id','$blog_id','0' )";
        $result = $conn->query($query);
        if($result == true){
            echo "<script>alert('Add comment successfully')</script>";
            header("Location: ?page=./module/blog&action=read&blog_id=$blog_id");
        }
        else {
            echo "Error: ".$conn->error;
        }
    }
?>
<form action="" method="POST">
    <div class="col-xl-5  ">
        <label for="content" >Comments</label>
        <input type="content" name="content" placeholder="Enter Content" class="form-control" required>            
        <input style="margin-top:10px" type="submit" name="create" class="btn btn-primary" value="Add">
    </div>
</form>



