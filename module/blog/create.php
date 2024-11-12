<?php 
    checkAuthentication(); 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $user_id = getUserId();
        $extension = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);

        if(isset($_FILES['avatar']) && $_FILES['avatar']['error']==0){
            $avatar_path = "uploads/blog/".uniqid().'.'.$extension;
            move_uploaded_file($_FILES["avatar"]["tmp_name"],$avatar_path);    
        }else{
            $avatar_path = null;
        }        
        $sql="INSERT INTO blogs(`title`,`content`,`avatar_path`,`user_id`) VALUES ('$title', '$content', '$avatar_path', '$user_id')";
        $result = $conn->query($sql);
        if($result === true){
            echo "<script>alert('Create blog successfully')</script>";
            header("Location: index.php");
            exit();
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto ">
            <p>Create Blog</p>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title"><b>Title</b></label>
                    <input type="title" name="title" placeholder="Enter Title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="content"><b>Content</b></label>
                    <input type="content" name="content" placeholder="Enter Content" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="avatar_path"><b>Avatar</b></label>
                    <input type="file" name="avatar" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="create" class="btn btn-primary" value="Create">
                    <a href="./index.php" class="btn btn-primary">Home</a>
                </div>
                
            </form>
        </div>
    </div>
</div>