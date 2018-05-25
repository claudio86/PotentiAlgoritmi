<?php


class View {

    public function generateView($autoData,$userData,$calcData)
    {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
        <html lang="it">
        <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title>Potenti Algoritmi</title>
            <meta title="Potenti Algoritmi" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">



        </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
<!--                    <h1>Potenti Algoritmi</h1>-->
                </div>
            </div>
            <div class="row content" style="margin-bottom:24px;">

                <div class="col-md-6 col-sm-12">
<!--                    <h2>Inserisci dati utente</h2>-->
                    <form action="index.php"  method="post">

                        <input type="hidden" name="action" value="userData">

                        <div class="form-group">
                            <label for="kmAnno">Km percorsi mediamente all'anno</label>
                            <input class="form-control" id="kmAnno" type="text" name="kmAnno"
                                   value="<?php
                                   if($userData[0] != ''){echo $userData[0];} ?>" >
                        </div>
                        <div class="form-group" style="width: 48%;float: left;margin-right: 4%;">
                            <label for="kmMax">Km massimi da percorre</label>
                            <select class="form-control" id="kmMax" name="kmMax" >
                                <option id="kmMax" value="300000" <?php if($userData[1] == "300000"){echo"selected";}?>>300000</option>
                                <option id="kmMax" value="250000" <?php if($userData[1] == "250000"){echo"selected";}?>>250000</option>
                                <option id="kmMax" value="200000" <?php if($userData[1] == "200000"){echo"selected";}?>>200000</option>
                                <option id="kmMax" value="150000" <?php if($userData[1] == "150000"){echo"selected";}?>>150000</option>
                            </select>


<!--                            <input class="form-control" id="kmMax" type="text" name="kmMax" placeholder="--><?php //echo $userData[1]; ?><!--" value ="" >-->
                        </div>
                        <div class="form-group" style="width: 48%;float: left">
                            <label for="cBenza">Prezzo del carburante</label>
                            <input class="form-control" id="cBenza" type="text" name="cBenza"
                                   value="<?php if($userData[2] != ''){echo $userData[2];} ?>" >
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="submit" value="INVIA">
                        </div>

                    </form>

                </div>

                <div class="col-md-6 col-sm-12">
<!--                    <h2>Inserisci dati auto</h2>-->

                    <form action="index.php"  method="post">

                        <input type="hidden" name="action" value="autoData">

                        <div class="form-group" style="width:30%;float:left;margin-right: 4%;">

                            <label for="prezzoAuto">Prezzo</label>
                            <input class="form-control" id="prezzoAuto" type="text" name="prezzoAuto" value="">
                        </div>
                        <div class="form-group" style="width:30%;float:left;margin-right: 4%;">
                            <label for="annoAuto">Anno</label>
                            <select  class="form-control" id="annoAuto" name="annoAuto">

                            <?php

                                date_default_timezone_set('Europe/Rome');
                                $nowDate = getdate()['year'];

                                for($n = 1980; $n <= $nowDate; $n++){
                                    if($n==$nowDate){$selected= "selected";}
                                    echo "<option value=\"".$n."\" ".$selected."  >".$n."</option>";
                                }

                            ?>

                            </select>
                        </div>
                        <div class="form-group" style="width:30%;float:left;">
                            <label for="kmAuto">Km</label>
                            <input class="form-control" id="kmAuto" type="text" name="kmAuto" value="">
                        </div>
                        <div class="form-group" style="width:48%;float:left;margin-right: 4%;">
                            <label for="cBenza">Km/l</label>
                            <input class="form-control" id="kml" type="text" name="kml" value="">
                        </div>
                        <div class="form-group" style="width:48%;float:left;">
                            <label for="cBenza">Accessori</label>
                            <select  class="form-control" id="acc" name="acc">
                                <option value="1">Scarso</option>
                                <option value="2">Medio</option>
                                <option value="3">Alto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="submit" value="INVIA">
                        </div>

                    </form>

                </div>
            </div>
            <div class="row content" style="margin-bottom:24px;">

                <div class="col-md-12 col-sm-12">
                    <form action="index.php"  method="post" onsubmit="return confirm('Sicuro?');">
                        <input type="hidden" name="reset">
                        <div class="form-group">
                            <input class="form-control" type="submit" value="RESET">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ( $calcData != null ) {
                        $this->generateItemsTable($calcData,$userData);
                    }
                    ?>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <style>
            .values p {
                margin-bottom: 0px;
            }
            label {display: none;}
            th {display: none;}
        </style>
        </body>
        </html>
        <?php
    }

    public function generateItemsTable($results,$userData)
    {
        ?>
        <table class="table values">
            <th>Dati auto</th>
                <th>Durata auto<br />in anni</th>
                <th>Eta auto a<br /><?php echo $userData[1] ?>km</th>
                <th>Costo auto<br />per anno</th>
                <th>Valore<br />accessori</th>
                <th>km/l</th>
                <th>Score</th>


            <?php

            foreach ($results as $key => $item) {

                ?>
                <tr>
                    <td><?php echo "<p>Costo: " . $item[1][0] . "</p><p>Anno: " . $item[1][1] . "</p><p>Km: " . $item[1][2] ?></p></td>

                    <?php if(isset($item[0][0]) && isset($item[0][2]) && isset($item[0][1]) && isset($item[1][4]) && isset($item[1][3]) && isset($item[0][3])) { ?>
                        <td><?php echo $item[0][0]; ?> </td>
                        <td><?php echo $item[0][2]; ?> </td>
                        <td><?php echo $item[0][1]; ?></td>
                        <td><?php
                            if($item[1][4]==1){echo"Scarso";}
                            if($item[1][4]==2){echo"Medio";}
                            if($item[1][4]==3){echo"Alto";}
                            ?>
                        </td>
                        <td><?php echo $item[1][3]; ?></td>
                        <td><?php echo $item[0][3]; ?></td>
                    <?php }else{ ?>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <?php

                    } ?>

                    <td>
                        <form action="index.php"  method="post">
                            <input type="hidden" name="remove" value="<?php echo $key; ?>" onsubmit="return confirm('Sicuro?');>
                            <div class="form-group">
                                <input class="form-control" type="submit" value="remove">
                            </div>
                        </form>


                    </td>
                </tr>
        <?php } ?>
        </table>

    <?php  }

}