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
    <div class="row">
        <div class="col-sm-8 blog-main">

            <?php

                $sql = "SELECT * FROM posts WHERE id = {$_GET['id']};";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $singlePost = $statement->fetch();


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
        <?php
            $error = '';
            if (!empty($_GET['error'])) {
                $error = 'All fields are required';
            }
        ?>

        <div class="comments">
            <?php
                $sql = "SELECT * FROM comments WHERE post_id={$_GET['id']}";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $comments = $statement->fetchAll();
            ?>
                <h3>comments</h3>
                    
                    <div class="single-comment">
                        <p><?php echo ($comments['text']) ?></p>
                    </div>
                            
        </div>

        <?php if (!empty($error)) { ?>
            <span class="alert alert-danger"><?php echo $error; ?></span>
        <?php } ?>

        <form action= "createComment.php" method ="post">
            <div class="form-group">
                <input type="text" name="author"placeholder = "Author" class="form-control">
            </div>

            <div class="form-group">
                <textarea name="comment" rows="3" cols="20" placeholder="Comment "class="form-control"></textarea>
            </div>

            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="post_id">
            <input type="submit" value="Submit" class="btn btm-primary">
        </form>
        <?php include('comments.php'); ?>

        </div>

        <?php include('sidebar.php'); ?>

    </div>

</main>

    <?php include 'footer.php'; ?>

</body>

</html>