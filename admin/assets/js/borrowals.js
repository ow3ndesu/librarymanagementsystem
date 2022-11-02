$(document).ready(function () {
    $("#borrowalstable").DataTable({
        pageLength: 5,
    });
    loadEverything();
});

function loadEverything() {
    loadBorrowals();
}

function loadBorrowals() {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadBorrowals",
        },
        beforeSend: function () {
            console.log("loading borrowals...");
            if ($.fn.DataTable.isDataTable("#borrowalstable")) {
                $("#borrowalstable").DataTable().clear();
                $("#borrowalstable").DataTable().destroy();
            }
            $("#borrowalsTableBody")
                .empty()
                .append(
                    "<tr><td colspan='6'>Loading! Please wait...</td></tr>"
                );
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "BORROWALS_LOADED") {
                $("#borrowalsTableBody").empty();
                let deleteBtn = "";
                response.BORROWALS.forEach((element) => {
                    element.status == "PENDING"
                        ? (deleteBtn =
                              `<button type="button" class="btn btn-danger" onclick="deleteBorrowal(\'` +
                              element.borrow_id +
                              `'\)"><i class="fa-solid fa-trash"></i></button>`)
                        : null;

                    $("#borrowalsTableBody").append(
                        `
                        <tr>
                            <td>` +
                            element.borrow_id +
                            `</td>
                            <td>` +
                            element.title +
                            `</th>
                            <td>` +
                            (element.lastname != "" ? element.lastname : "-") +
                            `</td>
                            <td>` +
                            element.filed +
                            `</td>
                            <td>` +
                            element.due +
                            `</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary me-2" onclick="viewBorrowal(\'` +
                            element.borrow_id +
                            `\')"><i class="fa-solid fa-eye"></i></button>
                                ` +
                            deleteBtn +
                            `
                            </td>
                        </tr>
                      `
                    );
                });

                $("#borrowalstable").DataTable({
                    pageLength: 5,
                });
            } else {
                $("#borrowalsTableBody")
                    .empty()
                    .append(
                        "<tr><td colspan='6'>Oops! No successful borrowals found.</td></tr>"
                    );
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function EditBorrowalStatus(borrow_id, status) {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        data: {
            action: "EditBorrowalStatus",
            borrow_id: borrow_id,
            status: status,
        },
        beforeSend: function () {
            console.log("editing status...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function DeleteBorrowal(borrow_id) {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        data: {
            action: "DeleteBorrowal",
            book_id: book_id,
        },
        beforeSend: function () {
            console.log("deleting borrowal...");
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
function viewBorrowal(borrow_id) {
    $("#borrow_id").val(borrow_id);
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        data: {
            action: "LoadBorrowal",
            borrow_id: borrow_id,
        },
        dataType: "JSON",
        beforeSend: function () {
            console.log("fetching borrowal...");
        },
        success: function (response) {
            response.BORROWAL.forEach((element) => {
                console.log(element);
                $("#borrow_id").val(element[1]);
                $("#filed").val(element[5]);
                $("#due").val(element[6]);
                $("#status").val(element[4]);
                $("#modify_by").val(element[7] != "" ? element[7] : "-");
                $("#modify_at").val(element[8] != "" ? element[8] : "-");
                $("#student_id").val(element[20]);
                $("#user_id").val(element[21]);
                $("#fullname").val(
                    (element[22] != "" ? element[22] : "-") +
                        " " +
                        (element[23] != "" ? element[23] : "-") +
                        " " +
                        (element[24] != "" ? element[24] : "-")
                );
                $("#email").val(element[29]);
                $("#address").val(element[25] != "" ? element[25] : "-");
                $("#contact_no").val(element[26] != "" ? element[26] : "-");
                $("#registration_date").val(element[33]);
                $("#newbook_id").val(element[10]);
                $("#newtitle").val(element[11]);
                $("#newauthor").val(element[12]);
                $("#newdescription").val(element[13]);
                $("#newquantity").val(element[14]);
                $("#newstatus").val(element[15]);
                $("#date").val(element[18]);

                if (element[4] != "PENDING") {
                    $("#disapproveBorrowalBtn").prop("disabled", true);
                }

                if (element[4] == "BORROWED") {
                    $("#approveBorrowalBtn").prop("disabled", true);
                }
            }),
                $("#updateBorrowalModal").modal("show");

            $("#disapproveBorrowalBtn").click(function () {
                Swal.fire({
                    title: "Disapprove Borrowal?",
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
                        return EditBorrowalStatus(borrow_id, "DISAPPROVED");
                    },
                }).then((result) => {
                    if (result.isDismissed) {
                        Swal.fire("Backin' out?", "Nothing Changes!", "info");
                    } else {
                        if (result.value != true) {
                            Swal.fire("Eek!", "Something went wrong?", "error");
                        } else {
                            Swal.fire(
                                "Hooray!",
                                "Status Updated!",
                                "success"
                            ).then(() => {
                                $("#updateBorrowalModal").modal("hide"),
                                    loadBorrowals();
                            });
                        }
                    }
                });
            });

            $("#approveBorrowalBtn").click(function () {
                Swal.fire({
                    title: "Enable Account?",
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
                        return EditBorrowalStatus(borrow_id, "BORROWED");
                    },
                }).then((result) => {
                    if (result.isDismissed) {
                        Swal.fire("Backin' out?", "Nothing Changes!", "info");
                    } else {
                        if (result.value != true) {
                            Swal.fire("Eek!", "Something went wrong?", "error");
                        } else {
                            Swal.fire(
                                "Hooray!",
                                "Status Updated!",
                                "success"
                            ).then(() => {
                                $("#updateBorrowalModal").modal("hide"),
                                    loadBorrowals();
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

function deleteBorrowal(borrow_id) {
    Swal.fire({
        title: "Delete Borrowal?",
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
            return DeleteBorrowal(borrow_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Borrowal Deleted!", "success").then(
                    () => {
                        loadBorrowals();
                    }
                );
            }
        }
    });
}
