<?php


$sql = "SELECT id, title, body, author, created_at FROM posts ORDER BY created_at DESC " ;

$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$posts = $statement->fetchAll();


?>
    <div class="col-sm-8 blog-main">

    <?php
        foreach ($posts as $post) {
    ?>

        <article class="va-c-article">
            <header>
                <h1><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h1>
                <div class="va-c-article__meta"><?php echo($post['created_at']) ?> by <?php echo($post['author']) ?></div>
            </header>

            <div>
                <p><?php echo($post['body']) ?></p>
            </div>
        </article>

       <?php
           }
       ?>
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div>

</html>