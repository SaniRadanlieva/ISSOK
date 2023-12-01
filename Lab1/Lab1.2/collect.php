<?php

if (isset($_POST['submit'])) {
//    echo $ime = $_GET['ime'];
    print($ime=$_GET['ime']);
    echo "<br>";
    echo $prezime = $_GET['prezime'];
    echo "<br>";
    echo $email = $_GET['email'];
    echo "<br>";
    echo $pol = $_GET['pol'] == '1' ? 'masko' : 'zensko';
    echo "<br>";
}




