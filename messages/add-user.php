<?
session_start();
$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');

if($_POST['add_user']){

    $id_chat = $link->quote($_GET['id_chat']);
    $sql = 'INSERT INTO chats_users(id_chat, id_user) VALUES ';
    $values = substr(str_repeat("($id_chat, ?),",count($_POST['users'])), 0, -1);
    $sql.=$values;
    $res = $link->prepare($sql);
    $res->execute($_POST['users']);
    header('location: /messages/index.php?id_chat='.$_GET['id_chat']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles5.css">
</head>
<body>
<div class="add-chat">
    <div class="chat-add-form">
        <div class="header">Добавить пользователя<br> в чат</div>
        <div class="chat-img">
        </div>
        <div class="chat-header">
            <form action="" method="post">
                <input type="hidden" name="add_user" value="1">
                <?
                $sql='SELECT * FROM users u WHERE u.id
                    NOT IN (SELECT id_user FROM chats_users WHERE id_chat = ?)';
                $res = $link->prepare($sql);
                $res->execute([$_GET['id_chat']]);
                while($array = $res->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <input type="checkbox" name="users[]" value="<?= $array['id'] ?>"> <?= $array['login']?><br>
                    <?
                }
                ?>
                <input type="submit" value="Добавить">
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>