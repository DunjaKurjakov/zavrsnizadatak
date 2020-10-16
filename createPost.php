<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.ico">
    <title>Vivify Academy Blog - Homepage</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body class="va-l-page va-l-page--homepage">

<?php
    include('header.php');
?>

<main role="main" class="container">

    <div class="row">
        <?php
            $error = '';
            if (!empty($_GET['error'])) {
                $error = 'All fields are required';
            }
        ?>

        <?php if (!empty($error)) { ?>
        <span class="alert alert-danger"><?php echo $error; ?></span>
        <?php } ?>
        <form action="createPostAction.php" method="POST">
            <div class="form-group">
                <input type="text" name="author" placeholder="Author" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" name="title" placeholder="Title" class="form-control">
            </div>
            <div class="form-group">
                <textarea type="text" name="body" placeholder="Content" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit">
        </form> 
        
        <?php include 'sidebar.php' ?>
    </div>

<?php
    include('footer.php');
?>
</body>
</html>
<?php
if (!empty($_POST['author']) && !empty($_POST['message'])) {
    $author = $_POST['author'];
    $text = $_POST['message'];
    $sql = "INSERT INTO posts (title, body, author) VALUES ('$author', '$text', '$postId');";
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location: http://localhost:8080/index.php");
} else {
    $error = 'All fields are required';
}
?>