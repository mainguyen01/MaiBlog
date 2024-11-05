<?php 
    checkAuthentication();
    $comment_id=(int)$_GET['comment_id'];
    $blog_id=$_GET['blog_id'];
    $query = "SELECT * FROM comments WHERE comment_id = $comment_id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $content = $_POST['content'];
        $query = "UPDATE comments SET content='$content' WHERE comment_id=$comment_id";
        $result = $conn->query($query);
        if ($result == true) {
            echo "<script>alert('Update success')</script>";
            header("Location: ?page=./module/blog&action=read&blog_id=$blog_id");
        } else {
            echo "Error: " . $conn->error;
        }
    }
    
?>

<body>
    <form action="" method="POST">
        <div class="container">
            <h3>Update comment</h3>
            <div class="mb-3">
                <label for="content"><b>Content</b></label>
                <input type="text" name="content" value="<?php echo $row['content']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="submit" name="update" class="btn btn-primary" value="Update">
                <a href="?page=./module/comment&action=read&blog_id=<?php echo $blog_id; ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
        
</body>
    