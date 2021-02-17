<!DOCTYPE html>
<html lang="en-us">

<head>
    <title>Rezultati Utakmica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</head>

<?php
include("obradiZahtev.php");
?>

<body>
    <div class="container">
        <h1> Rezulati Utakmica </h1>
    </div>
    <div class="row justify-content-md-center">
        <div class="container">
            <form class="form-inline" method="GET">
                <button class="btn btn-primary btn-lg" type="button" name="dodajUtakmicu" id="dodajUtakmicu"> Dodaj novu utakmicu</button>
                <div class="form-group">
                    <label for="liga-select">Liga:</label>
                    <select class="form-control" name="liga-select" id="liga-select" onchange="showTable(this.value)">
                        <?php
                        $mydb->select("liga", "*", null, null, null);
                        while ($red = $mydb->getResult()->fetch_object()) :
                        ?>
                            <option value="<?php echo $red->idLiga; ?>"><?php echo $red->nazivLige; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pretragaG">Pretraga:</label>
                    <input type="text" name="pretragaG" id="pretragaG" class="form-control" placeholder="Unesite pretragu" onkeyup="showResult(this.value)">
                </div>
            </form>
        </div>
    </div>
    <!-- deo da se dodaje nova utakmica -->
    <div class="container" id="dodaj_utakmicu">
        <form method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <label for="domaciTim">DomaciTim:</label>
                    <select class="form-control" name="domaciTim" id="domaciTim">
                        <?php
                        $mydb->select("tim", "*", null, null, null);
                        while ($red = $mydb->getResult()->fetch_object()) :
                        ?>
                            <option value="<?php echo $red->idTima; ?>"><?php echo $red->nazivTima; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="gostujuciTim">GostujuciTim:</label>
                    <select class="form-control" name="gostujuciTim" id="gostujuciTim">
                        <?php
                        $mydb->select("tim", "*", null, null, null);
                        while ($red = $mydb->getResult()->fetch_object()) :
                        ?>
                            <option value="<?php echo $red->idTima; ?>"><?php echo $red->nazivTima; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="brGolDom">Broj golova domaceg tima:</label>
                    <input class="form-control" type="text" name="brGolDom" id="brGolDom">
                </div>
                <div class="col-sm-6">
                    <label for="brGolGost">Broj golova gostujuceg tima:</label>
                    <input class="form-control" type="text" name="brGolGost" id="brGolGost">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="grad">Grad:</label>
                    <input class="form-control" type="text" name="grad" id="grad">
                </div>
                <div class="col-sm-4">
                    <label for="lig2"> Liga: </label>
                    <select class="form-control" name="liga-select" id="liga-select">
                        <?php
                        $mydb->select("liga", "*", null, null, null);
                        while ($red = $mydb->getResult()->fetch_object()) :
                        ?>
                            <option value="<?php echo $red->idLiga; ?>"><?php echo $red->nazivLige; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="datum">Datum:</label>
                    <input class="form-control" type="date" name="datum" id="datum" value="Y-m-d">
                </div>
            </div>
            <div class="row" style="justify-content:flex-end;">
            <label for="error"><?php echo $error;?></label>
            </div>
            <div class="row" style="justify-content:flex-end;">
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="sacuvaj" id="sacuvaj" value="Sacuvaj">
                    <input class="btn btn-success" type="submit" name="izmeni" id="izmeni" value="Izmeni" style="display: none;">
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="reset" name="ponistiUnos" id="ponistiUnos">Ponisti</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <!-- kraj dela da se unese nova utakmica -->

    <!-- deo sa tabelom prikaza -->
    <div class="container-fluid" id="tabelaD">
        <form id="tabela">
            <div class="table-responsive" id="tbl">
                <table class="table table-striped" id="tbl1">
                    <thread>
                        <tr>
                            <th  scope="col">#</th>
                            <th  scope="col">Datum</th>
                            <th  scope="col">Domaci Tim</th>
                            <th  scope="col">Gostujuci Tim</th>
                            <th  scope="col">Rezultat</th>
                            <th  scope="col">Grad</th>
                            <th  scope="col">Liga</th>
                            <th  scope="col">Promena</th>
                        </tr>
                        <tbody>
                            <?php
                            $mydb2 = new Database("utakmice");
                            $mydb->select("utakmica", "*", "liga", "idLiga", "idLiga",null,"datumIVreme DESC");
                            $rb = 0;
                            while ($red = $mydb->getResult()->fetch_object()) :
                            ?>
                                <tr>
                                    <th scope="row" value="<?php echo $red->idUtakmice; ?>"><?php echo ++$rb; ?></th>
                                    <td><?php echo $red->datumIVreme; ?></td>
                                    <td value="<?php echo $red->idDomacegTIma; ?>"><?php
                                                                                    $mydb2->select("tim", "*", null, null, null, "idTima=$red->idDomacegTIma");
                                                                                    echo $mydb2->getResult()->fetch_object()->nazivTima;
                                                                                    ?></td>
                                    <td value="<?php echo $red->idGostujucegTima; ?>"><?php
                                                                                        $mydb2->select("tim", "*", null, null, null, "idTima=$red->idGostujucegTima");
                                                                                        echo $mydb2->getResult()->fetch_object()->nazivTima;
                                                                                        ?></td>
                                    <td><?php echo $red->brojGolovaDOmacegTIma . ':' . $red->brojGolovaGostujucegTIma; ?></td>
                                    <td><?php echo $red->grad; ?> </td>
                                    <td value="<?php echo $red->idLige; ?>"><?php echo $red->nazivLige; ?></td>
                                    <td value="<?php echo $red->idUtakmice; ?>"><button class="btn btn-success" type="button" name="izmeni" id="u<?php echo $red->idUtakmice; ?>" value="<?php echo $red->idUtakmice; ?>" onclick="izmeniUtakmicu(this.value)">Izmeni</button>

                                        <button class="btn btn-danger" type="button" name="izbrisi" id="d<?php echo $red->idUtakmice; ?>" value="<?php echo $red->idUtakmice; ?>" onclick="izbrisiUtakmicu(this.value)">Izbrisi</button>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </thread>
                </table>

            </div>
        </form>
    </div>
    <!-- kraj dela sa tabelom -->
    <!-- forma za upit brisanja -->
    <!-- margin-left: window.I -->

    <div class="del" id="del">
        <form id="delForm" class="form-container" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upozorenje!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Da li zelite da izbriste oznacenu utakmicu?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="delete" name="delete" value="">Da</button>
                    <button type="reset" class="btn btn-secondary" id="ne" onchange="sakriBlok"> Ne</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="del">
        <form id="delForm" class="form-container" method="POST">
            <h2> Da li zelite da izbrisete utakmicu?</h2>
            <button type="submit" id="delete" name="delete" value="">Da</button>
            <button type="reset" id="ne" onchange="sakriBlok"> Ne</button>
        </form>
    </div>
    <!-- kraj forme sa upitom -->

