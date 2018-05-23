

<?php
require 'connect.php';

    if(isset($_GET['sezona']))
    {
        
        
        $sezona=$_GET['sezona'];
        
     //pravim var koja ce sluziti za poziciju u tabeli
    $poz=1;
        
        
    $upitkora='SELECT id_sezone FROM sezona WHERE godina="'.$sezona.'"';    
    $prikazkora=$conn->query($upitkora);
        
    $rows1=$prikazkora->fetch_assoc();
    
    $sez_id=$rows1['id_sezone'];
    
      
    
    //sada cemo da napravimo tabelu koja ce sadrzati sve klubove u sezoni i osvojene bodove
    $htmltabela='<table id="tabela"><tr><th>Pozicija</th><th>Klub</th><th>Bodovi</th></tr>';
    
    
    $upit_za_tabelu='SELECT ime_kluba,bodovi FROM klubovi_u_sezoni INNER JOIN klub ON klubovi_u_sezoni.id_kluba = klub.id_kluba WHERE id_sezone="'.$sez_id.'" ORDER BY bodovi DESC';
    
    $prikaz_za_tabelu=$conn->query($upit_za_tabelu);
    
    while($rows=$prikaz_za_tabelu->fetch_assoc()){
        $htmltabela.='<tr><td>'.$poz.'</td><td>'.$rows['ime_kluba'].'</td><td>'.$rows['bodovi'].'</td></tr>';
        $poz++;
    }
    
    
    $htmltabela.='</table>';

    
        
        echo $htmltabela;


    }


  















?>