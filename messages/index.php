<?php
session_start();

$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');

$sql='SELECT login FROM users WHERE id=?';
$res = $link->prepare($sql);
$res->execute([$_SESSION['id_user']]);
$row = $res->fetch(PDO::FETCH_ASSOC);

if($_POST['input-message']){
    $sql = 'INSERT INTO messages (text, id_user) VALUES (?, ?)';
    $res = $link->prepare($sql);
    $res->execute([$_POST['input-message'], $_SESSION['id_user']] );
    header('location: /messages');
}
else{
$_SESSION['msg'] = 'Введите сообщение';
$_SESSION['msg_status'] = 'danger';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Диалоги</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles4.css">
    <link rel="stylesheet" href="../css/messages-temp.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="logo">Gramtele</div>

        </div>
        <div class="menu-profile">
            <div class="menu-prof-name">
                <a href="../profile.php"><?=$row['login']?></a>
                <a href="../exit.php">Выйти</a>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="left-menu">
            <div class="menu-items">
                <div class="menu-item"><a href="../feed/index.php">Новости</a></div>
                <div class="menu-item"><a href="../messages/index.php">Диалоги</a></div>
                <div class="menu-item"><a href="#">Скоро</a></div>
                <div class="menu-item"><a href="#">Скоро</a></div>
                <div class="menu-item"><a href="#">Скоро</a></div>
            </div>
        </div>
            <div class="chats">
                <div class="chat-chats">
                <div class="chats-header">
                    Диалоги
                </div>
                <div class="add-chat">
                    <a href="#">Добавить чат</a>
                </div>
            </div>
            <div class="list-chats" id="list_chats">

                <?
                $sql='SELECT m.text text_message, u.login user_login
                FROM messages m
                JOIN users u ON u.id = m.id_user
                ';
                $res = $link->prepare($sql);
                $res->execute();
                while($array = $res->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="message">
                        <div class="message-avatar">ava</div>
                        <div class="speech-bubble">
                            <div class="message-header"><a href="#"><?= $array['user_login']?></a></div>
                            <div class="message-text"><?= $array['text_message']?></div>
                        </div>
                    </div>
                <?
                }
                ?>

                <div class="chat">
                    <div class="chat-img"></div>
                    <div class="chat-header"></div>
                </div>
            </div>
                <div class="send-form">
                    <form method="POST">
                        <input type="text" name="input-message" required placeholder="Введите сообщение">
                        <input type="submit" name="submit-btn" value="Отправить">
                    </form>
                </div>
        </div>
    </div>
    <script src="../js/scripts.js"></script>
</body>
</html>
