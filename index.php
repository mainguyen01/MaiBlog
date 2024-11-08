<body>
<?php 
    include "layout/header.php";
?>
<?php 

   // echo basename($_SERVER['SCRIPT_FILENAME']); die();
   // if(basename($_SERVER['SCRIPT_FILENAME']) !== 'index.php'){
   //     echo basename($_SERVER['SCRIPT_FILENAME']);
   //     die ("Unauthor ");
   // }
    
    include "./system/connectdb.php";
    include "./system/ulities.php";


    $page = isset($_GET['page'])? $_GET['page'] : null;
    $action = isset($_GET['action'])? $_GET['action'] : null;
   

    if(!isset($page) || empty($action)){
        include "./page/home.php";
    }else{
        $file = "$page/$action.php";
        if(file_exists($file)){
            include "$file";
        }
        else{
            echo "<script>alert('404 Not Found')</script>";
        }
    }
   
?>

<?php 
    include "layout/footer.php";
?>
</body>