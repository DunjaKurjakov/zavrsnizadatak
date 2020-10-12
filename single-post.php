<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "vivify_blog";

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

    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="va-l-page va-l-page--single">

<?php include('header.php'); ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php
                if (isset($_GET['post_id'])) {

                    // pripremamo upit
                    $sql = "SELECT posts.id, posts.title, posts.created_at, posts.content, posts.user_id, profiles.first_name as author FROM posts left join profiles on posts.user_id = profiles.user_id WHERE posts.id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);

                    // izvrsavamo upit
                    $statement->execute();

                    // zelimo da se rezultat vrati kao asocijativni niz.
                    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                    $statement->setFetchMode(PDO::FETCH_ASSOC);

                    // punimo promenjivu sa rezultatom upita
                    $singlePost = $statement->fetch();

                    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                        // echo '<pre>';
                        // var_dump($singlePost);
                        // echo '</pre>';

            ?>

                    <article class="va-c-article">
                        <header>
                            <h1><?php echo $singlePost['title'] ?></h1>

                            <h3><?php echo $singlePost['category'] ?></h3>

                            <div class="va-c-article__meta"><?php echo($singlePost['created_at']) ?> <?php echo($singlePost['author']) ?></div>
                        </header>

                        <div>
                            <p><?php echo $singlePost['content'] ?></p>
                            
                        </div>

                        <footer>
                        <?php
                        $sql = "SELECT tags.title FROM posts right join posts_tags_relation on posts.id =posts_tags_relation.post_id right join tags on posts_tags_relation.tag_id = tags.id WHERE posts.id = :post_id";
                        $statement = $connection->prepare($sql);
                        $statement->bindParam(':post_id', $_GET['post_id']);
                        // izvrsavamo upit
                        $statement->execute();
                        // zelimo da se rezultat vrati kao asocijativni niz.
                        // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
                        // punimo promenjivu sa rezultatom upita
                        $tags = $statement->fetchAll();

                        ?>

                            <h3>tags:
                            <?php
                                foreach ($tags as $tag) {
                            ?>
                                <!-- zameniti testne tagove sa pravim tagovima blog post-a iz baze -->
                                <a><?php echo($tag['title']) ?></a>
                            </h3>
                        </footer>
                        <?php
                }
            ?>

                        <div class="comments">
                        <?php
                        $sql = "SELECT content, created_at FROM comments right join users on user.id =comments.user_id right join tags on posts_tags_relation.tag_id = tags.id WHERE posts.id = :post_id";
                        $statement = $connection->prepare($sql);
                        $statement->bindParam(':post_id', $_GET['post_id']);
                        // izvrsavamo upit
                        $statement->execute();
                        // zelimo da se rezultat vrati kao asocijativni niz.
                        // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                        $statement->setFetchMode(PDO::FETCH_ASSOC);
                        // punimo promenjivu sa rezultatom upita
                        $comments = $statement->fetchAll();

                        ?>
                            <h3>comments</h3>

                            <!-- zameniti testne komentare sa pravim komentarima koji pripadaju blog post-u iz baze -->
                            <div class="single-comment">
                                <div>posted by: <strong>Pera Peric</strong> on 15.06.2017.</div>
                                <div>Provident ut harum temporibus impedit odio quam amet accusamus ad quisquam velit
                                    incidunt praesentium cupiditate consectetur repellendus, fugiat quidem, officiis
                                    laudantium autem possimus ullam minima adipisci itaque? Eos, minus!
                                </div>
                            </div>
                            <div class="single-comment">
                                <div>posted by: <strong>Mitar Miric</strong> on 18.06.2017.</div>
                                <div>Incidunt praesentium cupiditate consectetur repellendus, fugiat quidem, officiis
                                    laudantium autem possimus ullam minima adipisci itaque? Eos, minus!
                                </div>
                            </div>
                            <div class="single-comment">
                                <div>posted by: <strong>Dule Savic</strong> on 20.06.2017.</div>
                                <div>Jedna je Crvena Zvezda!</div>
                            </div>
                        </div>
                    </article>

            <?php
                } else {
                    echo('post_id nije prosledjen kroz $_GET');
                }
            ?>

        </main>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>