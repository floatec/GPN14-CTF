<?php
	//ini_set('display_errors', 1);
	
	$timediff = 5;


	session_cache_limiter('nocache');
	session_start();

function Size($bytes)
{
    if ($bytes > 0)
    {
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true)
        {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }

    return $bytes;
}


	include("data/files/files.inc.php");
	$q = '';

	if (isset($_REQUEST['q'])) {
		$q = $_REQUEST['q'];
		$_SESSION['q'] = $q;
	}
	$errarr = array();
	if (isset($_POST['captcha']))
	{
		if ($_SESSION['q'] != $q)
		{
			$errarr['captcha'] = '<span class="red">Unbekannter Fehler</span>';
		} else if (time() - $_SESSION['captchatime'] > $timediff) {
			$errarr['captcha'] = '<span class="red">Das Captcha ist leider abgelaufen</span>';
		} else if ($_SESSION['captchatext'] != $_POST['captcha']) {
			$errarr['captcha'] = '<span class="red">Sie haben das Captcha falsch eingegeben</span>';
		} else {
			
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename='.basename($filearray[$q]['file']));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Pragma: public');
			    header('Content-Length: ' . $filearray[$q]['size']);
			    /*ob_clean();
			    flush();*/
			    readfile($filearray[$q]['file']);
			    exit;
		}
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>SCS - Squareroots Cloud Service</title>
        <link href="main.css" rel="stylesheet" type="text/css">
        <link href="jquery-ui.css" rel="stylesheet" type="text/css">

    </head>

    <body>
    	<div id="header">
                        
            <div id="left">
                <div id="logo">
                    <a href="/"><img src="logo.gif" alt="" width="285" height="50" border="0"></a>
                </div>
            </div>
        </div>
        <div id="main" class="ui-corner-all">
            <div id="inner">
				<div id="download">
					<?php if (array_key_exists($q, $filearray)) { ?>
					<h1>DOWNLOAD</h1>
				    <hr>
				    <div>
				    <form action="download.php" method="post">
				    <input type="hidden" name="q" value="<?php echo $q; ?>">
    				<div id="file_facts"><h2>File: <span><?php echo basename($filearray[$q]['file']); ?></span></h2><div><span class="ui-icon ui-icon-calculator"></span><span class="name">Grösse:</span><span><?php echo Size($filearray[$q]['size']); ?></span></div><div><span class="ui-icon ui-icon-copy"></span><span class="name">md5:</span><span><?php echo $filearray[$q]['hash']; ?></span></div><div><span class="ui-icon ui-icon-clock"></span><span class="name">hochgeladen:</span><span><?php echo date('d.m.Y H:i',$filearray[$q]['date']); ?></span></div></div></div>
					

				    <div id="dl_captcha_c">
				        <div id="dl_captcha" class="ui-corner-all"><div><img src="image.php" alt="captcha"></div></br><div><input name="captcha" id="captcha" type="text" autocorrect="off" autocapitalize="off" placeholder="Geben Sie den angezeigten Text ein" autocomplete="off"></div></div>
				    </div>
					<div id="dl_ticket" style="display: block;"><div id="dll" style="margin: 0px; width: 500px;"><p><input type="image" src="download.png" alt="Captcha überprüfen"><br>Captcha überprüfen</a></p></div></div></form>

					<?php 
					if (isset($errarr['captcha'])) {
						echo '
					    <div id="dl_info" class="ui-widget">
					        <div class="ui-state-highlight ui-corner-all">
					            <p class="b">Fehler:</p>'.$errarr['captcha'].'</br>
					            </div>
					    </div>';
						}
					?>

    				<?php } else { ?>
    				<h1>Download nicht möglich</h1>
    				<hr>
    				<div id="dl_failure" class="ui-widget">
				        <div class="ui-state-highlight ui-corner-all">
				            <span class="ui-icon ui-icon-info"></span>
				            <p class="b">Information:</p>
				            <div>
				                                                    
				                <strong>Die angeforderte Datei konnte nicht gefunden werden!</strong>
				            </div>
				        </div>
				    </div><?php }; ?>
				</div>
			</div>
		</div>
   </body>
</html>