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
$mail = $_POST['mail'];
if    (!$_FILES)
{
    $avatar    = "avatars/net-avatara.jpg";
}
else{


    $path_to_90_directory    = 'avatars/';

    if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/',$_FILES['fupload']['name']))
    {
        $filename =    $_FILES['fupload']['name'];
        $source =    $_FILES['fupload']['tmp_name'];
        $target =    $path_to_90_directory . $filename;
        move_uploaded_file($source,    $target);
        if(preg_match('/[.](GIF)|(gif)$/',    $filename)) {
            $im    = imagecreatefromgif($path_to_90_directory.$filename) ;
        }
        if(preg_match('/[.](PNG)|(png)$/',    $filename)) {
            $im =    imagecreatefrompng($path_to_90_directory.$filename) ;
        }

        if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/',    $filename)) {
            $im =    imagecreatefromjpeg($path_to_90_directory.$filename);
        }

        $w    = 240;
        $w_src    = imagesx($im);
        $h_src    = imagesy($im);
        $dest = imagecreatetruecolor($w,$w);

        if    ($w_src>$h_src)
            imagecopyresampled($dest, $im, 0, 0,
                round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                0, $w, $w,    min($w_src,$h_src), min($w_src,$h_src));

        if    ($w_src<$h_src)
            imagecopyresampled($dest, $im, 0, 0,    0, 0, $w, $w,
                min($w_src,$h_src),    min($w_src,$h_src));

        if ($w_src==$h_src)
            imagecopyresampled($dest,    $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);
        $date=time();
        imagejpeg($dest,    $path_to_90_directory.$date.".jpg");
        $avatar    = $path_to_90_directory.$date.".jpg";
        $delfull    = $path_to_90_directory.$filename;
        unlink    ($delfull);
    }
    else
    {

        exit ("Аватар должен быть в    формате <strong>JPG,GIF или PNG</strong>");
    }

}
include ("clases/database.php");

$result = $mysqli->query("SELECT id FROM users WHERE username='$login'");
$myrow = $result->fetch_assoc();
if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
}

$result2 = $mysqli->query("INSERT INTO users (username, password, email, avatar) VALUES ('$login','$password','$mail','$avatar')");
if ($result2=='TRUE')
{
    $_SESSION['login']=$login;
    header('Location: index.php');

}
else {
    echo "Ошибка! Вы не зарегистрированы.";
}
?>