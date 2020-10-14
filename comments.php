<?php

$postId = $_GET['post_id'];
$sql = "SELECT id, author, text  FROM comments WHERE post_id = $postId" ;
$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$comments = $statement->fetchAll();

?>
<?php if (!empty($comments)) {?>
    <button class="btn btn-default" id=myButton1 onclick="myFunctionChange()" type="submit">Hide comments</button>

    <div id="comments">
    <strong><p>Comments<p></strong>
        <ul>
            <?php foreach ($comments as $comment) { ?>
                
                <li>
                    <strong><div><?php echo $comment['author']; ?></div></strong>
                    <div><?php echo $comment['text']; ?></div>
                    <hr>
                    <form action="deleteComment.php" method="POST">
                        <input type="hidden" value="<?php echo $_GET['post_id']; ?>" name="post_id">
                        <input type="hidden" value="<?php echo $comment['id']; ?>" name="comment_id">
                        <input type="submit" class="btn btn-default" id="delete" type="button" onclick="myFunctionDelete()" value="Delete comment" >
                    </form>
                </li>
            <?php } ?>
        </ul>
</div>
<?php } ?>

<script>
function myFunctionChange() {
    
   if (document.getElementById("myButton1").innerHTML === "Hide comments"){
    document.getElementById("myButton1").innerHTML = "Show comments";
    document.getElementById("comments").style.display = 'none';

   } else {
    document.getElementById("myButton1").innerHTML = "Hide comments" ;
    document.getElementById("comments").style.display = 'block';
   }

   
} 
</script>