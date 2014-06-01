<?php
session_cache_limiter('nocache');
session_start();


$user = "pearce";
$password = "Elb%hzJ4GL=6/Y+7[AlNu\/uAnF>p:v#1ZdhkOWH";
$timediff = 1;
$flag ="sqrts{dd64a3798ae4423018d1fdeaa9a9ec26}";

if(isset($_POST) && !empty($_POST))
{
	$errarr = array();
	if ($_POST['user'] != $user || $_POST['password'] != $password)
	{
		$errarr['password'] = '<span class="help-block">Wrong username/password</span>';
	} else if (time() - $_SESSION['captchatime'] > $timediff) {
		$errarr['captcha'] = '<span class="help-block">captcha expired</span>';
	} else if ($_SESSION['captchatext'] != $_POST['captcha']) {
		$errarr['captcha'] = '<span class="help-block">wrong captcha</span>';
	} else {
		$errarr['flag'] = $flag;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<? if(isset($errarr['flag'])) { ?>
    <div class="container" style="margin-top:30px">
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Flag: </strong></h3></div>
  <div class="panel-body">
  	<?php echo $flag ?>
  </div>
</div>
</div>
</div>
<?php } else { ?>
    <div class="container" style="margin-top:30px">
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>Sign in </strong></h3></div>
  <div class="panel-body">
   <form role="form" method="post">
  <div class="form-group <?php echo (isset($errarr['password']) ? "has-error" : "") ?>">
    <label for="user">Username</label>
    <input type="text" class="form-control" style="border-radius:5px" name="user" id="user" placeholder="Enter username">
  </div>
  <div class="form-group <?php echo (isset($errarr['password']) ? "has-error" : "") ?>">
    <label for="password">Password <a href="#">(forgot password)</a></label>
    <input type="password" class="form-control" style="border-radius:5px" name="password" id="password" placeholder="Password">
    <?php echo (isset($errarr['password']) ? $errarr['password'] : "")?>
  </div>
    <div class="form-group <?php echo (isset($errarr['captcha']) ? "has-error" : "") ?>">
    <label for="captcha">Captcha </label>
    <p align="center"><img src="image.php" alt="captcha"></p>
    <input type="captcha" class="form-control" style="border-radius:5px" name="captcha" id="captcha" placeholder="Captcha">
    <?php echo (isset($errarr['captcha']) ? $errarr['captcha'] : "")?>
  </div>
  <button type="submit" class="btn btn-sm btn-default">Sign in</button>
</form>
  </div>
</div>
</div>
</div>
<?php } ?>
  </body>
</html>
