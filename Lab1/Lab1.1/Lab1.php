<?php

//Izraboteno od Sani Radanlieva, 203120

//Vezba 1.1 - Definiranje na polinja

$numerickoPole = array(2, 5, 6, 10, 41, 24, 32, 9, 16, 19);

$asocijativnoPole = array("Sani" => 'Sani', "Radanlieva" => 'Radanlieva', "Gevgelija" => 'Gevgelija');

$povekedimenzionalno = array(
    array(1,0,1),
    array(0,1,0),
    array(1,0,1)
);

echo $numerickoPole[1];
echo "<br>";

//Vezba 1.2 - Izminuvanje na polinja

foreach($numerickoPole as $value)
{
    echo $value . " ";
}
echo "<br>";

//Vezba 1.3 - Izminuvanje na polinja i dodavanje vo novo pole

$push = array();

foreach($numerickoPole as $value)
{
    echo $value . " ";
    if($value > 20){
        array_push($push, $value);
    }
}

echo "<br>";

foreach ($push as $value)
{
    echo $value . " ";
}

echo "<br>";

//Vezba 1.4 - Dolzina na string

$recenica = "PHP is a widely-used general-purpose scripting language that is especially suited for Web development";
$zborovi = explode(" ", $recenica);
$dolzinaZborovi = array();

foreach ($zborovi as $key => $value)
{
    $dolzinaZborovi[$value] = strlen($value);
}

echo $recenica;
echo "<br>";

foreach ($dolzinaZborovi as $key => $value)
{
    echo $key . "=>" . $value . "<br>";
}
