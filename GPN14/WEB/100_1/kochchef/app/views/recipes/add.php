
<?php
if(isset($error)){
	foreach($error as $error){
		echo "<p>$error</p>";
	}
}
?>

<form action='' method='post'>

<p>Name<br /><input type='text' name='name' value='<?php echo $_POST['name'];?>'></p>
<p>Beschreibung<br /><textarea  name='beschreibung'><?php echo $_POST['beschreibung'];?></textarea></p>
<p>Zutaten<br /><textarea  name='zutaten'><?php echo $_POST['zutaten'];?></textarea></p>
<p><input type='submit' name='submit' value='Submit'></p>

</form>