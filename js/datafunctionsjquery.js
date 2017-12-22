$(document).ready(function () {


    $("#inserData").click(function () {

        if ($("#userForm").valid()) {

            let new_fullname = $("#fullnameInput").val();
            let new_email = $("#emailInput").val();
            let new_pwd = $("#passwordInput").val();

            $.ajax({
                type: "POST",
                dataType: "text json",
                data: {name: new_fullname, email: new_email, pwd: new_pwd},
                success: function (response) {

                    if (response.status) {
                        // let tableLength = 1 + $("#dataTable >tbody >tr").length;

                        let row = `<tr id="row${response.id}"><td id="fullname" class="fullname"> ${new_fullname} </td> <td id="email" class="email"> ${new_email} </td>  <td id="pwd" class="pwd"> ${new_pwd} </td>  <td><input class="edit" type="button" id="editBtn" value="EDIT" /> </td> <td> <input id="deleteBtn" type="button" value="Delete" class="delete"></td></tr>`;

                        $("#dataTable").append(row);
                    }
                    else {
                        alert("Try Again or Data Not valid " + response.error);
                    }


                }

            });


        } else {

        }

    });


    // Open Model and set data on model Form by click Edit
    $("#dataTable").on('click', '#editBtn', function () {

        $('#myModal').modal('show');

        let trId = $(this).closest('tr').attr('id');
        let tbleTr = $(`#${trId}`);

        let modelId = trId.match(/\d+/);
        let modelFullname = tbleTr.find("#fullname").text().trim();
        let modelEmail = tbleTr.find("#email").text().trim();
        let modelPwd = tbleTr.find("#pwd").text().trim();

        $("#myModal").find("#modelInputID").val(modelId);
        $("#myModal").find("#modelInputFullname").val(modelFullname);
        $("#myModal").find("#modelInputEmail").val(modelEmail);
        $("#myModal").find("#modelInputPassword").val(modelPwd);


    });


    $("#myModal").find("#modelBtnUpdate").click(function () {


        if ($("#modelForm").valid()) {

            let modelInputID = $("#myModal").find("#modelInputID").val();
            let modelInputFullname = $("#myModal").find("#modelInputFullname").val();
            let modelInputEmail = $("#myModal").find("#modelInputEmail").val();
            let modelInputPassword = $("#myModal").find("#modelInputPassword").val();

            $.ajax({
                type: "POST",
                dataType: "text json",
                data: {
                    modelId: modelInputID,
                    modelFullname: modelInputFullname,
                    modelEmail: modelInputEmail,
                    modelPwd: modelInputPassword
                },
                success: function (response) {

                    if (response.status) {
                        let trId = "row" + ($("#myModal").find("#modelInputID").val());
                        let tbleTr = $(`#${trId}`);

                        // let modelId = trId.match(/\d+/);
                        tbleTr.find("#fullname").text(modelInputFullname);
                        tbleTr.find("#email").text(modelInputEmail);
                        tbleTr.find("#pwd").text(modelInputPassword);

                        $('#myModal').modal('hide');
                    }
                    else {
                        alert("Try Again or Data Not valid " + response.error);
                        
                    }
                }
            });

        }
        else {
            alert("NOT DONE");

        }
    });

    //Delete row
    $("#dataTable").on('click', '#deleteBtn', function () {


        let deletetrId = $(this).closest('tr').attr('id');
        let tbleTr = $(`#${deletetrId}`);
        let deleteid = deletetrId.match(/\d+/);

        $.ajax({
            type: "POST",
            dataType: "text json",
            data: {
                id: deleteid
            },
            success: function (response) {

                if (response.status) {
                    $(tbleTr).remove();
                }
                else {
                    alert("SOME ERROR OCCURE PLEASE TRY AFTER SOME TIME!");
                }
            }
        });


    });


    jQuery.validator.addMethod("letterswithspace", function (value, element) {

        return this.optional(element) || /^([a-zA-Z]+\s)[a-zA-Z]+$/.test(value);
    }, "Enter Only Fullname ex. John Smith");


    //Form validation
    $("#modelForm").validate({


        rules: {
            modelInputFullname:
                {
                    required: true,
                    letterswithspace: true
                },
            modelInputEmail: {
                required: true
            },
            modelInputPassword: {
                required: true
            }
        },
        messages: {
            modelInputFullname: "Only one space and alphabetic allow "

        }
    });


    //Form validation
    $("#userForm").validate({


        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            field1: "Please specify your name"

        }
    });


});
