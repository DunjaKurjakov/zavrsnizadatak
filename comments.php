<?php

$postId = $_GET['id'];
$sql = "SELECT * FROM comments WHERE post_id = {$postId}" ;
$statement = $connection->prepare($sql);

$statement->execute();

$statement->setFetchMode(PDO::FETCH_ASSOC);

$comments = $statement->fetchAll();

?>
<div id="comments">
    <strong><p>Comments<p></strong>
        <ul>
            <?php foreach ($comments as $comment) { ?>
                
                <li>
                    <strong><div><?php echo $comment['author']; ?></div></strong>
                    <div><?php echo $comment['text']; ?></div>
                    <hr>
                    
                </li>
            <?php } ?>
        </ul>
</div>


<!-- <script>
function myFunctionChange() {
    
   if (document.getElementById("myButton1").innerHTML === "Hide comments"){
    document.getElementById("myButton1").innerHTML = "Show comments";
    document.getElementById("comments").style.display = 'none';

   } else {
    document.getElementById("myButton1").innerHTML = "Hide comments" ;
    document.getElementById("comments").style.display = 'block';
   }

   
} 
</script> -->