<?php
session_start();
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

if (empty($login) or empty($password))
{
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
}

$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);

$login = trim($login);
$password = trim($password);

include ("clases/database.php");

$result = $mysqli->query("SELECT * FROM users WHERE username='$login'");
$myrow = $result->fetch_assoc();

if (empty($myrow['password']))
{
        exit ("Извините, введённый вами login или пароль неверный.");
}
else {

    if ($myrow['password']==$password) {
               $_SESSION['login']=$myrow['username'];
        $_SESSION['id']=$myrow['id'];
        header('Location: index.php');
    }
    else {
        exit ("Извините, введённый вами login или пароль неверный.");
    }
}
?>