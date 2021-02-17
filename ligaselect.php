<?php
include("Database.php");
$q = intval($_GET['q']);
$mydb = new Database("utakmice");
$mydb->select("utakmica","*","liga","idLiga","idLiga","utakmica.idLiga=$q");

echo '<table class="table table-striped">
    <thread>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Datum</th>
        <th scope="col">Domaci Tim</th>
        <th scope="col">Gostujuci Tim</th>
        <th scope="col">Rezultat</th>
        <th scope="col">Grad</th>
        <th scope="col">Liga</th>
        <th scope="col">Promena</th>
    </tr>
    <tbody>';
        $mydb2 = new Database("utakmice");
        $rb = 0;
        while ($red = $mydb->getResult()->fetch_object()) :
           echo '<tr>
                <th scope="row" value="'; echo $red->idUtakmice; echo '">'; echo ++$rb; echo'</th>
                <td>'; echo $red->datumIVreme; echo '</td>
                <td value="'; echo $red->idDomacegTIma; echo'">';
                                                                $mydb2->select("tim", "*", null, null, null, "idTima=$red->idDomacegTIma");
                                                                echo $mydb2->getResult()->fetch_object()->nazivTima;
                                                                echo '</td>
                <td value="'; echo $red->idGostujucegTima; echo '">';
                                                            $mydb2->select("tim", "*", null, null, null, "idTima=$red->idGostujucegTima");
                                                            echo $mydb2->getResult()->fetch_object()->nazivTima;
                                                            echo '</td>
                <td>'; echo $red->brojGolovaDOmacegTIma . ':' . $red->brojGolovaGostujucegTIma; echo'</td>
                <td>'; echo $red->grad; echo '</td>
                <td value="'; echo $red->idLige; echo '">'; echo $red->nazivLige; echo '</td>
                <td value="'; echo $red->idUtakmice; echo'"><button class="btn btn-success" type="button" name="izmeni" id="u'; echo $red->idUtakmice; echo'" value="'; echo $red->idUtakmice; echo'" onclick="izmeniUtakmicu(this.value)">Izmeni</button>
                                        
                <button class="btn btn-danger" type="button" name="izbrisi" id="d'; echo $red->idUtakmice; echo '" value="'; echo $red->idUtakmice; echo'" onclick="izbrisiUtakmicu(this.value)">Izbrisi</button>
                </td>

            </tr>';
            endwhile;
   echo  '</tbody>
</thread>
</table>';
?>