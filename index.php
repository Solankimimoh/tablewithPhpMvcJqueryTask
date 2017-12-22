<?php
include('controller/UserController.php');
include_once('model/UserModel.php');
?>
<?php

$controller = new UserController();

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];


    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (preg_match($regex, $email)) {

        $userModel = new UserModel($name, $email, $pwd);


        $table = "user_details";
        $data = array('u_name' => $name, 'u_email' => $email, 'u_pwd' => $pwd);


        $last_id = $controller->insertData($table, $data);

        if (isset($last_id)) {
            $response = array();
            $response['status'] = true;
            $response['id'] = $last_id;
            echo json_encode($response);
            exit;
        }

    } else {

        $response = array();
        $response['status'] = false;
        $response['error'] = $email . " is an invalid email. Please try again.";
        echo json_encode($response);
        exit;

    }


} else {

    $response = array();
    $response['status'] = false;
    $response['error'] = "Name and Email and Password Required";
    echo json_encode($response);
    exit;
}
if (isset($_POST['modelId'])
    && isset($_POST['modelFullname'])
    && isset($_POST['modelEmail'])
    && isset($_POST['modelPwd'])) {

    $modelId = $_POST['modelId'];
    $modelFullname = $_POST['modelFullname'];
    $modelEmail = $_POST['modelEmail'];
    $modelPwd = $_POST['modelPwd'];

    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (preg_match($regex, $email)) {

        $table = "user_details";
        $data = array('u_name' => $modelFullname, 'u_email' => $modelEmail, 'u_pwd' => $modelPwd);
        $where = array('u_id' => $modelId);


        $da = $controller->updateData($table, $data, $where);

        if (isset($da)) {
            $response = array();
            $response['status'] = true;
            echo json_encode($response);
            exit;
        }
    } else {
        $response = array();
        $response['status'] = false;
        $response['error'] = $email . " is an invalid email. Please try again.";
        echo json_encode($response);
        exit;
    }


} else {
    $response = array();
    $response['status'] = false;
    $response['error'] = "Name and Email and Password Required";
    echo json_encode($response);
    exit;
}
if (isset($_POST['id'])) {
    $deleteId = $_POST['id'][0];

    $table = "user_details";
    $where = array('u_id' => $deleteId);


    $delete = $controller->deletData($table, $where);


    if (isset($delete)) {
        $response = array();
        $response['status'] = true;
        echo json_encode($response);
        exit;
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>WebMob Task 1</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/mystyle.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!--     Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>


<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="center-block container-form">

                <form id="userForm">
                    <h4 class="page-header">Form Value</h4>
                    <div class="form-group float-label-control">
                        <label class="inputlable">Full name ex. john kapoor</label>
                        <input type="text" id="fullnameInput" name="Fullname" class="form-control letterswithspace"
                               placeholder="Username" required>
                    </div>
                    <div class="form-group float-label-control">
                        <label class="inputlable">Email</label>
                        <input type="email" id="emailInput" name="Email" class="form-control" placeholder="Email"
                               required>
                    </div>
                    <div class="form-group float-label-control">
                        <label class="inputlable">Password</label>
                        <input type="password" id="passwordInput" name="Password" class="form-control"
                               placeholder="Password" required>
                    </div>
                </form>

                <div class="form-group float-label-control">
                    <button class="form-control btn-sbmt" id="inserData">Insert Data</button>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-container table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <?php
                $result = $controller->getAllUser();

                foreach ($result as $key => $res) {
                    ?>

                    <tr id="row<?php echo $res['u_id']; ?>">

                        <td id="fullname" class="fullname"> <?php echo $res['u_name']; ?></td>
                        <td id="email" class="email"> <?php echo $res['u_email']; ?></td>
                        <td id="pwd" class="pwd"> <?php echo $res['u_pwd']; ?></td>
                        <td><input class="edit" type="button" id="editBtn"
                                   value="EDIT"/></td>
                        <td><input id="deleteBtn" type="button" value="Delete" class="delete"></td>

                    </tr>

                    <?php
                }
                ?>

            </table>

        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        User Update Details
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <form id="modelForm" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="modelInputFullname">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       id="modelInputFullname" name="modelInputFullname" placeholder="fullname"
                                       value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="modelInputFullname">Email</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control"
                                       id="modelInputID" name="modelInputId" value=""/>
                                <input type="email" class="form-control"
                                       id="modelInputEmail" name="modelInputEmail" placeholder="Email" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"
                                   for="modelInputPassword">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       id="modelInputPassword" name="modelInputPassword" placeholder="Password"
                                       value=""/>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="modelBtnUpdate" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
    <!--    <script src="js/datafunctions.js"></script>-->
    <script src="js/datafunctionsjquery.js"></script>

</body>

</html>
