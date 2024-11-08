<?php   
    if(isset($_SESSION['session'])){
        echo "Welcome, ".$_SESSION['session'];
    }
    $sql = "SELECT * FROM blogs ORDER BY created_at ASC";
    $result=$conn->query($sql);  
?>

<h2>List Blog</h2>
<a href="?page=./module/blog&action=create" class="btn btn-primary">Create Blog</a>
<?php while ($row = $result->fetch_assoc()): ?>
    <div class="blog-post" onclick="window.location.href='?page=./module/blog&action=read&blog_id=<?= ($row['blog_id']); ?>'" >
    <h4><?=($row['title']); ?></h4>
    <p><em>Created At: <?= ($row['created_at']); ?></em></p>
    <p><?= ($row['content']); ?></p>
    <?php if (!empty($row['avatar_path'])): ?>
        <img src="<?= ($row['avatar_path']); ?>" alt="Blog Avatar" style="width:100px; height:auto;">
    <?php endif; ?>
    <hr>
    </div>
<?php endwhile; ?>

