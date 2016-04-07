<?php
// Страница авторизации
# Соединямся с БД
require_once 'mysqlconnect.php';

if(isset($_SESSION['user_login']))
    die('уже авторизован!<br> <a href="logout.php">Выход</a> <br> <a href="check.php">Заметки</a>');

if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysql_query("SELECT user_id, user_password, user_login FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");
    $data = mysql_fetch_assoc($query);
    # Сравниваем пароли
    if($data['user_password'] === md5($_POST['password']))
    {
        # Переадресовываем браузер на страницу проверки нашего скрипта
        $_SESSION['user_login'] = $data['user_login'];
        $_SESSION['user_id'] = $data['user_id'];
        header("Location: check.php");
        exit;
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<form method="POST">
Логин <input name="login" type="text"><br>
Пароль <input name="password" type="password"><br>
<input name="submit" type="submit" value="Войти">
</form>
