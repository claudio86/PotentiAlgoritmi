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

//        $this->startDb();
    }

    public function raccogliDatiUtente(){

    }

    public function raccogliDati()
    {
        $mapper = new Mapper();

        $array = array();
        array_push($array, array(7000, 2013, 60000,  22, 1));
        array_push($array, array(8400, 2013, 60000,  22, 2));
        array_push($array, array(8500, 2014, 55000,  22, 1));
        array_push($array, array(8900, 2014, 65000,  22, 2));
        array_push($array, array(9200, 2014, 55000,  22, 2));
        array_push($array, array(9300, 2013, 35000,  18, 1));
        array_push($array, array(9400, 2013, 20000,  18, 2));
        array_push($array, array(9500, 2015, 25000,  22, 3));
        array_push($array, array(9900, 2014, 55000,  22, 2));
        array_push($array, array(9900, 2014, 35000,  22, 2));
        array_push($array, array(10000, 2014, 45000, 18, 2));
        array_push($array, array(10500, 2015, 22000, 22, 2));
        array_push($array, array(10950, 2015, 35000, 22, 2));
        array_push($array, array(11150, 2016, 20000, 18, 2));
        array_push($array, array(11200, 2016, 35000, 22, 2));
        array_push($array, array(11450, 2016, 25000, 18, 2));
        array_push($array, array(11800, 2017, 0,     22, 2 ));
        if(isset($_POST['userData'])) {
            $mapper->setUserData();
            $items = array();
            foreach ($array as $item) {
                $items[] = array($this->calcola($item), $item);
            }
            $result = array(
                $this->ordinaItems($items),
                $mapper->getUserData()
            );
        }
        else{$result=null;}

        $view = new View();
        $view->generateView($result);
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

    public function calcola($array)
    {

        $mapper = new Mapper();
        $userData = $mapper->getUserData();
        $kmAnno = intval ($userData[0]);
        $kmMax = intval ($userData[1]);
        $anno = 2018;
        $anni = $anno - $array[1];
        $kmAuto = $array[2];
        $prezzoAuto = $array[0];
        $bz = $array[3];
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


}

$start = new Calc;