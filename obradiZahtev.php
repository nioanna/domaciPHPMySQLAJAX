<?php
include "Database.php";
    $mydb =new Database("utakmice");
    if(isset($_POST["sacuvaj"])) {
        echo $_POST["sacuvaj"];
    }
    if(isset($_POST["sacuvaj"]) && $_POST["sacuvaj"]=="Sacuvaj"){
        if($_POST["brGolDom"]!=null && $_POST["brGolGost"]!=null && $_POST["gostujuciTim"]!=null && $_POST["domaciTim"]!=null && $_POST["grad"]!=null && $_POST["liga-select"]!=null && $_POST["datum"]!=null){
            $niz = ["idDomacegTIma"=> $_POST["domaciTim"], "idGostujucegTima"=>$_POST["gostujuciTim"], "datumIVreme"=>"'".date('Y-m-d',strtotime($_POST["datum"]))."'","brojGolovaDOmacegTIma"=>(int)$_POST["brGolDom"],"brojGolovaGostujucegTIma"=>(int)$_POST["brGolGost"],"grad"=>"'".$_POST["grad"]."'","idLiga"=>$_POST["liga-select"]];
            if($mydb->insert("utakmica", "idDomacegTIma, idGostujucegTima, datumIVreme, brojGolovaDOmacegTIma,brojGolovaGostujucegTIma,grad,idLiga",$niz)){
                echo "Uspesno sacuvana utakmica!";
            }else{
                 echo "Doslo je do greske!";
            }
            $_POST = array();
            header("Location: index.php");
            
        }
    }elseif(isset($_POST["izmeni"])) {
        $idUtakmice = $_POST["izmeni"];
        $idName = "idUtakmice";
        if($_POST["brGolDom"]!=null && $_POST["brGolGost"]!=null && $_POST["gostujuciTim"]!=null && $_POST["domaciTim"]!=null && $_POST["grad"]!=null && $_POST["liga-select"]!=null && $_POST["datum"]!=null){
            $niz = ["idDomacegTIma"=> $_POST["domaciTim"], "idGostujucegTima"=>$_POST["gostujuciTim"], "datumIVreme"=>"'".date('Y-m-d',strtotime($_POST["datum"]))."'","brojGolovaDOmacegTIma"=>(int)$_POST["brGolDom"],"brojGolovaGostujucegTIma"=>(int)$_POST["brGolGost"],"grad"=>"'".$_POST["grad"]."'","idLiga"=>$_POST["liga-select"]];
            if($mydb->update("utakmica", $idUtakmice,array_keys($niz),$niz,$idName)){
                echo "Uspesno izmenjena utakmica!";
            }else{
                 echo "Doslo je do greske!";
            }
            $_POST = array();
            header("Location: index.php");            
        }
    }elseif(isset($_POST["delete"])){
        $q = intval($_POST['delete']);
        $idName = "idUtakmice";
        if($mydb->delete("utakmica", $q,$idName)){
            echo "Uspesno izbrisana utakmica!";
        }else{
             echo "Doslo je do greske!";
        }
        $_POST = array();
    }
    ?>