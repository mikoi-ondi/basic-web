 
    
<?php
include '../controller/login.php';
if(isset($_SESSION['auth'])):
    session_start(); ?>

    <!DOCTYPE html>
    <html lang='ru'>

    <head>
        <meta charset='utf-8'>
        <title>Обратная связь</title>

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