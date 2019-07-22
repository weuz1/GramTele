<?
session_start();
$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');
if($_POST['header']){
    $sql = 'INSERT INTO news(header, text) VALUES (?, ?)';
    $res = $link->prepare($sql);
    $res->execute([$_POST['header'], $_POST['text']]);
    header('location: /');
}
if ($_SESSION['status'] == 1){

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
    <link rel="stylesheet" href="../css/styles6.css">
</head>
<body>
<div class="add-chat">
    <div class="chat-add-form">
        <div class="header">Добавить Чат</div>
        <div class="chat-img">
        </div>
        <div class="chat-header">
            <form action="" method="post">
                <input type="text" placeholder="Заголовок" autocomplete="off" name="header">
                <input type="text" placeholder="Текст" autocomplete="off" name="text" class="text-news">
                <?
                $sql='INSERT INTO news ';
                $res = $link->prepare($sql);
                $res->execute();
                    ?>
                <input type="submit" value="Создать">
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
<?
}
else{
    header('location: /');
}
    ?>