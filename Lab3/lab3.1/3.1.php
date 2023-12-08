<?php
$prva = fopen("prva.txt", "r");
$vtora = fopen("vtora.txt" , "r");
$rezultat = fopen("rezultat.txt", "w");

$prvaRead = fread($prva, filesize("prva.txt"));
$prvaChanged = str_replace("-", " ", $prvaRead);

fwrite($rezultat, $prvaChanged);
$vtoraRead = fread($vtora, filesize("vtora.txt"));
fwrite($rezultat, $vtoraRead);
