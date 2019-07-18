<?
session_start();
$link = new PDO('mysql:host=localhost;dbname=gramtele', 'root', '');

if ($_POST['id_user']) {
    $sql = "DELETE FROM chats_users WHERE id_user = ? and id_chat=?";
    $res = $link->prepare($sql);
    $res->execute([$_POST['id_user'], $_GET['id_chat']]);
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
        <div class="header">Список пользователей<br> в этом чате</div>
        <div class="chat-img">
        </div>
        <div class="chat-header">
            <?
            $sql = 'SELECT u.id id_user, login FROM chats_users cu 
JOIN users u ON u.id = cu.id_user
WHERE cu.id_chat = ?';
            $res = $link->prepare($sql);
            $res->execute([$_GET['id_chat']]);
            while ($array = $res->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="list-user">
                    <div class="user-list-user">
                        <?= $array['login'] ?>
                        <div class="del-user">
                            <form action="" method="post" class="user-delete" name="deleting user">
                                <?
                                if ($_SESSION['status'] == 1) {
                                    ?>
                                    <input type="hidden" name="id_user" value="<?= $array['id_user'] ?>">

                                    <input type="submit" value="Кикнуть">
                                <?
                                }
                                ?>
                            </form>
                        </div>
                        <br>
                    </div>
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