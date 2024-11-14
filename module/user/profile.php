<?php 
    $user_id = getUserId();
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = htmlspecialchars($_POST['email']);
        $phone_number = htmlspecialchars($_POST['phone_number']);
        $address = htmlspecialchars($_POST['address']);
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $avatar_path = "uploads/avatars/".uniqid().'.'.$extension;

        $query = "UPDATE users SET email= '$email', phone_number='$phone_number', address='$address', avatar_path='$avatar_path' WHERE user_id = $user_id";
        $result = $conn->query($query);
        if ($result == true) {
            move_uploaded_file($_FILES["avatar"]["tmp_name"],$avatar_path);
            echo "<script>alert('Update success')</script>";
            header("Location: index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="container">
            <h3>Update Profile</h3>
            <div class="mb-3">
                <label for="email"><b>Email</b></label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone"><b>Phone Number</b></label>
                <input type="text" name="phone_number" value="<?php echo $row['phone_number']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="address"><b>Address</b></label>
                <input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="avatar"><b>Avatar</b></label>
                <?php if (!empty($row['avatar_path'])): ?>
                     <img src="<?php echo ($row['avatar_path']); ?>" alt="Avatar Blog" style="width:100px; height:auto;">
                <?php endif; ?>
                <input type="file" name="avatar" class="form-control mt-2" accept="image/*" required>
                <input type="hidden" name="existing_avatar" value="<?php echo ($row['avatar_path']); ?>">
            </div>
            <div class="mb-3">
                <input type="submit" name="update" class="btn btn-primary" value="Update">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
</form>