</body>

</html>
<script>
    function skloniBlok() {
        document.getElementById("dodaj_utakmicu").style.display = "none";
        document.getElementById("izmeni").style.display = "none";
        document.getElementById("del").style.display = "none";
    }
    console.log("Sklanjam blok");


    $("button[id=dodajUtakmicu]").on("click", prikaziBlok);
    $("button[id=ponistiUnos]").on("click", skloniBlok);
    $("button[id=ne]").on("click", skloniBlok);

    function prikaziBlok() {
        document.getElementById("dodaj_utakmicu").style.display = "block";
    }
    //prikazi tabele po ligama
    function showTable(ligaId) {
        if (ligaId != "") {
            document.getElementById("tbl").innerHTML = "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tbl").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "ligaselect.php?q=" + ligaId, true);
            xmlhttp.send();
        }
    }
    //pretraga
    function showResult(search) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tbl").innerHTML = this.responseText;
                document.getElementById("tbl").style.border = "1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET", "pretraga.php?q=" + search, true);
        xmlhttp.send();
    }

    function izmeniUtakmicu(izmena) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dodaj_utakmicu").style.display = "block";
                document.getElementById("dodaj_utakmicu").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "izmena.php?q=" + izmena, true);
        xmlhttp.send();

    }

    function izbrisiUtakmicu(izbrisati) {
        console.log("Prikazujem blok");
        document.getElementById("del").style.display = "block";
        document.getElementById("delete").value = izbrisati;
        console.log("Greska");
    }
    function sort(n) {
        var tbl, rows, switching, i,x,y,shouldSwitch,dir,switchcount=0;
        tbl = document.getElementById("tbl1");
        switching = true;
        dir="asc";

        while(switching) {
            switching=false;
            rows = tbl.rows;
            for(i=1;i<(rows.length-1);i++) {
                shouldSwitch = false;
                x=rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if(dir=="asc"){
                if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
                
            }else if(dir="desc"){
                if(x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
            if(shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i+1],rows[i]);
            switching = true;
            switchcount++;
        } else{
            if(switchcount ==0 && dir=="asc") {
                dir = "desc";
                switching=true;
            }
        }
        }
        
    }

</script>
