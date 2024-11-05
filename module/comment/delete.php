<?php 
    checkAuthentication();
    $blog_id = intval($_GET['blog_id']);
    $comment_id = $_GET['comment_id'];
    $query = "DELETE FROM comments WHERE comment_id = '$comment_id'  ";
    $result = $conn->query($query);
    if($result === true){
        // echo "<script>alert('Delete comment successfull')</script>";    
        header("Location: ?page=./module/blog&action=read&blog_id=$blog_id");
    }
    else{
        echo "Error: ".$conn->error;
    }
?>