<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Premium Picture Gallery</title>

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
          <a class="navbar-brand" href="#">Image Gallery</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="gallery.php">Gallery</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="center-div">
        <h1>Premium Image Gallery</h1>
        <p class="lead">Try it now! Paste a URL into the text field and upload an image! As this is a free version only the last image is stored!</p>
	<form method="post" action="" class="navbar-form navbar-center">
         <input type="text" class="form-control" style="width:400px" name="url" placeholder="http://example.org/test.jpg">
         <input type="submit" class="btn btn-primary" name="submit" value="Add >>">
        </form>


        <?php
          if (array_key_exists("url", $_POST)){
            echo "<img src='image.php?url=".htmlspecialchars($_POST['url'])."'>";
          }
        
        ?>





      </div>

    </div>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

