list_chats.scrollTop = 9999;
    $.ajax({
        url: '/hello.php?id_chat=' + id_chat,
    }).done((data) => {
        list_chats.innerHTML = data;
    });
}

setInterval(updateMessages, 1000)