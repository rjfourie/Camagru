<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
</head>
<h1>Gallery</h1>
<body>

<?php
 require_once 'config/setup.php';
 session_start();
 
 try
 {
    $stmt = "SELECT * FROM gallery ORDER BY id DESC";
    $res = $connection->query($stmt);

    $i = 0; 
    while ($new = $res->fetch())
    {
        echo "<div>";
        echo "<img src=\"".$new['img']."\" alt=\"\" class='gallery' width='400' height='300'>";
        $pidi = $new['id'];
        $comme = "SELECT comment FROM comments WHERE img_id = $pidi";
        $commen = $connection->query($comme);
        $j = 0;

        while($comments = $commen->fetch())
        {
            // echo "<br>";
            echo $comments[$j];
        }
         echo "<input type='hidden' value=\"".$new['id']."\">";
         echo '<input class="txtcmmnt" type="text" name="comm" placeholder="write a comment">';
         echo '<button class="btncomment">Comment</button>';
         echo '<button class="btnlike">like</button>';
         echo "<input type='hidden' value=\"".$new['c_id']."\" name='c_id'>";
         echo '<input type="submit" name="delete" value="Delete" id="delete">';





         $i++;
         echo "</div>";
        }
    }
   catch(PDOException $e)
   {
       echo "error".$e->getMessage();
   }
   ?>
   <?php
   if((isset($_POST['comment_button'])) && (!empty($_SESSION['username']))){ 
       $name = $_POST['name'];
       $c_id = $_POST['c_id'];
       $comment = $_POST['comm'];
       $username = $_SESSION['username'];
       $email = $


       $res = $connection->prepare("SELECT * FROM `images` WHERE c_id='$c_id'");
       $res->execute();

       $data = $res->fetch(PDO::FETCH_ASSOC); 
       $user_id = $data['user_id'];

       $res = $connection->prepare("SELECT * FROM `users` WHERE `id`='$user_id'");
       $res->execute();
       
       $data = $res->fetch(PDO::FETCH_ASSOC); 
       $notify = $data['notify'];

       $insert = $connection->prepare("INSERT INTO comments(name, img_id, comment) VALUES('$name', '$c_id','$comment')");
       $insert->execute();
       if ($notify == 1){
        $stmt = "SELECT `email` FROM `user_info` WHERE `username`='$username'";
        $email = $connection->query($stmt);

        $subject = "Content: Image commented";
        $headers = "From: Camagru@rfourie.co.za \r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail("$email", "$subject", $comment, "$headers");
       }
        else {
            header ("location: gallery.phtml");
        }

    }
    if((isset($_POST['like'])) && (!empty($_SESSION['email']))){
        $c_id = $_POST['c_id'];
        $like = $connection->prepare("UPDATE images SET likes=+1 WHERE c_id ='$c_id'");
        $like->bindParam(":c_id",$c_id,PDO::PARAM_INT);
        $like->execute();
    }
    if((isset($_POST['delete'])) && (!empty($_SESSION['email']))){ 
        $c_id = $_POST['c_id'];
        $del = $connection->prepare("DELETE FROM images WHERE c_id='$c_id'");
        $del->bindParam(":c_id",$c_id,PDO::PARAM_INT);
        $del->execute();
    }
?>

<script src="js/likecmnt.js"></script>
</body>
</html>