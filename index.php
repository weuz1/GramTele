<?
header('Content-type:text/html;charset=utf-8');
session_start();

if($_SESSION['is_auth']){
    header('location: /feed/index.php');
}

$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');

if($_POST['registration']){
    if($_POST['login-reg']){
        if($_POST['email-reg']){
            if($_POST['pass-reg']){
                if($_POST['checkbox-reg']){
                    $password = password_hash($_POST['pass-reg'], PASSWORD_DEFAULT);
                    $sql = 'INSERT INTO users (login, email, password) VALUES (?, ?, ?)';
                    $res = $link->prepare($sql);
                    $res->execute([$_POST['login-reg'], $_POST['email-reg'], $password] );

                    $id = $link->lastInsertId();

                    $_SESSION['is_auth'] = true;
                    $_SESSION['id_user'] = $id;

                    header('location: /feed/index.php');
                    exit;
                }
            }
          else{
              $_SESSION['msg'] = 'Введите пароль';
              $_SESSION['msg_status'] = 'danger';
          }
        }
        else{
            $_SESSION['msg'] = 'Введите почту';
            $_SESSION['msg_status'] = 'danger';
        }
    }
    else{
        $_SESSION['msg'] = 'Введите логин';
        $_SESSION['msg_status'] = 'danger';
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gramtele</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
<div class="home">
    <div class="home-form">
        <div class="welcome">Gramtele</div>
        <div class="registration-form">
            <div class="registration-header">Регистрация</div>
            <div class="registration-zone">
                <span class="message" <?= ($_SESSION['msg_status']) ?  : '' ?>"><?= $_SESSION['msg'] ?></span>
                <?
                $_SESSION['msg'] = '';
                $_SESSION['msg_status'] = '';
                ?>
                <form action="" method="post">
                    <input type="hidden" value="1" name="registration">
                    <input type="text" class="text" name="login-reg" placeholder="Логин" required><br>
                    <input type="email" class="email" name="email-reg" placeholder="Почта" required><br>
                    <input type="password" class="pass" name="pass-reg" placeholder="Пароль" required><br>
                    <div class="checkbox-html"><input type="checkbox" name="checkbox-reg" class="sumbit-rules" required>Я соглашаюсь на обработку данных</div>
                    <input type="submit"class="submit-reg-btn" value="Создать аккаунт" required>
                </form>
            </div>
            <div class="arleady-have-account">
                <a href="logining/index.php">
                    Уже есть аккаунт? Войти...
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>