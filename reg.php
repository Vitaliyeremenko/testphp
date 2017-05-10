<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
</head>
<body>
<h2>Регистрация</h2>
<form action="save_user.php" method="post" enctype="multipart/form-data">

    <p>
        <label>Ваш логин:<br></label>
        <input name="login" type="text" size="15" maxlength="15">
    </p>
    <p>
        <label>Ваш пароль:<br></label>
        <input name="password" type="password" size="15" maxlength="15">
    </p>
    <p>
        <label>Ваш почта:<br></label>
        <input name="mail" type="text" >
    </p>

    <p>
        <label>Выберите аватар. Изображение должно быть формата jpg, gif или png:<br></label>
        <input type="FILE" name="fupload">
    </p>

    <p>
        <input type="submit" name="submit" value="Зарегистрироваться">

    </p></form>
</body>
</html>