<?php


class View {

    public function generateView($results)
    {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
        <html lang="it">
        <head>
            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title>Potenti Algoritmi</title>
            <meta title="Potenti Algoritmi" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Potenti Algoritmi</h1>
                </div>
            </div>
            <div class="row content" style="margin-bottom:24px;">

                <div class="col-md-6 col-sm-12">
                    <h2>Inserisci dati utente</h2>
                    <form action="index.php"  method="post">

                        <input type="hidden" name="userData">

                        <div class="form-group">
                            <label for="kmAnno">Km percorsi mediamente all'anno</label>
                            <input class="form-control" id="kmAnno" type="text" name="kmAnno" placeholder="<?php echo $results[1][0]; ?>" value ="" >
                        </div>
                        <div class="form-group">
                            <label for="kmMax">Km massimi che questa macchina puo' percorre</label>
                            <input class="form-control" id="kmMax" type="text" name="kmMax" placeholder="<?php echo $results[1][1]; ?>" value ="" >
                        </div>
                        <div class="form-group">
                            <label for="cBenza">Prezzo del carburante</label>
                            <input class="form-control" id="cBenza" type="text" name="cBenza" placeholder="<?php echo $results[1][2]; ?>" value ="" >
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="submit" value="INVIA">
                        </div>

                    </form>

                </div>

                <div class="col-md-6 col-sm-12">
                    <h2>Inserisci dati auto</h2>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ( $results!=null ) {

                        $this->generateItemsTable($results);
                    }
                    ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    }

    public function generateItemsTable($results)
    {
        ?>
        <table class="table">
            <th>Dati auto</th><th>Durata stimata anni</th><th>Eta a 200k km</th><th>Costo Anno</th><th>Valore accessori</th><th>Hp</th><th>Score</th>

            <?php

            foreach ($results[0] as $item) {
                echo "
                <tr><td>Costo: " . $item[1][0] . " - Anno: " . $item[1][1] . " - Km: " . $item[1][2] . "</td>
                <td>" . $item[0][0] . "</td><td>" . $item[0][2] . "</td>
                <td>" . $item[0][1] . "</td><td>" . $item[1][4] . "</td><td>" . $item[1][3] . "</td><td>" . $item[0][3] . "</td></tr>";
            }

            ?>

        </table>

    <?php  }

}