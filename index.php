<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);

    // Выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены!';

    // Если в куках есть пароль, то выводим сообщение.
    if (!empty($_COOKIE['pass'])) {
      $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass']));
    }
  }
  

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year_of_birth'] = !empty($_COOKIE['year_of_birth_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['number_of_limbs'] = !empty($_COOKIE['number_of_limbs_error']);
  $errors['superpowers-3'] = !empty($_COOKIE['superpowers-3_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['policy'] = !empty($_COOKIE['policy_error']);
  
  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['name']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('name_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не заполнили имя!</div>';
  }
    if ($errors['email']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('email_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не заполнили e-mail!</div>';
  }
    if ($errors['year_of_birth']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('year_of_birth_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не выбрали год!</div>';
  }
    if ($errors['gender']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('gender_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не указали пол!</div>';
  }
      if ($errors['number_of_limbs']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('number_of_limbs_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не указали количество конечностей!</div>';
  }
      if ($errors['superpowers-3']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('superpowers-3_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не указали сверхспособности!</div>';
  }
      if ($errors['biography']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('biography_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не рассказали о себе!</div>';
  }
    if ($errors['policy']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('policy_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Вы не рассказали о себе!</div>';
  }
  // TODO: тут выдать сообщения об ошибках в других полях.

  
  
  
  // Складываем предыдущие значения полей в массив, если есть.
  // При этом санитизуем все данные для безопасного отображения в браузере.
  $values = array();

  $values['name'] = empty($_COOKIE['name_value']) ? '' : strip_tags($_COOKIE['name_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['year_of_birth'] = empty($_COOKIE['year_of_birth_value']) ? '' : strip_tags($_COOKIE['year_of_birth_value']);
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : strip_tags($_COOKIE['gender_value']);
  $values['number_of_limbs'] = empty($_COOKIE['number_of_limbs_value']) ? '' : strip_tags($_COOKIE['number_of_limbs_value']);
  $values['superpowers-3'] = empty($_COOKIE['superpowers-3_value']) ? '' : strip_tags($_COOKIE['superpowers-3_value']);
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : strip_tags($_COOKIE['biography_value']);
  $values['policy'] = empty($_COOKIE['policy_value']) ? '' : strip_tags($_COOKIE['policy_value']);
  // TODO: аналогично все поля.

    // Если нет предыдущих ошибок ввода, есть кука сессии, начали сессию и
    $f = FALSE;
    foreach($errors as $err){
    if(!empty($err)){
      $f = TRUE;
      break;
    }
    print($err);
  }
  // ранее в сессию записан факт успешного логина.
  if (empty($errors) && !empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
    // TODO: загрузить данные пользователя из БД
    // и заполнить переменную $values,
    // предварительно санитизовав.

    try {
      $user = 'u47560';
      $pass1 = '7678381';
      $db = new PDO('mysql:host=localhost;dbname=u47560', $user, $pass1, array(PDO::ATTR_PERSISTENT => true));
      $log1 = $_SESSION['login'];
      $pass24 = $_SESSION['pass'];
        $vhod = $db->query("SELECT * FROM form WHERE (login = '$log1' AND pass='$pass24')");  

        foreach ($vhod as $row) {
          $values['name'] = $row['name'];
          $values['email'] = $row['email'];
          $values['year_of_birth'] = $row['year_of_birth'];
          $values['gender'] = $row['gender'];
          $values['number_of_limbs'] = $row['number_of_limbs'];
          $values['superpowers-3'] = $row['superpowers-3'];
          $values['biography'] = $row['biography'];
          $values['policy'] = $row['policy'];
      }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    printf('Вход с логином %s', $_SESSION['login']);
  }

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['name'])) {
    // Выдаем куку на день с флажком об ошибке в поле name.
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['email'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }
  if ($_POST['year_of_birth'] == "default") {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('year_of_birth_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('year_of_birth_value', $_POST['year_of_birth'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['gender'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['number_of_limbs'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('number_of_limbs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('number_of_limbs_value', $_POST['number_of_limbs'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['superpowers-3'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('superpowers-3_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('superpowers-3_value', $_POST['superpowers-3'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['biography'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('biography_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['policy'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('policy_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('policy_value', $_POST['policy'], time() + 30 * 24 * 60 * 60);
  }

// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_of_birth_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('number_of_limbs_error', '', 100000);
    setcookie('superpowers-3_error', '', 100000);
    setcookie('biography_error', '', 100000);
    setcookie('policy_error', '', 100000);
    
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Проверяем меняются ли ранее сохраненные данные или отправляются новые.
  if (!empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
    // TODO: перезаписать данные в БД новыми данными,
    // кроме логина и пароля.
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['year_of_birth'];
    $gender = $_POST['gender'];
    $limbs = $_POST['number_of_limbs'];
    $superpowers = $_POST['superpowers-3'];
    $bio = $_POST['biography'];
    $policy = $_POST['policy'];

    $user = 'u47560';
    $pass1 = '7678381';

    $db = new PDO('mysql:host=localhost;dbname=u47560', $user, $pass1, array(PDO::ATTR_PERSISTENT => true));
    $log1 = $_SESSION['login'];
    $pass24 = $_SESSION['pass'];

    try { 
      $stmt = $db->prepare("UPDATE form SET name='$name',email='$email',date='$date',radio1='$gender',radio2='$limbs',power='$superpowers',bio='$bio',check1='$policy' WHERE login = '$login' AND pass='$pass2'");
      $stmt -> execute();
    }
    catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }
  }
  
  else {
    // Генерируем уникальный логин и пароль.
    // TODO: сделать механизм генерации, например функциями rand(), uniquid(), md5(), substr().
    $login = uniqid();
    $pass = rand();
    $pass2 = md5($pass);
    // Сохраняем в Cookies.
    setcookie('login', $login);
    setcookie('pass', $pass);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['year_of_birth'];
    $gender = $_POST['gender'];
    $limbs = $_POST['number_of_limbs'];
    $superpowers = $_POST['superpowers-3'];
    $bio = $_POST['biography'];
    $policy = $_POST['policy'];
  
    $user = 'u47560';
    $pass1 = '7678381';
    $db = new PDO('mysql:host=localhost;dbname=u47560', $user, $pass1, array(PDO::ATTR_PERSISTENT => true));

    // TODO: Сохранение данных формы, логина и хеш md5() пароля в базу данных.
    // ...
    try { 
      $stmt = $db->prepare("INSERT INTO form (name,email,date,gender,limbs,superpowers,bio,policy,hash,login,pass) VALUE(:name,:email,:date,:gender,:limbs,:superpowers,:bio,:policy,:hash,:login,:pass)");
      $stmt -> execute(['name'=>$name,'email'=>$email,'date'=>$date,'gender'=>$gender,'limbs'=>$limbs,'superpowers'=>$superpowers,'bio'=>$bio,'policy'=>$policy,'hash'=>$pass2,'login'=>$login,'pass'=>$pass]);
    }
    catch (PDOException $e) {
        print('Error : ' . $e->getMessage());
        exit();
    }
  }

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
if(isset($_POST['exit'])){
  session_destroy();
  header('Location: login.php');
}

