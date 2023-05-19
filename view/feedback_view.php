<?php
include '../controller/login.php';
if(isset($_SESSION['auth'])):
    session_start(); ?>

    <!doctype html>
<html lang="ru">
<head>
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
    <div>
        <input type="radio" name="radio" id="radio">
        <label for="radio">Radio</label>

    </div>

    <div> <button>Click</button>
    </div>

    <div>
        <input type="checkbox" name="checkbox" id="checkbox">
        <label for="checkbox">Check</label>
    </div>

    <div>
        <label for="select_id">Выпадающий список</label>

        <select name="select" id="select_id">
            <option value="">Выберите из выпадающего списка</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>

    </div>

    <div>

    </div>

    <div>

    </div>

    <form action="" method="post">
        Тема запроса: <input type="text" name="tema" id="tema" required minlength="4" maxlength="100"> <br>
        Тело запроса: <textarea name="zapros" id="zapros" rows="5" cols="33">Введите ваш отзыв или вопрос в это поле
            </textarea> <br>

        <input type="reset" value="Сброс">
        <input type="submit" value="Отправить">

    </form>
</body>
</html>
<?php else: ?>
    <p>пожалуйста, авторизуйтесь</p>
<?php endif; ?>