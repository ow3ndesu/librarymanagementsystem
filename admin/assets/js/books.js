$(document).ready(function () {
    $("#bookstable").DataTable({
        pageLength: 5,
    });
    loadEverything();
});

function loadEverything() {
    loadBooks();
}

$("#addBookModalBtn").click(function () {
    $("#addBookModal").modal("show");
});

function loadBooks() {
    $.ajax({
        url: "../routes/books.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadBooks",
        },
        beforeSend: function () {
            console.log("loading books...");
            if ($.fn.DataTable.isDataTable("#bookstable")) {
                $("#bookstable").DataTable().clear();
                $("#bookstable").DataTable().destroy();
            }
            $("#booksTableBody")
                .empty()
                .append(
                    "<tr><td colspan='6'>Loading! Please wait...</td></tr>"
                );
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "BOOKS_LOADED") {
                $("#booksTableBody").empty();
                response.BOOKS.forEach((element) => {
                    $("#booksTableBody").append(
                        `
                        <tr>
                            <td>` +
                            element.book_id +
                            `</td>
                            <td>` +
                            element.title +
                            `</th>
                            <td>` +
                            element.author +
                            `</td>
                            <td>` +
                            element.quantity +
                            `</td>
                            <td>` +
                            element.status +
                            `</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary me-2" onclick="viewBook(\'` +
                            element.book_id +
                            `\')"><i class="fa-solid fa-eye"></i></button>
                                <button type="button" class="btn btn-danger" onclick="deleteBook(\'` +
                            element.book_id +
                            `'\)"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                      `
                    );
                });

                $("#bookstable").DataTable({
                    pageLength: 5,
                });
            } else {
                $("#booksTableBody")
                    .empty()
                    .append(
                        "<tr><td colspan='6'>Oops! No available book found.</td></tr>"
                    );
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function addBook(title, author, description, quantity, status) {
    $.ajax({
        url: "../routes/books.route.php",
        type: "POST",
        data: {
            action: "AddBook",
            title: title,
            author: author,
            description: description,
            quantity: quantity,
            status: status,
        },
        beforeSend: function () {
            console.log("adding book...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function updateBook(book_id, title, author, description, quantity, status) {
    $.ajax({
        url: "../routes/books.route.php",
        type: "POST",
        data: {
            action: "UpdateBook",
            book_id: book_id,
            title: title,
            author: author,
            description: description,
            quantity: quantity,
            status: status,
        },
        beforeSend: function () {
            console.log("updating book...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function DeleteBook(book_id) {
    $.ajax({
        url: "../routes/books.route.php",
        type: "POST",
        data: {
            action: "DeleteBook",
            book_id: book_id,
        },
        beforeSend: function () {
            console.log("deleting book...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

// TRIGERED FUNCTIONS
$("#addBookForm")
    .unbind("submit")
    .submit(function () {
        const title = $("#title").val();
        const author = $("#author").val();
        const description = $("#description").val();
        const quantity = $("#quantity").val();
        const status = $("#status").val();

        Swal.fire({
            title: "Add Book?",
            icon: "question",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            allowOutsideClick: false,
            customClass: {
                input: "text-center",
            },
            preConfirm: (e) => {
                return addBook(title, author, description, quantity, status);
            },
        }).then((result) => {
            if (result.isDismissed) {
                Swal.fire("Backin' out?", "Nothing Changes!", "info");
            } else {
                if (result.value != true) {
                    Swal.fire("Eek!", "Something went wrong?", "error");
                } else {
                    Swal.fire("Hooray!", "Book Added!", "success").then(() => {
                        $("#addBookModal").modal("hide"), loadBooks();
                    });
                }
            }
        });
    });

function viewBook(book_id) {
    $("#book_id").val(book_id);
    $.ajax({
        url: "../routes/books.route.php",
        type: "POST",
        data: {
            action: "LoadBook",
            book_id: book_id,
        },
        dataType: "JSON",
        beforeSend: function () {
            console.log("fetching book...");
        },
        success: function (response) {
            response.BOOK.forEach((element) => {
                console.log(element);
                $("#newbook_id").val(element.book_id);
                $("#newtitle").val(element.title);
                $("#newauthor").val(element.author);
                $("#newdescription").val(element.description);
                $("#newquantity").val(element.quantity);
                $("#newstatus").val(element.status);
                $("#date").val(element.inserted_at);

                if (element.status == "ENABLED") {
                    $("#enablebtn").prop("disabled", true);
                } else if (element.status == "DISABLED") {
                    $("#disablebtn").prop("disabled", true);
                }
            }),
                $("#updateBookModal").modal("show");

            $("#updateBookForm")
                .unbind("submit")
                .submit(function () {
                    const book_id = $("#newbook_id").val();
                    const title = $("#newtitle").val();
                    const author = $("#newauthor").val();
                    const description = $("#newdescription").val();
                    const quantity = $("#newquantity").val();
                    const status = $("#newstatus").val();

                    Swal.fire({
                        title: "Update Book?",
                        icon: "question",
                        showCancelButton: true,
                        showLoaderOnConfirm: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                        allowOutsideClick: false,
                        customClass: {
                            input: "text-center",
                        },
                        preConfirm: (e) => {
                            return updateBook(
                                book_id,
                                title,
                                author,
                                description,
                                quantity,
                                status
                            );
                        },
                    }).then((result) => {
                        if (result.isDismissed) {
                            Swal.fire(
                                "Backin' out?",
                                "Nothing Changes!",
                                "info"
                            );
                        } else {
                            if (result.value != true) {
                                Swal.fire(
                                    "Eek!",
                                    "Something went wrong?",
                                    "error"
                                );
                            } else {
                                Swal.fire(
                                    "Hooray!",
                                    "Book Updated!",
                                    "success"
                                ).then(() => {
                                    $("#updateBookModal").modal("hide"),
                                        loadBooks();
                                });
                            }
                        }
                    });
                });
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function deleteBook(book_id) {
    Swal.fire({
        title: "Delete Book?",
        icon: "question",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        allowOutsideClick: false,
        customClass: {
            input: "text-center",
        },
        preConfirm: (e) => {
            return DeleteBook(book_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Book Deleted!", "success").then(() => {
                    loadBooks();
                });
            }
        }
    });
}
