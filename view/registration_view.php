<?php if(!isset($_SESSION['auth'])): ?>
    <!DOCTYPE html>
    <html lang='ru'>

    <head>
        <meta charset='utf-8'>
        <title>Регистрация</title>
    </head>

    <div class="auth-page">
        <h2>Введите данные</h2>
        <form action="/controller/registration.php" method="POST">
            <input name="email" placeholder="Email" type="email"
                   value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>"/>

            <input type="password" name="password" placeholder="Password" />
            <input type="submit" value="Submit" />
        </form>
    </div>

    </form>

    </body>

    </html>