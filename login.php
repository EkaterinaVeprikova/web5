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

session_start();

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.

/*print($_SESSION['login']);
if (!empty($_SESSION['login'])) {
  header('Location: index.php');
}*/

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_SESSION['login'])) {
  header('Location: index.php');
  }else{
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
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {

  // TODO: Проверть есть ли такой логин и пароль в базе данных.
  // Выдать сообщение об ошибках.
  $l=$_POST['login'];
  $p=$_POST['pass'];
  $uid=0;
  $error=TRUE;
  $user = 'u47560';
  $pass = '7678381';
  $db1 = new PDO('mysql:host=localhost;dbname=u47560', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  if(!empty($l) and !empty($p)){
    try{
      $chk=$db1->prepare("select * from username where login=?");
      $chk->bindParam(1,$l);
      $chk->execute();
      $username=$chk->fetchALL();
      if(password_verify($p,$username[0]['pass'])){
        $uid=$username[0]['id'];
        $error=FALSE;
      }
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
  }
  if($error==TRUE){
    print('Неправильные логин или пароль <br> Если вы хотите создать нового пользователя <a href="index.php">назад</a> или попытайтесь войти снова <a href="login.php">войти</a>');
    session_destroy();
    exit();
  }
  // Если все ок, то авторизуем пользователя.
  $_SESSION['login'] = $l;
  // Записываем ID пользователя.
  $_SESSION['uid'] = $uid;
  // Делаем перенаправление.
  header('Location: index.php');
}
