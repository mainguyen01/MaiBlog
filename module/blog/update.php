 <?php
    $blog_id = intval($_GET['blog_id']);
    $query = "SELECT * FROM blogs WHERE blog_id = $blog_id";
    $result = $conn->query($query);
    $blog = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        checkAuthentication();
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $extension = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
        $avatar_path = "uploads/blogs/" . uniqid().'.'.$extension;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_path);
        $sql = "UPDATE blogs SET title='$title', content='$content', avatar_path='$avatar_path' WHERE blog_id=$blog_id ";
        $result = $conn->query($sql);
        if ($result == true) {
            echo "<script>alert('Update success')</script>";
            header("Location: ?page=./module/blog&action=read&blog_id=$blog_id");
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
 <body>
     <div class="container">
         <h1>Update Blog</h1>
         <form action="" method="POST" enctype="multipart/form-data">
             <div class="mb-3">
                 <label for="title"><b>Title</b></label>
                 <input type="text" name="title" value="<?php echo $blog['title']; ?>" class="form-control" required>
             </div>
             <div class="mb-3">
                 <label for="content"><b>Content</b></label>
                 <textarea name="content" class="form-control" rows="5" required><?php echo ($blog['content']); ?></textarea>
             </div>
             <div class="mb-3">
                 <label for="avatar"><b>Avatar</b></label>
                 <?php if (!empty($blog['avatar_path'])): ?>
                     <img src="<?php echo ($blog['avatar_path']); ?>" alt="Avatar Blog" style="width:100px; height:auto;">
                 <?php endif; ?>
                 <input type="file" name="avatar" class="form-control mt-2" accept="image/*">
                 <input type="hidden" name="existing_avatar" value="<?php echo ($blog['avatar_path']); ?>">
             </div>
             <div class="mb-3">
                 <input type="submit" name="update" class="btn btn-primary" value="Update">
                 <a href="?page=./module/blog&action=read&blog_id=<?php echo $blog_id; ?>" class="btn btn-secondary">Cancel</a>
             </div>
         </form>
     </div>
 </body>