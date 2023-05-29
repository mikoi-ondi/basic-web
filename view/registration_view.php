<?php if(!isset($_SESSION['auth'])): ?>
    <!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Регистрация </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

    <div class="reg-page">
        <h2>Введите данные</h2>
        <form action="../auth.php" method="POST">
            <input type="hidden" name="action" value="registration">
            <input name="email" placeholder="Email" type="email"
                value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>"/>
            <input type="password" name="password" placeholder="Password" />
            <input type="submit" value="Submit" />
        </form>
    </div>

    </form>

</body>

</html>

<?php endif ?>