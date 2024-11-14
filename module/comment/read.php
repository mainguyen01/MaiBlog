<?php
    checkAuthentication();
    $blog_id = intval($_GET['blog_id']);
    $query = "SELECT comments.comment_id, comments.content, comments.user_id, comments.blog_id, comments.created_at FROM `comments`  INNER JOIN     `users`  ON comments.user_id = users.user_id WHERE blog_id = '$blog_id' ORDER BY comments.created_at ASC";
    $result = $conn->query($query);
    $user_id = getUserId();
?>

<?php while ($row = $result->fetch_assoc()): ?>
    <h4><?= $row['content'] ?></h4>
    <p><em>Created At: <?= ($row['created_at']); ?></em></p>
    <?php if ($user_id == $row['user_id']): ?>
        <div style="margin-top: 10px">
            <div style="margin-top: 10px">
                <a href="?page=./module/comment&action=delete&blog_id=<?= $blog_id ?>&comment_id=<?= $row['comment_id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-primary">Delete</a>
                <a href="?page=./module/comment&action=update&blog_id=<?= $blog_id ?>&comment_id=<?= $row['comment_id'] ?>" class="btn btn-primary">Update</a>
            </div>
        </div>
    <?php endif ?>
<?php endwhile ?>