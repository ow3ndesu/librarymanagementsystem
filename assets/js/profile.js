$(document).ready(function () {
    loadEverything();
});

var student_id = null;

function loadEverything() {
    loadStudentID();
    loadProfile();
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
                $('.message-box').empty();
                response.MESSAGES.forEach((element) => {
                    if (element.isAdmin != 1) {
                        $('.message-box').append(`
                            <div class="row sent mt-2">
                                <div class="col text-end" style="text-align: -webkit-right !important;">
                                <span style=" display: flex; border: 1px solid #3f72af; border-radius: 10px; width: fit-content; padding: .2rem 1rem .2rem 1rem; flex-wrap: wrap; background-color: #3f72af; color: #fff;">`+ element.message +`</span>
                                <small class="text-secondary" style="font-size: .7rem; margin-right: 2%;">`+ element.created_at +`</small>
                                </div>
                            </div>
                        `)
                    } else {
                        $('.message-box').append(`
                            <div class="row recieved">
                                <div class="col">
                                <span style=" display: flex; border: 1px solid rgb(219 226 239); border-radius: 10px; width: fit-content; padding: .2rem 1rem .2rem 1rem; flex-wrap: wrap; background-color: rgb(219 226 239);">`+ element.message +`</span>
                                <small class="text-secondary" style="font-size: .7rem; margin-left: 2%;">`+ element.created_at +`</small>
                                </div>
                            </div>
                        `)
                    }
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

function loadStudentID() {
    $.ajax({
        url: "../routes/auth.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadProfile",
        },
        beforeSend: function () {
            console.log("loading ID...");
        },
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function loadProfile() {
    $.ajax({
        url: "../routes/profile.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadProfile",
        },
        beforeSend: function () {
            console.log("loading profile...");
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "PROFILE_LOADED") {
                response.PROFILE.forEach((element) => {
                    student_id = element.student_id;

                    if (element.firstname == "" || element.lastname == "") {
                        $("#profileIdentity").empty().text(element.student_id);
                    } else {
                        $("#profileIdentity")
                            .empty()
                            .text(element.firstname + " " + element.lastname);
                    }

                    $("#borrowedcount").empty().text(element.borrowedcount);
                    $("#returnedcount").empty().text(element.returnedcount);

                    if (element.is_completed == 0) {
                        $("#status").empty().text("Incomplete");
                        $("#eligible").empty().text("No");

                        $("#profileActionButton").empty().append(`
                            <a href="#" onclick="openCompleteProfileModal()">Complete Profile</a>
                        `);
                        $("#profileRemarks")
                            .empty()
                            .text(
                                "You Haven't Completed Your Account yet. Go Complete It By Clicking The Buutton Below."
                            );
                        $("#student_id").val(element.student_id);
                        $("#firstname").val(element.firstname);
                        $("#middlename").val(element.middlename);
                        $("#lastname").val(element.lastname);
                        $("#address").val(element.address);
                        $("#contact_no").val(element.contact_no);

                        // loadBorrowedBooks(element.student_id);
                    } else {
                        loadBorrowedBooks();

                        $("#status").empty().text("Completed");
                        $("#eligible").empty().text("Yes");

                        $("#profileActionButton").empty().append(`
                            <a href="browse.page.php">Browse Books</a>
                        `);
                        $("#profileRemarks")
                            .empty()
                            .text(
                                "What's your pick for today? Go Browse Our Library By Clicking The Buutton Below."
                            );
                    }
                });
            } else {
                console.log("sus! how did u get in?");
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function loadBorrowedBooks() {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "LoadMyBorrowals",
            student_id: student_id,
        },
        beforeSend: function () {
            console.log("loading borrowals...");
        },
        success: function (response) {
            console.log(response);
            if (response.MESSAGE == "BORROWALS_LOADED") {
                $("#libraysection").empty();
                response.BORROWALS.forEach((element) => {
                    const actionbtn =
                        element.status == "PENDING"
                            ? '<a href="#" onclick="cancelBorrowal(\'' +
                              element.borrow_id +
                              "')\">Cancel</a>"
                            : '<a href="#" onclick="returnBorrowal(\'' +
                              element.borrow_id +
                              "')\">Return</a>";
                    $("#libraysection").append(
                        `
                        <div class="item">
                            <ul>
                            <li><img src="../assets/uploaded/images/`+ element.image +`" alt="" class="templatemo-item book-cover-`+ element.borrow_id +`"></li>
                            
                            <li>
                                <h4>` +
                            element.title +
                            `</h4><span>`+ element.author +`</span>
                            </li>
                            <li>
                                <h4>Date Filed</h4><span>` +
                            element.filed +
                            `</span>
                            </li>
                            <li>
                                <h4>Due Date</h4><span>` +
                            element.due +
                            `</span>
                            </li>
                            <li>
                                <h4>Currently</h4><span>` +
                            ((element.bookstatus == 'INACTIVE') ? element.bookstatus : element.status) +
                            `</span>
                            </li>
                            <li>
                                <div class="main-border-button border-no-active">` +
                                    actionbtn +
                                `</div>
                            </li>
                            </ul>
                        </div>
                    `
                    );

                    const due = parseInt(Date.parse(element.due));
                    const now = parseInt(Date.now());
                    const status = element.bookstatus;

                    console.log(due, now, (due >= now))

                    if (status != 'INACTIVE' && (due >= now)) {
                        $(".book-cover-" + element.borrow_id + "").css('cursor', 'pointer').attr('onclick', 'readBook(\'' + element.copy + '\', \'' + element.title + '\')').attr('title', 'Read Book');
                    }
                });
            } else {
                $("#libraysection")
                    .empty()
                    .append(
                        `
                    <div class="item">
                        <ul class="text-center">
                        <li>Nothing in here!</li>
                        </ul>
                    </div>
                `
                    );
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function updateProfile(
    student_id,
    firstname,
    middlename,
    lastname,
    address,
    contact_no
) {
    $.ajax({
        url: "../routes/profile.route.php",
        type: "POST",
        data: {
            action: "UpdateProfile",
            student_id: student_id,
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            address: address,
            contact_no: contact_no,
        },
        beforeSend: function () {
            console.log("updating profile...");
        },
        success: function (response) {
            return response;
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function EditBorrowalStatus(borrow_id, status, student_id) {
    $.ajax({
        url: "../routes/borrowals.route.php",
        type: "POST",
        data: {
            action: "EditMyBorrowalStatus",
            borrow_id: borrow_id,
            status: status,
            student_id: student_id,
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

// TRIGGERED FUNCCTIONS
function openCompleteProfileModal() {
    $("#completeProfileModal").modal("show"),
        $("#contact_no").on("input", function (e) {
            $(this).val(
                $(this)
                    .val()
                    .replace(/[^0-9]/g, "")
            );
        }),
        $("#completeProfileForm")
            .unbind("submit")
            .submit(function () {
                const student_id = $("#student_id").val();
                const firstname = $("#firstname").val();
                const middlename = $("#middlename").val();
                const lastname = $("#lastname").val();
                const address = $("#address").val();
                const contact_no = $("#contact_no").val();

                if (
                    student_id == "" ||
                    firstname == "" ||
                    lastname == "" ||
                    address == "" ||
                    contact_no == ""
                ) {
                    Swal.fire("Eek!", "Please complete the form!", "error");
                } else {
                    Swal.fire({
                        title: "Update Profile?",
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
                            return updateProfile(
                                student_id,
                                firstname,
                                middlename,
                                lastname,
                                address,
                                contact_no
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
                                    "Profile Updated!",
                                    "success"
                                ).then(() => {
                                    $("#completeProfileModal").modal("hide"),
                                        loadEverything();
                                });
                            }
                        }
                    });
                }
            });
}

function readBook(file, title) {
    $('#readBookModal').modal('show');
    $('#readBookModal').find('#modalBookTitle').empty().text(title);
    $('#readBookModal').find('iframe').attr('src','../assets/uploaded/copies/'+ file +'');
}

function cancelBorrowal(borrow_id) {
    Swal.fire({
        title: "Cancel Borrowal?",
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
            return EditBorrowalStatus(borrow_id, "CANCELED", student_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Status Updated!", "success").then(() => {
                    loadBorrowedBooks();
                });
            }
        }
    });
}

function returnBorrowal(borrow_id) {
    Swal.fire({
        title: "Return This Book?",
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
            return EditBorrowalStatus(borrow_id, "RETURNING", student_id);
        },
    }).then((result) => {
        if (result.isDismissed) {
            Swal.fire("Backin' out?", "Nothing Changes!", "info");
        } else {
            if (result.value != true) {
                Swal.fire("Eek!", "Something went wrong?", "error");
            } else {
                Swal.fire("Hooray!", "Status Updated!", "success").then(() => {
                    loadBorrowedBooks();
                });
            }
        }
    });
}

$(document).on('input', '#message-input', function () {
    if ($(this).val() === "") {
        $("#sendMessageBtn").prop('disabled', true);
    } else {
        $("#sendMessageBtn").prop('disabled', false);
    }
})

$(".close-read-modal").click(function () {
    $('#readBookModal').modal('hide');
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
                        loadMessages();
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

$("input[type=text]").on('input', function () {
    this.value = this.value.toUpperCase();
});
