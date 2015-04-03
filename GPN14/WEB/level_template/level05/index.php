<? include "conn.php"; ?>
<?
/**
Database layout
CREATE TABLE IF NOT EXISTS `challenge` (
  `id` varchar(32) NOT NULL,
  `phone` int(10) NOT NULL,
  `lv` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
**/
foreach ($_POST as $k => $v) {
	$_POST[$k] = addslashes($v);
}
if($_POST["lid"] && isset($_POST["lphone"]))
{
$q=mysql_fetch_array(mysql_query("select * from challenge where id='$_POST[lid]' and phone='$_POST[lphone]'"));

if($q["id"])
{
$flag="sqrts{292912f90e32b1615183918ffad6949f}";

echo("id : $q[id]<br>lv : $q[lv]<br><br>");

if($q["lv"]=="admin")
{
echo("<b>Flag is $flag</b><br><br>");
mysql_query("delete from challenge");
}

echo("<a href=index.php>back</a>");
exit();
}

}

if($_POST["id"] && $_POST["phone"])
{
if(strlen($_POST["phone"])>=20) exit("Access Denied");
if(eregi("admin",$_POST["id"])) exit("Access Denied");
if(eregi("load|admin|0x|#|hex|char|ascii|ord|from|select|union|infor|challenge",$_POST["phone"])) exit("Access Denied");

mysql_query("insert into challenge values('$_POST[id]',$_POST[phone],'guest')");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>squareroots secure Phonebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <span class="brand">squareroots secure Phonebook</span>
        </div>
      </div>
    </div>

    <div class="container">
	<h1>Welcome to squareroots secure Phonebook.</h1>
	<p>Feel free to login with your userID and phone number or insert your own entry!</p>
	<form class="well" method="post" action="index.php">
	<h3>Login</h3>
	<input type="text" style="width:200px;margin-bottom:5px" class="form-control" name="lid" placeholder="UserID">
	<input type="text" style="width:200px;margin-bottom:5px" class="form-control" name="lphone" placeholder="Phone#">
	<button type="submit" class="btn btn-primary">Login</button>
	<h3>Join</h3>
	<input type="text" style="width:200px;margin-bottom:5px" class="form-control" name="id" placeholder="UserID">
	<input type="text" style="width:200px;margin-bottom:5px" class="form-control" name="phone" placeholder="Phone#">
	<button type="submit" class="btn btn-primary">Join</button>
	<br /><br />
	<?php //<p class="text-info">If you are looking for hints: &quot;An expression expr can refer to any column that was set earlier in a value list.&quot;. Also, look at <b><a href="http://dev.mysql.com/doc/refman/5.0/en/string-functions.html">this</a></b>.</p>
//<br /><br />
 ?> 
 <p><small>We are all for open-source, you can therefore find the sourcecode <a href="index.phps">here</a></small></p>
    </div> <!-- /container -->

    <script src="./bootstrap/js/bootstra.min.js"></script>

  </body>
</html>

