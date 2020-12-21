<?php
include("Database.php");
$q = intval($_GET['q']);
$mydb = new Database("utakmice");
$mydb2 = new Database("utakmice");
$mydb->select("utakmica", "*", "liga", "idLiga", "idLiga", "idUtakmice=$q");
while ($red2 = $mydb->getResult()->fetch_object()) :
    $idDomTima = $red2->idDomacegTIma;
    $idGTima = $red2->idGostujucegTima;
    $brGolDom = $red2->brojGolovaDOmacegTIma;
    $brGolGo = $red2->brojGolovaGostujucegTIma;
    $grad = $red2->grad;
    $idLig = $red2->idLiga;
    $dat = $red2->datumIVreme;
endwhile;
echo '
<form method="post">
<div class="row"> 
    <div class="col-sm-6"> 
        <label for="domaciTim">DomaciTim:</label> 
        <select class="form-control" name="domaciTim" id="domaciTim" >';
$mydb2->select("tim", "*", null, null, null);
while ($red = $mydb2->getResult()->fetch_object()) :
    if ($red->idTima == $idDomTima) {
        echo '<option value="';
        echo $red->idTima;
        echo '" selected>';
        echo $red->nazivTima;
        echo '</option>';
    } else {
        echo '<option value="';
        echo $red->idTima;
        echo '">';
        echo $red->nazivTima;
        echo '</option>';
    }
endwhile;
echo '</select>
    </div>
    <div class="col-sm-6">
        <label for="gostujuciTim">GostujuciTim:</label>
        <select class="form-control" name="gostujuciTim" id="gostujuciTim">';
$mydb2->select("tim", "*", null, null, null);
while ($red = $mydb2->getResult()->fetch_object()) :
    if ($red->idTima == $idGTima) {
        echo '<option value="';
        echo $red->idTima;
        echo '" selected>';
        echo $red->nazivTima;
        echo '</option>';
    } else {
        echo '<option value="';
        echo $red->idTima;
        echo '">';
        echo $red->nazivTima;
        echo '</option>';
    }
endwhile;
echo '</select>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label for="brGolDom">Broj golova domaceg tima:</label>
        <input class="form-control" type="text" name="brGolDom" id="brGolDom" value="';
echo $brGolDom;
echo '">
    </div>
    <div class="col-sm-6">
        <label for="brGolGost">Broj golova gostujuceg tima:</label>
        <input class="form-control" type="text" name="brGolGost" id="brGolGost" value="';
echo $brGolGo;
echo '">
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <label for="grad">Grad:</label>
        <input class="form-control" type="text" name="grad" id="grad" value="';
echo  $grad;
echo '">
    </div>
    <div class="col-sm-4">
        <label for="lig2"> Liga: </label>
        <select class="form-control" name="liga-select" id="liga-select">';
$mydb2->select("liga", "*", null, null, null);
while ($red = $mydb2->getResult()->fetch_object()) :
    if ($red->idLiga == $idLig) {
        echo '<option value="';
        echo $red->idLiga;
        echo '" selected>';
        echo $red->nazivLige;
        echo '</option>';
    } else {
        echo '<option value="';
        echo $red->idLiga;
        echo '">';
        echo $red->nazivLige;
        echo '</option>';
    }
endwhile;
echo '</select>
    </div>
    <div class="col-sm-4">
        <label for="datum">Datum:</label>
        <input class="form-control" type="date"  name="datum" id="datum" value="';
echo date("Y-m-d", strtotime($dat));
echo '">
    </div>
</div>
<div class="row">
    <input type="submit" name="sacuvaj" id="sacuvaj" value="Sacuvaj" style="display: none;">
    <button class="btn btn-success" type="submit" name="izmeni" id="izmeni" value="';
echo $q;
echo '" style="display: block;">Izmeni</button>
    <button class="btn btn-danger" type="reset" name="ponistiUnos" id="ponistiUnos">Ponisti</button>
</div>
</form>';
?>
