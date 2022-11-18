function loadEverything() {
    loadDashboard();
}

function loadDashboard() {
    $.ajax({
        url: "../routes/dashboard.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadDashboard",
        },
        beforeSend: function () {
            console.log("loading dashboard...");
        },
        success: function (response) {
            $('#books').text(response.BOOKS);
            $('#borrowed').text(response.BORROWED);
            $('#returned').text(response.RETURNED);
            $('#students').text(response.STUDENTS);
        },
        error: function (error) {
            console.log(error);
        },
    });
}
