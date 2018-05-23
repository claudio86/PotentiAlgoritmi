<?php

class Mapper
{

    protected $token;

    protected $userData;

    public function setToken($token)
    {
        $_SESSION['token'] = $token;
    }

    public function getToken()
    {
        return $_SESSION['token'];
    }

    public function setUserData(){
        if(isset($_POST["kmAnno"]) && isset($_POST["kmMax"])&& isset($_POST["cBenza"])){
            $result = array();
            $result[0] = $this->checkUserData($_POST["kmAnno"]);
            $result[1] = $this->checkUserData($_POST["kmMax"]);
            $result[2] = $this->checkUserData($_POST["cBenza"]);
//            var_dump($result);
            $this->storeUserData($result);
        }else{return false;}
    }

    public function storeUserData($result){
        $_SESSION['user_data']=$result;
    }

    function checkUserData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getUserData(){
        if(isset($_SESSION['user_data'])) {
            if($_SESSION['user_data'][0]!="") {
                return $_SESSION['user_data'];
            }
            else{
                unset($_SESSION['user_data']);
                unset($_POST);
                return false;
            }
        }
        else {return false;}
    }

}