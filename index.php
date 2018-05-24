<?php

require ('mapper.php');
require ('view.php');

class Calc
{

    public function __construct()
    {
        session_start();

        $this->identityCheck();
        $this->raccogliDati();

    }

    public function raccogliDati()
    {
        $mapper = new Mapper();
        $autoData = null; // autoData
        $userData = null; // userData
        $calcData = null; // calcData

        if(isset($_POST['reset'])) {
            $mapper->reset();
        }

        if(isset($_POST['remove'])) {
            $mapper->remove();
        }

        if(isset($_POST['action'])) {

            if ($_POST['action'] == 'autoData') {
                if (!$mapper->setAutoData()){
                    var_dump("SetAuto-false".false);
                }
            }

            if ($_POST['action'] == 'userData') {
                if ($mapper->setUserData() === false){
                    var_dump("SetUser-false".false);
                }
            }

            $_POST = array();
        }

        if ($mapper->getAutoData() != false) {
            $autoData = $mapper->getAutoData();
        }
        else{
            var_dump("GetAuto-false".false);
        }
        if ($mapper->getUserData() != false) {
            $userData = $mapper->getUserData();
        }
        else{
            var_dump("GetUser-false".false);
        }
//        var_dump($result[1]);

        var_dump($autoData);

        if($autoData != null && $userData != null) {
            $calcData = array();
            foreach ($autoData as $item) {
                $calcData[] = array($this->calcola($item), $item);
            }
        }


        //
//var_dump($_SESSION['auto_data']);
//var_dump($mapper->getAutoData());
//var_dump($result[2]);
//
//
//var_dump($_SESSION['user_data']);
//var_dump($mapper->getUserData());
//var_dump($result[1]);

        $view = new View();
        $view->generateView($autoData,$userData,$calcData);
    }


    public function calcola($array)
    {

        $mapper = new Mapper();
        $userData = $mapper->getUserData();
        $kmAnno = intval ($userData[0]);
        $kmMax = intval ($userData[1]);
        $anno = 2018;
        $anni = $anno - intval($array[1]);
        $kmAuto = $array[2];
        $prezzoAuto = $array[0];
        $bz = intval($array[3])   ;
        $dz = floatval  ($userData[2]);
        $acc = $array[4];
        $t = 0; //tasse da fare

        // anni prima di arrivare a 200k
        $anniDurataAuto = round(($kmMax - $kmAuto) / $kmAnno, 1);
        $etaAutoAFineVita = round($anni + $anniDurataAuto, 1);

        // costo anno auto
        $costoAuto = round(($prezzoAuto / $anniDurataAuto), 1);

        // costo anno carburante
        $costoCarburante = ($dz / $bz) * $kmAnno;

        // costo anno carburante + auto
        $costoAnno = round($costoCarburante + $costoAuto + $t, 2);

        // $score = round(( $costoAnno / 1000) ,2);
        $score = round(($anniDurataAuto) / ($etaAutoAFineVita) / ($costoAnno / 1000) + ($acc / 10), 2);

        return array($anniDurataAuto, $costoAnno, $etaAutoAFineVita, $score);
    }

    public function ordinaItems($items)
    {

        $ording = array();
        foreach ($items as $key => $itemToOrder) {
            $ording[$key] = $itemToOrder[0][1];
        }
        asort($ording);
        $result = array();
        foreach ($ording as $key => $value) {
            $result[] = $items[$key];
        }
        return $result;
    }

    public function identityCheck(){
        $mapper = new Mapper();
        // assegna token quando entri
        if($mapper->getToken() == null){
            if(!filter_var($_GET['token'], FILTER_VALIDATE_URL)){
                header('Location: http://localhost/potentialgoritmi/index.php');
            }
            $this->startSession();
        }
    }

    public function startSession(){
        $mapper = new Mapper();
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
        $mapper->setToken($rand);
        header("location: http://localhost/potentialgoritmi/index.php/token=".$rand);
    }

    public function startDb(){
        new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'algoritmi',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);

    }

}

$start = new Calc;