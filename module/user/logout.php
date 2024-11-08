<?php 
    if(isset($_SESSION['session']) ){
        session_unset();
        session_destroy();
        
        header("Location: index.php");
    }
?>

