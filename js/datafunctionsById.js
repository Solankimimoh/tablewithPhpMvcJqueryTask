function addData() {


    var new_fullname = document.getElementById("fullnameInput").value;
    var new_email = document.getElementById("emailInput").value;
    var new_pwd = document.getElementById("passwordInput").value;

    var table = document.getElementById("data_table");
    var table_len = (table.rows.length);

    var row = table.insertRow(table_len).outerHTML =
        "<tr id='row" + table_len + "'><td id='fullname" + table_len + "'>" + new_fullname + "</td><td id='email" + table_len + "'>" + new_email + "</td><td id='pwd" + table_len + "'>" + new_pwd + "</td><td><input type='button' id='edit_button" + table_len + "' onclick='checkBtn(" + table_len + ")' value='EDIT' /> </td> <td> <input type='button' value='Delete' class='delete' onclick='deleteRow(" + table_len + ")'></td></tr>";

}

function checkBtn(no) {

    var btn = document.getElementById("edit_button" + no);

    if (btn.value == "UPDATE") {
        updateRow(no);
    } else if (btn.value == "EDIT") {
        editRow(no);
    }
}

function editRow(no) {

    var fullname = document.getElementById("fullname" + no);
    var email = document.getElementById("email" + no);
    var pwd = document.getElementById("pwd" + no);
    var updateBtn = document.getElementById("edit_button" + no);

    var EDIT_fullname = fullname.innerHTML;
    var EDIT_email = email.innerHTML;
    var EDIT_pwd = pwd.innerHTML;

    fullname.innerHTML = "<input type='text' id='UPDATE_name" + no + "' value='" + EDIT_fullname + "'>";
    email.innerHTML = "<input type='text' id='UPDATE_email" + no + "' value='" + EDIT_email + "'>";
    pwd.innerHTML = "<input type='text' id='UPDATE_pwd" + no + "' value='" + EDIT_pwd + "'>";

    updateBtn.value = "UPDATE";

}

function updateRow(no) {

    var UPDATE_name = document.getElementById("UPDATE_name" + no).value;
    var UPDATE_email = document.getElementById("UPDATE_email" + no).value;
    var UPDATE_pwd = document.getElementById("UPDATE_pwd" + no).value;
    var updateBtn = document.getElementById("edit_button" + no);

    document.getElementById("fullname" + no).innerHTML = UPDATE_name;
    document.getElementById("email" + no).innerHTML = UPDATE_email;
    document.getElementById("pwd" + no).innerHTML = UPDATE_pwd;

    updateBtn.value = "EDIT";

}


function deleteRow(no) {
    document.getElementById("row" + no + "").outerHTML = "";
}
