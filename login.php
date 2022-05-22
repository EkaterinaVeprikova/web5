<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// Начинаем сессию.
session_start();

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
if (!empty($_SESSION['login'])) {
  // Если есть логин в сессии, то пользователь уже авторизован.
  if(isset($_POST['exit'])){
  // TODO: Сделать выход (окончание сессии вызовом session_destroy()
  session_destroy();
  //при нажатии на кнопку Выход).
  header('Location: login.php');
  // Делаем перенаправление на форму.
  } else {
  header('Location: ./');}
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form action="" method="post">
  <label>
    Логин:<br />
    <input name="login" />
  </label><br />
  <label>
    Пароль:<br />
    <input name="pass" />
  </label><br />
  <input type="submit" value="Войти" />
</form>

<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
  $user = 'u47560';
  $pass = '7678381';
  $db = new PDO('mysql:host=localhost;dbname=u47560', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

  // TODO: Проверть есть ли такой логин и пароль в базе данных.
  $pass0 = $_POST['pass'];
  $log0 = $_POST['login'];
  $data = $db->query("SELECT * FROM form WHERE login = '$log0' AND pass='$pass0'");
  $res = $data->fetchALL();
  // Выдать сообщение об ошибках.

  // Если все ок, то авторизуем пользователя.
  if($res[0]['login']!=$log0 || $res[0]['pass']!=$pass0){
    echo 'Error: пользователь не существует!' ;
  } else{
    $_SESSION['login'] = $log0;
    $_SESSION['pass'] = $pass0;
    $_SESSION['uid'] = 123;

  // Делаем перенаправление.
  header('Location: ./');
}}
