<?php
//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
include "clases/database.php";
if($_GET){
    if(!isset($_GET['sort']) && !isset($_GET['page'])){
        $username = $_SESSION['login'];
        $task = $_GET['message'];
        $result2 = $mysqli->query("INSERT INTO tasks (username, task, state) VALUES ('$username','$task',0)");
        if ($result2=='TRUE')
        {
            header('Location: index.php');
        }
        else {
            echo "Ошибка! Вы не зарегистрированы.";
        }
    }
}

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Главная страница</title>
</head>
<link rel="stylesheet" href="css/style.css">
<body>

<h2>Главная страница</h2>

<?php
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
    echo "<form action=\"testreg.php\" method=\"post\">
    <p>
        <label>Ваш логин:<br></label>
        <input name=\"login\" type=\"text\" size=\"15\" maxlength=\"15\">
    </p>

    <p>

        <label>Ваш пароль:<br></label>
        <input name=\"password\" type=\"password\" size=\"15\" maxlength=\"15\">
    </p>

    <p>
        <input type=\"submit\" name=\"submit\" value=\"Войти\">

        <br>
 
        <a href=\"reg.php\">Зарегистрироваться</a>
    </p></form>
<br>";


    echo "Вы вошли на сайт, как гость<br></a>";
}
else
{

    echo "Вы вошли на сайт, как ".$_SESSION['login']."<br>";
    echo "<br><a href='exit.php'>Выход</a>";
    if(!isset($_GET['sort'])){
        include ("list.php");
    }
    else {
        if($_GET['sort'] == 'name'){
            include ("sort_name.php");
        }
        if($_GET['sort'] == 'state'){
            include ("sort_state.php");
        }
        if($_GET['sort'] == 'mail'){
            include ("sort_mail.php");
        }
    }

}

?>
</body>
<script src="js/script.js"></script>
</html>