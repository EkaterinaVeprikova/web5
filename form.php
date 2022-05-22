<html>
  <head>
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
      .error {
      border: 5px solid red;
      border-radius: 5px;
      margin-bottom: 1px;
      }
    </style>
  </head>
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>
     <form action="" method="POST">
            <label>
                Имя:<br />
                <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?>
                       value="<?php print $values['name']; ?>"
                       type="text"/>
            </label><br />
            <label>
                E-mail:<br />
                <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?>
                       value="<?php print $values['email']; ?>"
                       type="email" />
            </label><br />
            <label>
                Год рождения:<br />
                <select name="year_of_birth" <?php if ($errors['year_of_birth']) {print 'class="error"';} ?>>
                    <option value="default hidden <?php print $values['year_of_birth']; ?>" >выберите из списка</option>
                    <option>1998</option>
                    <option>1999</option>
                    <option>2000</option>
                    <option>2001</option>
                    <option>2002</option>
                </select>
            </label><br />
            Пол:<br />
            <label>
                <input type="radio"
                       name="gender" <?php if ($errors['gender']) {print 'class="error"';} 
                       if($values['gender']=="male"){print "checked='checked'";}?> value="male" />
                мужской
            </label>
            <label>
            <input type="radio"
                       name="gender" <?php if ($errors['gender']) {print 'class="error"';} 
                       if($values['gender']=="female"){print "checked='checked'";}?> value="female" />                
                женский
            </label><br />
            Количество конечностей:<br />
            <label>
                <input type="radio"
                       name="number_of_limbs" <?php if ($errors['number_of_limbs']) {print 'class="error"';} 
                       if($values['number_of_limbs']=="2"){print "checked='checked'";}?> value="2" />                
                2
            </label>
            <label>
                <input type="radio"
                       name="number_of_limbs" <?php if ($errors['number_of_limbs']) {print 'class="error"';} 
                       if($values['number_of_limbs']=="3"){print "checked='checked'";}?> value="3" />                
                3
            </label><br />
            <label>
                <input type="radio"
                       name="number_of_limbs" <?php if ($errors['number_of_limbs']) {print 'class="error"';} 
                       if($values['number_of_limbs']=="4"){print "checked='checked'";}?> value="4" />                
                4
            </label><br />
            <label>
                Сверхспособности:
                <br />
                <select name="superpowers-3[]" <?php if ($errors['superpowers-3']) {print 'class="error"';} ?>
                        multiple="multiple">
                    <option value="immortality <?php if($values['superpowers-3']=="immortality"){print "selected='selected'";}?>" >бессмертие</option>
                    <option value="passing_through_walls <?php if($values['superpowers-3']=="passing_through_walls"){print "selected='selected'";}?>" >прохождение сквозь стены</option>
                    <option value="levitation <?php if($values['superpowers-3']=="levitation"){print "selected='selected'";}?>" >левитация</option>
                </select>
            </label><br />
            <label>
                Биография:<br />
                <textarea name="biography" <?php if ($errors['biography']) {print 'class="error"';} ?> 
                          value = "biography" <?php print $values['biography']; ?> >
                </textarea>
            </label><br />
            С контрактом ознакомлен(а)
            <br />
            <label>
                <input type="checkbox" 
                       name="policy" <?php if($values['policy']=="check"){print "checked='checked'";}?> value="check" />
                да
            </label><br />
            <input type="submit" value="Отправить" />
        </form>
  </body>
</html>