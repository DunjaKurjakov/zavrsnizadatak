<?php
    
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "Blog_Dunja_Zavrsni";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

<?php

if (!empty($_POST['author']) && !empty($_POST['comment'])) {
    $postId = $_POST['post_id'];
    $author = $_POST['author'];
    $text = $_POST['comment'];
    $sql = "INSERT INTO comments (author, text, post_id) VALUES ('$author', '$text', '$postId');";
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location: http://localhost:8080/single-post.php?id=$postId");
} else {
    header("Location: http://localhost:8080/single-post.php?id=$postId&error=required");
}
?>