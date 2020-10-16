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
if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['body'])) {
    $author = $_POST['author'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $sql = "INSERT INTO posts (title, body, author) VALUES ('$title', '$body', '$author');";
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location: http://localhost:8080/index.php");
} else {
    header("Location: http://localhost:8080/createPost.php?error=required");
}
?>