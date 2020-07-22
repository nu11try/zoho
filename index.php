<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test</title>
    </head>
    <body>
        <form name="test_form" action="formController.php" method="POST">
            <input type="text" name="First_Name" placeholder="Имя" required><br><br>
            <input type="text" name="Last_Name" placeholder="Фамилия" required><br><br>
            <input type="tel" name="Phone" placeholder="Телефон" required><br><br>
            <input type="email" name="Email" placeholder="Email" required><br><br>
            <input type="text" name="Income" placeholder="Годовой доход" required><br><br>
            <input type="submit" value="Отправить"> <input type="reset" value="Очистить">
        </form>
    </body>
</html>