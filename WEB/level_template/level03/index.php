<?php
  //TODO: change this URL
  require("../bot_backend/addURL.php");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>311337 Web site</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        padding-top: 50px;
      }
      
      .center-div {
        padding: 40px 15px;
        text-align: center;
      }

    </style>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BugHunt3r1337</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="center-div">
        <h1>Bug Bounty Hunter</h1>
        <p class="lead">Hi Visitor!<br/><br /> I am <b>BugHunt3r1337</b>! Lately, I discovered that some stupid companies pay money for bugs! With my 1337 h4ck3r skills I will make tons of money. muhahahaha.....</p>
        <p class="lead">
          You can help me to increase my revenue! I am very interested in all kinds of information arround something called XSS! If you have interesting literature, post me a link:
        <div style="display:inline-block">
          <form method="get" action=""  class="navbar-form navbar-center">
            <div class="center input-group">
            <input type="text" name="link" class="form-control" style="width:200px" placeholder="https://chromium.googlesource.com/chromium/blink.git/+/6e1b3ebf966af4cabed3fa017ce507c6831b6786">
            <input type="submit" value="send" class="btn btn-primary" style="margin-left:5px">
            </div>
          </form>
        </div>
        <p class="lead">
        <?php
           if(array_key_exists("link", $_GET)){
             echo "Thank you for posting a <a href='".$_GET["link"]."'>link</a>! I will have a look at it soon!";
             saveURL($_GET["link"], $mysqli);
           }

        ?>
        </p>
      </div>

    </div>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

