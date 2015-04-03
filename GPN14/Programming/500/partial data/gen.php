<?php
$salt ="Alexistirgendwienenn00b,abericheristtrotzdemcool";
echo "<?php\n\n\$filearray = array(\n";
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != 'gen.py' && $file != 'gen2.py' && $file != 'files.inc.php') {

            echo '"'.substr(md5($file.rand(0,1000000).$salt),0,16).'"=>"data/files/'.$file.'"),'."\n";
        }
    }
    closedir($handle);
}
echo ");\n?>";

?>