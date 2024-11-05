<?php 
    checkAuthentication(); 
    $blog_id = $_GET['blog_id'];
    $query = "DELETE FROM blogs WHERE blog_id = '$blog_id'";
    $result = $conn->query($query);
    if($result===true){
        echo "<script>alert('Delete successfully')</script>";
        header("Location: index.php");
    }else{
        die("Error fetching blogs: " . $conn->error);
    }
?>