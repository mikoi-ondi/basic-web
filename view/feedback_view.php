<?php

session_start();
if(isset($_SESSION['auth'])):
     ?>

    <!doctype html>
<html lang="ru">
<head>
    <title> Обратная связь </title>
  <!-- Кодировка веб-страницы -->
  <meta charset="utf-8">
  <!-- Настройка viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>...</title>

  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    
<form>
  <div class="form-group">
    <label for="subject">Вопрос:</label>
    <input type="text" class="form-control" id="subject">
  </div>
  <div class="form-group">
    <label for="message">Комментарий:</label>
    <textarea class="form-control" id="message" rows="5"></textarea>
  </div>
  <div class="form-group">
    <label for="gender">Тип страхования Вашего автотранспорта:</label><br>
    <label class="radio-inline"><input type="radio" name="gender" value="male">ОСАГО</label>
    <label class="radio-inline"><input type="radio" name="gender" value="female">КАСКО</label>
  </div>
  <div class="form-group">
    <label for="department">Тип автотранспорта:</label>
    <select class="form-control" id="department">
      <option value="">Выберите Ваш тип:</option>
      <option value="hr">Легковой</option>
      <option value="finance">Грузовой</option>
      <option value="it">Грузопассажирский</option>
      <option value="marketing">Автобусы</option>
    </select>
  </div>
  <div class="form-group">
    <label for="services">Оказываемые услуги:</label><br>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="consultation">Такси по городу</label>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="analysis">Городской курьер</label>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="training">Междугородние рейсы</label>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="implementation">Междугородний курьер</label>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
  <button type="reset" class="btn btn-primary">Сброс</button>
</form>
</body>
</html>
<?php else: ?>
    <p>пожалуйста, авторизуйтесь</p>
<?php endif; ?>