<?php
$key="sqrts{".md5("Butterblumenkuchen")."}";
/**
 * Created by PhpStorm.
 * User: floatec
 * Date: 02.06.14
 * Time: 17:58
 */

if(isset($_COOKIE['admin'])){
    $cookieTime=substr(@$_COOKIE['admin'],35);
    if(substr(@$_COOKIE['admin'],0,32)=="a47cccd7dacec4c59dc2a4c4a943d9df"&&$cookieTime<=time()AND $cookieTime>=time()-360){
        echo "You are a an admin<br>";
        echo $key."<br>";
        setcookie("admin","a47cccd7dacec4c59dc2a4c4a943d9df_42".time());
    }else{
        echo 'session expired<br>please login <a href="login.php">here</a>';
        setcookie("admin","");
        setcookie("guest","cb9e7954eb2bbc8ffa77f138a4d3e61a_".time());
    }
    if(isset($_COOKIE['admin'])){
        echo "<br>last page call:".date("c",substr($_COOKIE['admin'],35));
    }
}else{
    setcookie("guest","cb9e7954eb2bbc8ffa77f138a4d3e61a_".time());
    echo 'You are a an normal user<br>please login <a href="login.php">here</a>';
    if(isset($_COOKIE['guest'])){
        echo "<br>last page call:".date("c",substr($_COOKIE['guest'],33));
    }
}
?>

