<?php
error_reporting(E_ERROR);
$time = 1;
$key = "sqrts{".md5("Wurstsuppe")."}";
session_start();
if(isset($_SESSION['time']) AND $_SESSION['time']+$time< $_SERVER['REQUEST_TIME']){
    echo '<div style="background-color: red;color: white">to slow</div>';
}else{
    if (isset($_SESSION['r']) AND $_POST['r']==$_SESSION['r'] AND $_POST['g']==$_SESSION['g']  AND $_POST['b']==$_SESSION['b'] ){
        echo '<div style="background-color: green;color: white">'.$key.'</div>';
    }else{
        if(isset($_POST['r'])){
            session_unset();
            echo '<div style="background-color: red;color: white">wrong color</div>';
        }
    }
}
?>
<img src="image.php">
<form method="post">
    R<input name="r"><br>
    G<input name="g"><br>
    B<input name="b"><br>
    <input type="submit" value="Send">
</form>