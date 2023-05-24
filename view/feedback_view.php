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
    
<form action="/controller/feedback.php" method=POST> 
  <div class="form-group">
    <label for="email">Ваш email:</label>
    <input type="text" class="form-control" name="email">
  </div>
  <div class="form-group">
    <label for="message">Комментарий:</label>
    <textarea class="form-control" name="message" rows="5"></textarea>
  </div>
  <div class="form-group">
    <label for="">Ваш тип страховки:</label><br>
    <label class="radio-inline"><input type="radio" name="insurance" value="osago">ОСАГО</label>
    <label class="radio-inline"><input type="radio" name="insurance" value="casco">КАСКО</label>
  </div>
  <div class="form-group">
    <label for="opinion">Как вы оцениваете наш сервис?</label>
    <select name="opinion" class="form-control">
      <option value="0">Оцените по 5-балльной шкале:</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="services">Что вам нравится в нашем сервисе?:</label><br>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="usability">Удобство</label>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="price">Стоимость услуг</label>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="service">Обслуживание</label>
    <label class="checkbox-inline"><input type="checkbox" name="services[]" value="nothing">Ничего</label>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
  <button type="reset" class="btn btn-primary">Сброс</button>
</form>
</body>
</html>
<?php else: ?>
    <p>пожалуйста, авторизуйтесь</p>
<?php endif; ?>