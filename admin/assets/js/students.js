$(document).ready(function () {
    $("#studentstable").DataTable({
        pageLength: 5,
    });
    loadEverything();
});

function loadEverything() {
    loadStudents();
}

$("#addStudentModalBtn").click(function () {
    $("#addStudentModal").modal("show"), loadUsers();
});

function loadStudents() {
    $.ajax({
        url: "../routes/students.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadStudents",
        },
        beforeSend: function () {
            console.log("loading students...");
            if ($.fn.DataTable.isDataTable("#studentstable")) {
                $("#studentstable").DataTable().clear();
                $("#studentstable").DataTable().destroy();
            }
            $("#studentsTableBody")
                .empty()
                .append(
                    "<tr><td colspan='6'>Loading! Please wait...</td></tr>"
                );
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "STUDENTS_LOADED") {
                $("#studentsTableBody").empty();
                response.STUDENTS.forEach((element) => {
                    $("#studentsTableBody").append(
                        `
                        <tr>
                            <td>` +
                            element.student_id +
                            `</td>
                            <td>` +
                            (element.firstname != ""
                                ? element.firstname
                                : "-") +
                            `</th>
                            <td>` +
                            (element.middlename != ""
                                ? element.middlename
                                : "-") +
                            `</td>
                            <td>` +
                            (element.lastname != "" ? element.lastname : "-") +
                            `</td>
                            <td>` +
                            (element.contact_no != ""
                                ? element.contact_no
                                : "-") +
                            `</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary me-2" onclick="viewBook(\'` +
                            element.student_id +
                            `\')"><i class="fa-solid fa-eye"></i></button>
                                <button type="button" class="btn btn-danger" onclick="deleteBook(\'` +
                            element.student_id +
                            `'\)"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                      `
                    );
                });

                $("#studentstable").DataTable({
                    pageLength: 5,
                });
            } else {
                $("#studentsTableBody")
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

function loadUsers() {
    $.ajax({
        url: "../routes/users.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadNonEnabledUsers",
        },
        beforeSend: function () {
            console.log("loading users...");
            $("#usersTableBody")
                .empty()
                .append(
                    "<tr><td colspan='3'>Loading! Please wait...</td></tr>"
                );
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "USERS_LOADED") {
                $("#usersTableBody").empty();
                response.USERS.forEach((element) => {
                    $("#usersTableBody").append(
                        `
                        <tr>
                            <td>` +
                            element.user_id +
                            `</td>
                            <td>` +
                            element.email +
                            `</td>` +
                            `<td class="text-center">
                                <button type="button" class="btn btn-primary me-2" onclick="addStudent(` +
                            element.user_id +
                            `)"><i class="fa-solid fa-plus"></i></button>
                            </td>
                        </tr>
                      `
                    );
                });

                $("#userstable").DataTable({
                    pageLength: 5,
                });
            } else {
                $("#usersTableBody")
                    .empty()
                    .append(
                        "<tr><td colspan='3'>Oops! No registered users found.</td></tr>"
                    );
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function AddStudent(user_id) {
    $.ajax({
        url: "../routes/students.route.php",
        type: "POST",
        data: {
            action: "AddStudent",
            user_id,
            user_id,
        },
        beforeSend: function () {
            console.log("adding student...");
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
                        $("#addStudentModal").modal("hide"), loadStudents();
                    });
                }
            }
        });
    });

function addStudent(user_id) {
    Swal.fire({
        title: "Add as Student?",
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
            return AddStudent(user_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Student Added!", "success").then(() => {
                    loadUsers(),
                        loadStudents(),
                        $("#addStudentModal").modal("hide");
                });
            }
        }
    });
}

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
                                        loadStudents();
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
                    loadStudents();
                });
            }
        }
    });
}
