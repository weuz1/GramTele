<?php
$link = new PDO('mysql:host=localhost;dbname=gramtele','root','');
$sql = "SELECT m.text text_message, u.login login FROM messages m
                            JOIN users u ON u.id = m.id_user 
                            WHERE id_chat=?";
$res = $link->prepare($sql);
$res->execute([$_GET['id_chat']]);
while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="message">
        <div class="message-avatar"></div>
        <div class="speech-bubble">
            <div class="message-header"><a href="#"><?= $row['login']?></a></div>
            <div class="message-text"><?= htmlspecialchars($row['text_message'])?></div>
        </div>
    </div>
    <?
}
?>