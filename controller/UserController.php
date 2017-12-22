<?php
/**
 * Created by PhpStorm.
 * User: Srushti Kareliya
 * Date: 20-12-2017
 * Time: 12:40 PM
 */
//
include_once 'db/DbConfig.php';
include_once 'model/UserModel.php';


class UserController extends DbConfig
{

    public function __construct()
    {
        parent::__construct();
    }


//    public function insertUser($userObj)
//    {
//        $name = $userObj->getUserName();
//        $email = $userObj->getUserEmail();
//        $pwd = $userObj->getUserPwd();
//
//        $insertQuery = "INSERT INTO `user_details`(`u_name`, `u_email`, `u_pwd`) VALUES ('$name','$email','$pwd')";
//
//        $result = $this->connection->query($insertQuery);
//
//        if ($result == false) {
//            echo 'Error: cannot execute the command';
//            return false;
//        } else {
//            return true;
//        }
//    }


    public function insertData($table, $data)
    {
        $key = array_keys($data);
        $val = array_values($data);
        $sql = "INSERT INTO $table (" . implode(', ', $key) . ") " . "VALUES ('" . implode("', '", $val) . "')";

        $result = $this->connection->query($sql);

        $last_id = $this->connection->insert_id;

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return $last_id;
        }
    }


    // function  UPDATE query
    function updateData($table, $data, $where)
    {
        $cols = array();

        foreach ($data as $key => $val) {
            $cols[] = "$key = '$val'";
        }

        foreach ($where as $key => $val) {
            $whereCols[] = "$key = $val";
        }


        $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE " . implode(', ', $whereCols);

        $result = $this->connection->query($sql);

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return true;
        }
    }


    function deletData($table, $where)
    {
        $whereCols = array();


        foreach ($where as $key => $val) {
            $whereCols[] = "$key =  $val";
        }

        $sql = "DELETE FROM $table WHERE " . implode(', ', $whereCols);

        $result = $this->connection->query($sql);

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return $sql;
        }
    }


    public function getAllUser()
    {
        $insertQuery = "SELECT * FROM `user_details`";

        $result = $this->connection->query($insertQuery);

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

}