<h1>Titre du main</h1>

<?php

$filesource = "/var/www/html/S06/S06-ochan-marine-spaak/public/assets/details/Pink-Lady_Description.txt";
$file = fopen($filesource, "r");
$filesize = filesize($filesource);
$filetext = fread($file, $filesize);
fclose($file);

echo ("<p> $filetext </p>");

?>