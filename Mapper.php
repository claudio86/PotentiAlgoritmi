<?php

class Mapper
{

    protected $token;

    protected $userData;
    protected $autoData;

    public function setToken($token)
    {
        $_SESSION['token'] = $token;
    }

    public function getToken()
    {
        return $_SESSION['token'];
    }

    public function reset(){
        unset($_SESSION['auto_data']);
        unset($_SESSION['user_data']);
        unset($_POST);
    }


    public function remove()
    {
        unset($_SESSION['auto_data'][$_POST['remove']]);
        unset($_POST['remove']);
    }

    public function setUserData(){
        if(isset($_POST["kmAnno"]) && isset($_POST["kmMax"])&& isset($_POST["cBenza"])){
            $result = array();
            $result[0] = $this->checkData($_POST["kmAnno"]);
            $result[1] = $this->checkData($_POST["kmMax"]);
            $result[2] = $this->checkData($_POST["cBenza"]);
            if(!isset($_SESSION['user_data'])){
                $_SESSION['user_data'] = array();
            }
            $this->storeUserData($result);
        }else{return false;}
    }

    public function storeUserData($result){
        $_SESSION['user_data'] = $result;
    }

    public function getUserData(){
        if(isset($_SESSION['user_data'])) {
            if($_SESSION['user_data'][0]!="") {
                return $_SESSION['user_data'];
            }
            else{
                unset($_SESSION['user_data']);
                unset($_POST['user_data']);
                return false;
            }
        }
        else {return false;}
    }

    public function setAutoData(){
        if(
            isset($_POST["prezzoAuto"]) &&
            isset($_POST["annoAuto"])&&
            isset($_POST["kmAuto"]) &&
            isset($_POST["kml"]) &&
            isset($_POST["acc"]))
        {
            if(!isset($_SESSION['auto_data'])){
                $_SESSION['auto_data'] = array();
            }

            $results=array();
            array_push($results, $this->checkData($_POST["prezzoAuto"]));
            array_push($results, $this->checkData($_POST["annoAuto"]));
            array_push($results, $this->checkData($_POST["kmAuto"]));
            array_push($results, $this->checkData($_POST["kml"]));
            array_push($results, $this->checkData($_POST["acc"]));
            if(!in_array($results, $_SESSION['auto_data'])) {
                array_push($_SESSION['auto_data'], $results);
            }


        }
        else{return false;}
    }



    function checkData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getAutoData(){


        if(isset($_SESSION['auto_data'])) {

            if($_SESSION['auto_data']!= "") {
                return $_SESSION['auto_data'];
            }
            else{
                unset($_SESSION['auto_data']);
                unset($_POST);
                return false;
            }
        }
        else {return false;}
    }



}