<?

if(isset($_POST['user'])){
    if ($_POST['user']=="admin"){
        setcookie("admin","a47cccd7dacec4c59dc2a4c4a943d9df_42".time());
        setcookie("guest", "");
        echo "you are now admin";
    }else{
        echo "wrong password";
    }
}
?>
<form method="post" target="login.php">user<input name="user">
password<input type="password" name="password">
    <input type="submit" value="Login">
</form>