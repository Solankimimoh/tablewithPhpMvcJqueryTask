<?php
/**
 * Created by PhpStorm.
 * User: Srushti Kareliya
 * Date: 20-12-2017
 * Time: 12:17 PM
 */

class UserModel
{

    private $userName;
    private $userEmail;
    private $userPwd;

    /**
     * UserModel constructor.
     * @param $userName
     * @param $userEmail
     * @param $userPwd
     */
    public function __construct($userName, $userEmail, $userPwd)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userPwd = $userPwd;
    }


    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @return mixed
     */
    public function getUserPwd()
    {
        return $this->userPwd;
    }

    /**
     * @param mixed $userPwd
     */
    public function setUserPwd($userPwd)
    {
        $this->userPwd = $userPwd;
    }




}