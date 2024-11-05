<?php
    checkAuthentication();
    $blog_id = intval($_GET['blog_id']);
    $query = "SELECT * FROM blogs WHERE blog_id = '$blog_id'  ";
    $result = $conn->query($query);
    $user_id = getUserId();
    if ($result === false) {
        die("Error fetching blogs: " . $conn->error);
    }

    $blog = $result->fetch_assoc();
?>
<div>
    <h5><?= $blog['title']; ?></h5>
    <p><em>Created At: <?= $blog['created_at']; ?></em></p>
    <p><?= $blog['content']; ?></p>
    <?php if (!empty($blog['avatar_path'])): ?>
        <img src="<?= $blog['avatar_path']; ?>" alt="Blog Avatar" style="width:100px; height:auto;">
    <?php endif; ?>
</div>
<?php if ($user_id == $blog['user_id']): ?>
    <div style="margin-top: 10px">
        <a href="?page=./module/blog&action=delete&blog_id=<?= $blog_id ?> " onclick="return confirm('Are you sure?')" class="btn btn-primary">Delete</a>
        <a href="?page=./module/blog&action=update&blog_id=<?= $blog_id ?>" class="btn btn-primary">Update</a>
    </div>
<?php endif ?>

<?php include './module/comment/create.php' ?>
<?php include './module/comment/read.php' ?>
