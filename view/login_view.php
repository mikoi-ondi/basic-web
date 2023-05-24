<!doctype html>
<html lang="ru">
<head>
    
  <!-- Кодировка веб-страницы -->
  <meta charset="utf-8">
  <!-- Настройка viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Авторизация </title>

  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

    <div class="log-page">
        <h2>Введите данные</h2>
        <form action="/controller/auth.php" method="POST">
            <input type="hidden" name="action" value="login">
            <input type="text" name="email" placeholder="Email" 
            value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>"/>
            <input type="password" name="password" placeholder="Password" />
            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>

    </form>

</body>

</html>