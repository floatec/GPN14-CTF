<html>
  <head>
    <title>Wiki</title>
  </head>
  <body>
    <p>
      As this Wiki contains all our trade-secrets, please enter a valid password!
    </p>

    <form method="get" action="">
      <input type="text" value="root" name="username"><br>
      <input type="password" name="password" maxlength="5"><br>
      <input type="submit" value="login">
    </form>

    <?php
     
      if(isset($_GET['username']) && $_GET['username'] == "root") {
        if(isset($_GET['password']) && $_GET['password'] == "ab135") {
          echo "The Secret Flag is sqrts{fa55d94816d5ccf89794a705913a361b}";       
        }else{
	  echo "The Password is wrong!";
	}
      } elseif(isset($_GET['username'])) {
        echo "This username does not exist";
      }
    ?>

  </body>
</html>
