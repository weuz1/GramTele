<?php
session_start();

$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');

$sql='SELECT login FROM users WHERE id=?';
$res = $link->prepare($sql);
$res->execute([$_SESSION['id_user']]);
$row = $res->fetch(PDO::FETCH_ASSOC);
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
</head>
<body>
<div class="feed-page">
    <div class="header">
        <div class="container">
            <div class="logo">Gramtele</div>

        </div>
        <div class="menu-profile">
            <div class="menu-prof-name">
            <?=$row['login']?>
                <a href="../exit.php">Выйти</a>
            </div>
        </div>
    </div>
    <div class="left-menu">
        <div class="menu-items">
            <div class="menu-item"><a href="feed.php">Новости</a></div>
            <div class="menu-item"><a href="#">Диалоги</a></div>
            <div class="menu-item"><a href="#">Скоро</a></div>
            <div class="menu-item"><a href="#">Скоро</a></div>
            <div class="menu-item"><a href="#">Скоро</a></div>
        </div>
    </div>
</div>
</body>
</html>
