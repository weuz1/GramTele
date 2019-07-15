<?php
session_start();

$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');



$uploaddir = 'images/';
$apend = date('YmdHis') . rand(100, 1000) . '.jpg';
$uploadfile = $uploaddir.$apend;
if (($_FILES['userfile']['type'] == 'image  /gif' ||
        $_FILES['userfile']['type'] == 'image/jpeg' ||
        $_FILES['userfile']['type'] == 'image/png') &&
    ($_FILES['userfile']['size'] != 0 &&
        $_FILES['userfile']['size'] <= 51200000)) {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $size = getimagesize($uploadfile);
        if ($size[0] < 1001 && $size[1] < 2001) {
            echo "Файл загружен.";
        } else {
            echo "Загружаемое изображение превышает допустимые нормы (ширина не более - 1000; высота не более 2000)";
            unlink($uploadfile);
        }
    } else {
        echo "Файл не загружен, вернитеcь и попробуйте еще раз";
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
    <title>Настройка профиля</title>
    <link rel="stylesheet" href="css/styles3.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo">Gramtele</div>

    </div>
    <div class="menu-profile">
        <div class="menu-prof-name">
            <a href="../feed/index.php">Назад</a>
        </div>
    </div>
</div>
<div class="profile">
    <div class="container">
        <div class="prof-img">
            <form name="upload" action="" method="POST" ENCTYPE="multipart/form-data">
                Выберите файл для загрузки:
                <input type="file" name="userfile">
                <input type="submit" name="upload" value="Загрузить">
            </form>
        </div>
        <div class="prof-name"></div>
    </div>
</div>
</body>
</html>