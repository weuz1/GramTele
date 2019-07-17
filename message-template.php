<?
$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');

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
    <title>Message Template OkDa</title>
    <link rel="stylesheet" href="css/messages-temp.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>

<?

$sql = "SELECT * FROM messages WHERE id_chat=?";
$res= $link->prepare($sql);
$row = $link->execute([$_GET['id_chat']]);
var_dump($row);

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
            <div class="message-text"><?= htmlspecialchars($array['text_message'])?></div>
        </div>
    </div>
    <?
}
?>
<div class="send-form">
    <form method="POST">
        <input type="text" name="input-message" required placeholder="Введите сообщение" autocomplete="off">
        <input type="submit" name="submit-btn" value="Отправить">
    </form>
</div>