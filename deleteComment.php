<?php
include 'db.php';
$postId = $_POST['post_id'];
$commentId = $_POST['comment_id'];
$sql = "DELETE FROM comments WHERE id = '$commentId';";
$statement = $connection->prepare($sql);
$statement->execute();

header("Location: http://localhost:8080/single-post.php?post_id=$postId");
?>