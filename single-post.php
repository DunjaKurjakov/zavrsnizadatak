<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "Blog_Dunja_Zavrsni";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

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

<body class="va-l-page va-l-page--single">

    <?php include('header.php'); ?>

<main role="main" class="container">

        <div class="col-sm-8 blog-main">

            <?php
                if (isset($_GET['post_id'])) {
            
                $sql = "SELECT id, title, body, author, created_at FROM posts WHERE id = {$_GET['post_id']}";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $singlePost = $statement->fetch();

                }
            ?>

            <article class="va-c-article">
                <header>
                    <h1><?php echo ($singlePost['title']) ?></h1>
                    <div class="va-c-article__meta"><?php echo($singlePost['created_at']) ?> <?php echo($singlePost['author']) ?></div>
                </header>

                <div>
                    <p><?php echo ($singlePost['body']) ?></p>
                </div>
                        
            </article>

        </div>

    <?php include('sidebar.php'); ?>

</main>
     
    <?php include 'footer.php'; ?>

</body>

</html>