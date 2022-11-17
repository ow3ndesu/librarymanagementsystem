$(document).ready(function () {
    loadEverything();
});

function loadEverything() {
    loadMessages();
}

function loadMessages() {
    $.ajax({
        url: "../routes/messages.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadMessages",
        },
        beforeSend: function () {
            console.log("loading messages...");
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "MESSAGES_LOADED") {
                response.MESSAGES.forEach((element) => {
                    $("#reply_to").val(element.id)
                });
            } else {
                console.log(response);
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

$(document).on('input', '#message-input', function () {
    if ($(this).val() === "") {
        $("#sendMessageBtn").prop('disabled', true);
    } else {
        $("#sendMessageBtn").prop('disabled', false);
    }
})

$("#sendMessageBtn").click(function () {
    const message = $('#message-input').val();
    const reply_to = $('#reply_to').val();

    if (message == "") {
        Swal.fire("Nothing there?", "Please input message!", "error");
    } else {
        $.ajax({
            url: "../routes/messages.route.php",
            type: "POST",
            data: {
                action: "SendMessage",
                message: message,
                reply_to: reply_to
            },
            beforeSend: function () {
                console.log("sending message...");
            },
            success: function (response) {
                if (response == "SENT_SUCCESSFUL") {
                    Swal.fire("Yeeey!", "Message Successfully Sent!", "success").then(() => {
                        $('#message-input').val("");
                        loadMessages;
                    }).catch((err) => {
                        console.log(err)
                    });
                }
            },
            error: function (err) {
                console.log(err);
            },
        });
    }

})
