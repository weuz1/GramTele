<?
    header('Content-type:text/html;charset=utf-8');
    session_start();

    if($_SESSION['is_auth']){
        header('location: /feed');
    }

    $link = new PDO('mysql:host=localhost;dbname=gramtele','root','');

    if($_POST['auth']){
        if($_POST['login']){
            if($_POST['password']){
                $sql='SELECT id FROM users WHERE login=? and password=?';
                $res = $link->prepare($sql);
                $res->execute([$_POST['login'], $_POST['password']]);
                $array = $res->fetch(PDO::FETCH_ASSOC);
                if ($array['id']){
                    echo 1;
                    $_SESSION['is_auth'] = true;
                    $_SESSION['id_user'] = $array['id'];
                }
                else {
                    $_SESSION['msg'] = 'Некашерный логин или пароль';
                    $_SESSION['msg_status'] = 'danger';
                }
            }
            else{
                $_SESSION['msg'] = 'Введите пароль';
                $_SESSION['msg_status'] = 'danger';
            }
        }
        else{
            $_SESSION['msg'] = 'Введите логин';
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
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="home">
    <div class="home-form">
        <div class="welcome">Gramtele</div>
        <div class="login-form">
            <div class="registration-header">Вход</div>
            <div class="registration-zone">
                <span class="message <?= ($_SESSION['msg_status']) ?  : '' ?>"><?= $_SESSION['msg'] ?></span>
                <?
                $_SESSION['msg'] = '';
                $_SESSION['msg_status'] = '';
                ?>
                <form method="post" action="">
                    <input type="hidden" value="1" name="auth">
                    <input type="text" name="login" class="text" placeholder="Логин" required><br>
                    <input type="password" name="password" class="pass" placeholder="Пароль" required><br>
                    <input type="submit" class="submit-reg-btn" value="Войти">
                </form>
            </div>
            <div class="arleady-have-account">
                <a href="../index.php">
                    Регистрация
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
