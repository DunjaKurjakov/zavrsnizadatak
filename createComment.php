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
$postId = $_POST['post_id'];
if (!empty($_POST['author']) && !empty($_POST['message'])) {
    $author = $_POST['author'];
    $text = $_POST['message'];
    $sql = "INSERT INTO comments (author, text, post_id) VALUES ('$author', '$text', $postId);";
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location: http://localhost:8080/single-post.php?post_id=$postId");
} else {
    header("Location: http://localhost:8080/single-post.php?post_id=$postId&error=required");
}
?>