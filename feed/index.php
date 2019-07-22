<?php
session_start();

$link = new PDO('mysql:host=localhost;dbname=gramtele', 'root', '');

$sql = 'SELECT login FROM users WHERE id=?';
$res = $link->prepare($sql);
$res->execute([$_SESSION['id_user']]);
$user_info = $res->fetch(PDO::FETCH_ASSOC);


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
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
</head>
<body>
<div class="feed-page">
    <div class="header">
        <div class="container">
            <div class="logo">Gramtele</div>

        </div>
        <div class="menu-profile">
            <div class="menu-prof-name">
                <a href="../profile.php"><?= $user_info['login'] ?></a>
                <a href="../exit.php">Выйти</a>
            </div>
        </div>
    </div>
    <div class="menu-class">
        <div class="left-menu">
            <div class="menu-items">
                <div class="menu-item"><a href="index.php">Новости</a></div>
                <div class="menu-item"><a href="../messages/index.php">Диалоги</a></div>
                <div class="menu-item"><a href="#">Скоро</a></div>
                <div class="menu-item"><a href="#">Скоро</a></div>
                <div class="menu-item"><a href="#">Скоро</a></div>
            </div>
        </div>
        <div class="feed">
            <?


            if ($_SESSION['status'] == 1) {


                ?>
                <div class="add-news">
                    <div class="add-news-btn"><a href="add-news.php">Добавить новость</a></div>
                </div>
                <?
            }
            ?>


            <div class="container">
                <?
                $sql = 'SELECT header, text FROM news';
                $res = $link->prepare($sql);
                $res->execute([$_SESSION['id_user']]);
                $news = $res->fetch(PDO::FETCH_ASSOC);
                $res = $link->prepare($sql);
                $res->execute();
                while ($array = $res->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <div class="one-news">
                        <div class="news-header"><?= $array['header'] ?></div>
                        <div class="news-text"><?= $array['text'] ?></div>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>