function addData() {


    let new_fullname = document.getElementById("fullnameInput").value;
    let new_email = document.getElementById("emailInput").value;
    let new_pwd = document.getElementById("passwordInput").value;

    let table = document.getElementById("data_table");
    let table_len = (table.rows.length);

    let row = table.insertRow(table_len).outerHTML =
        `<tr id="row${table_len}"> <td id="fullname" class="fullname"> ${new_fullname} </td> <td id="email" class="email"> ${new_email} </td>  <td id="pwd" class="pwd"> ${new_pwd} </td>  <td><input class="edit" type="button" id="edit_button" onclick="checkBtn(${table_len})" value="EDIT" /> </td> <td> <input type="button" value="Delete" class="delete" onclick="deleteRow(${table_len})"></td></tr>`;




}

function checkBtn(no) {

    let row_btn = document.getElementById("row" + no).getElementsByClassName("edit")[0].value;

    if (row_btn == "UPDATE") {
        updateRow(no);
    } else if (row_btn == "EDIT") {
        editRow(no);
    }
}

function editRow(no) {

    let row = document.getElementById("row" + no);

    for (var i = 0; i < 3; i++) {

        row.getElementsByTagName('td')[i].style.background = "rgb(243, 242, 242)";
        row.getElementsByTagName('td')[i].contentEditable = true;
    }

    let updateBtn = document.getElementById("row" + no).getElementsByClassName("edit")[0];
    updateBtn.value = "UPDATE";
}

function updateRow(no) {

    let row = document.getElementById("row" + no);
    let updateBtn = document.getElementById("row" + no).getElementsByClassName("edit")[0];

    for (var i = 0; i < 3; i++) {
        row.getElementsByTagName('td')[i].style.background = "#fff";
    }

    updateBtn.value = "EDIT";

}

function deleteRow(no) {
    document.getElementById("row" + no + "").outerHTML = "";
}
