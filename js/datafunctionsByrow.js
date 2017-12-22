function addData() {


    var new_fullname = document.getElementById("fullnameInput").value;
    var new_email = document.getElementById("emailInput").value;
    var new_pwd = document.getElementById("passwordInput").value;

    var table = document.getElementById("data_table");
    var table_len = (table.rows.length);

    var row = table.insertRow(table_len).outerHTML =
        "<tr id='row" + table_len + "'><td contenteditable='true' id='fullname' class='fullname'>" + new_fullname + "</td><td id='email' class='email'>" + new_email + "</td><td id='pwd' class='pwd'>" + new_pwd + "</td><td><input class='edit' type='button' id='edit_button" + table_len + "' onclick='checkBtn(" + table_len + ")' value='EDIT' /> </td> <td> <input type='button' value='Delete' class='delete' onclick='deleteRow(" + table_len + ")'></td></tr>";

}

function checkBtn(no) {

    var row_btn = document.getElementById("row" + no).getElementsByClassName("edit")[0].value;

    if (row_btn == "UPDATE") {
        updateRow(no);
    } else if (row_btn == "EDIT") {
        editRow(no);
    }
}

function editRow(no) {

    var row = document.getElementById("row" + no);


    var fullname = row.getElementsByClassName("fullname")[0];
    var email = row.getElementsByClassName("email")[0];
    var pwd = row.getElementsByClassName("pwd")[0];


    var updateBtn = document.getElementById("row" + no).getElementsByClassName("edit")[0];

    var EDIT_fullname = fullname.innerHTML;
    var EDIT_email = email.innerHTML;
    var EDIT_pwd = pwd.innerHTML;

    fullname.innerHTML = "<input type='text' class='update_name' id='UPDATE_name" + no + "' value='" + EDIT_fullname + "'>";
    email.innerHTML = "<input type='text' class='update_email' id='UPDATE_email" + no + "' value='" + EDIT_email + "'>";
    pwd.innerHTML = "<input type='text' class='update_pwd' id='UPDATE_pwd" + no + "' value='" + EDIT_pwd + "'>";

    updateBtn.value = "UPDATE";
}

function updateRow(no) {

    var row = document.getElementById("row" + no);

    var UPDATE_name = row.getElementsByClassName("update_name")[0].value;
    var UPDATE_email = row.getElementsByClassName("update_email")[0].value;
    var UPDATE_pwd = row.getElementsByClassName("update_pwd")[0].value;
    var updateBtn = document.getElementById("row" + no).getElementsByClassName("edit")[0];

    row.getElementsByClassName("fullname")[0].innerHTML = UPDATE_name;
    row.getElementsByClassName("email")[0].innerHTML = UPDATE_email;
    row.getElementsByClassName("pwd")[0].innerHTML = UPDATE_pwd;

    updateBtn.value = "EDIT";

}


function deleteRow(no) {
    document.getElementById("row" + no + "").outerHTML = "";
}
