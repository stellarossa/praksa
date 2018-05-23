<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Praksa</title>
    <style>
        *{font-family: sans-serif}
        
        h1, h3 {
            text-align: center;
        }
        
        
        #okvir_sezona{
            box-shadow: 1px 1px 1px grey;
            width: 340px;
            margin: 0px auto;
            background: #f6f6f6;
            padding: 10px;
            font-size: 13px;
            text-align: center;
        }
        
        #tabela{            
            margin: 0px auto;
            width: 600px;
            border-collapse: collapse;
            font-family: sans-serif;
            box-shadow: 1px 1px 1px grey;
            
            
        }  
        
        #tabela th{
            text-align: left;
            background: #ea6153;
            border-collapse: collapse;
            color: #f6f6f6;
            font-size: 13px;
            height: 25px;
            
        }
        
        #tabela tr{
            background:#f6f6f6;
            color: #484747;
        }
        
        #tabela tr:hover{
            background:#e9e9e9;
            color: #484747;
            
        }
        
        #tabela td{
            border-collapse: collapse;
            border-bottom: 1px solid #e8e8e8;
            height: 20px;
            font-size: 13px;
        }
        
        #meni{
            border:0px;
            border-bottom: 1px solid #ea6153;
            width: 150px;
            background: #f6f6f6;
            margin-left: 10px;
        }
        
        #upisana_sezona{
            margin-left: 38px;
            border: 1px solid #ea6153;
            width: 150px;
            font-size: 12px;
            text-align: center;
        }
        
        #dugme_kreiraj{
            border: 0px;
            height: 25px;
            width: 120px;  
        }
        
        #dugme_kreiraj:hover{
            opacity: 0.8; 
        }
        
        #okvir_utakmica{
            box-shadow: 1px 1px 1px grey;
            width: 550px;
            margin: 0px auto;
            background: #f6f6f6;
            font-size: 13px;
            padding: 10px;
        }
        
        #sez_za_mec,#domacin,#gost{
            width: 130px;
            border:0px;
            border-bottom: 1px solid #ea6153;
            background: #f6f6f6;            
        }
        
        #domacin{
            margin-left: 15px;
        }
        
        #rez_d,#rez_g{
            
            border: 1px solid #ea6153;
            width: 100px;
            font-size: 12px;
            text-align: center;
        }
        
        #dugme_mec,#reset_dugme{
            border: 0px;
            height: 20px;
            width: 80px;
            font-size: 13px;
        }
        
        #dugme_mec:hover{
            opacity: 0.8;
        }
        
        #reset_dugme:hover{
            opacity: 0.8;
        }
    </style>
</head>
<body>
  <h1>Super Liga Srbija</h1>  
  
 <!--ovde otvaram div okvir_sezona unutar kojeg ce da bude lista sa kreiranim sezonama kao i forma za kreiranje nove sezone-->
 <div id="okvir_sezona">
 
<!--ovde cemo napraviti meni u kojem ce moci da se izabere sezona koju hocemo da pogledamo--> 
<?php 
 $conn= new mysqli('localhost','root','',"semanova");
    /*
    if($conn->connect_error){
        echo "Greska";
    }
    else
    {
        echo "Sve je OK";
    }
    */
    
    //napraviti niz sezona 
    $sezona=[];
    $brojac=0;
    
   
    
    //select lista u kojoj ce biti sve sezone
    $select='<select onchange="funk_sezona(value)" id="meni"><option value="">Izaberite sezonu</option>';
    
    //ovde selektujemo tabelu sezona
    $upit_sezona='SELECT * FROM sezona ORDER BY godina DESC';
    $prikaz_sezona=$conn->query($upit_sezona);
    
    // a sada cemo da napunimo niz sezona sa sezonama koje se nalaze u tabeli sezona i koloni godina
    while($rows=$prikaz_sezona->fetch_assoc()){
        $sezona[$brojac]=$rows['godina'];
        $brojac++;
    }
    
   
    // ovde punimo nasu listu sezonama
    for($i=0;$i<count($sezona);$i++){
    $select.='<option value='.$sezona[$i].'>'.$sezona[$i].'</option>';
       
}
    
    //zatvaram listu
    $select.='</select>';

    //prikazujem listu
    echo "Pogledaj tabelu u sezoni:  " .$select ."<br><br>";
    
    
    
   //naci id_sezone
   $sezonaid=[];
   $index=0;
    
    
    $upit1='SELECT * FROM sezona';
    $prikaz1=$conn->query($upit1);
    
    while($rows=$prikaz1->fetch_assoc()){
        $sezonaid[$index]=$rows['id_sezone'];
        $index++;
    }
    
    
       
 ?>
 
  
 <!--ovde je kraj koda koji smo kucali za listu koja prikazuje sezone--> 
 

 
 
 <!--ovde cu da napravim formu za kreiranje nove sezone--> 
 <form id="novasezona" onsubmit="return provjera()" method="post">
    <label>Kreiraj novu sezonu:</label>
    <input type="text" id="upisana_sezona" name="upis_sezona" placeholder="npr: 2011/12"><br><br>
     
     <input type="submit" value="Kreiraj sezonu" name="kreiraj" id="dugme_kreiraj">
 </form>
 
 
 <script>
//u slucaju da prizor u koji unosimo novu sezonu bude prazan kada kliknemo na dugme kreiraj neka se ispise upozorenje crvenim slovima, a nakon toga kada kliknem na upozorenje neka se izbrise i slova koja se posle toga budu unosila neka budu ponovo crne boje
 var upisana_sezona1=document.getElementById("upisana_sezona");
 
upisana_sezona1.addEventListener('focus',brisi)
     
function provjera(){
    if(upisana_sezona1.value=="" || upisana_sezona1.value=="Popuni" || upisana_sezona1.value=="npr:2011/12"){
       upisana_sezona1.value="Popuni";
       upisana_sezona1.style.color="red";
       return false;
    }
    return true;
}
     
     
function brisi(){
         upisana_sezona1.value="";
         upisana_sezona1.style.color="black";
}

</script>

<!--nakon sto se izvrsi provjera da li je sve popunjeno trebam da napravim kod koji ce omoguciti upisivanje nove sezone u tabelu--> 
<?php
if(isset($_POST['kreiraj'])){
    require 'connect.php';
    
    $nova_sezona=$_POST['upis_sezona'];
    
    
    $upit_nova_sezona='SELECT * FROM sezona WHERE godina="'.$nova_sezona.'"';
    
    $prikaz_nova_sezona=$conn->query($upit_nova_sezona);
    
    //ako pokusamo da upisemo sezonu koja vec postoji ispisat ce se poruka 'ova sezona je vec kreirana'
    if(mysqli_num_rows($prikaz_nova_sezona)!==0){
    die('ova sezona je vec kreirana') ;
}
    else{
        
        //sada unosimo novu sezonu
        $q="INSERT INTO sezona(`godina`) VALUES ('$nova_sezona')";
        mysqli_query($conn,$q);
        
        
        
        //a nakon toga treba da se unesu i svi klubovi koji su igrali u toj sezeni
        
        //sada prvo treba da nadjemo id nove sezone koju smo kreirali sto cemo uraditi na sledeci nacin
        $idSql='SELECT * FROM `sezona` WHERE godina="'.$nova_sezona.'"';
    
        $idSezone=$conn->query($idSql);
    
            
         while($row=$idSezone->fetch_assoc()){
               $sezona=$row['id_sezone'];
            
         }
        
                      
           
        //nakon sto smo nasli id nove sezone potrebno je izvuci ukupan broj klubova koji se takmici
        
        $klubovi="SELECT * FROM klub";
        $broj=$conn->query($klubovi);
        $brojk=mysqli_num_rows($broj);  
        
        
        //nakon sto smo nasli i id nove sezone i broj klubova u ligi izvrsit cemo i upis svih klubova u novu sezonu
        for($j=1;$j<=$brojk;$j++)
        {
            $dodavanjeKlubova='INSERT INTO `klubovi_u_sezoni`(`id_sezone`, `id_kluba`) VALUES ('.$sezona.','.$j.')';
            $conn->query($dodavanjeKlubova);
        }
        
       
    }
}
    
    
    
    
    

?>


<!--Sada cemo da napravimo funkciju koja ce da sluzi za prikaz odabrane sezone -->

<script>
        
function funk_sezona(value){
    
   var table=document.getElementById('table');
    

    if(value=="")
    {
        table.innerHTML="";
        
     }
        
   
        else
            {
                        
                
                        myFunction(value);
                
                        function myFunction(value) {
                            var xhttp= new XMLHttpRequest();
                            xhttp.onreadystatechange=function () {
                                
                                
                                if(this.readyState== 4 && this.status==200)
                                {
                                    
                                    document.getElementById('table').innerHTML=this.responseText;
                                }

                            }

                            xhttp.open("GET",'ajax.php?sezona='+value,true);
                            
                  xhttp.send();
                  }
            }
    
    
    
}
      
    
</script>

</div>
<!--ovde zatvaramo div okvir_sezona-->  
  
   
<br><br>


<!--sada cemo da ubacimo div 'table' unutar kojeg ce da se prikazuje tabela nakon odabira sezone-->
<div id="table"></div>

<br><br>

<!--Utakmica - ovde cemo da smjestimo sve sto je vezano z kreiranje utakmica-->

<!--prvo cu da napravim div okvir_utakmica unutar gojeg ce biti sve vezano na utakmicu-->

<div id="okvir_utakmica">

<?php
 
 require 'connect.php';  
    
 $sezona=[];
 $brojac=0;
    
    
    //ovde selektujemo tabelu sezona
    $upit_sezona='SELECT * FROM sezona ORDER BY godina DESC';
    $prikaz_sezona=$conn->query($upit_sezona);
    
    // a sada cemo da napunimo niz sezona sa sezonama koje se nalaze u tabeli sezona i koloni godina
    while($rows=$prikaz_sezona->fetch_assoc()){
        $sezona[$brojac]=$rows['godina'];
        $brojac++;
    }
    


//pravim niz ime_klub u koji cu da smjestim imena klubova iz tabele 
$ime_klub=[];
$index=0;


$upit_klub='SELECT ime_kluba FROM klub';
$prikaz_klub=$conn->query($upit_klub);

while($rows=$prikaz_klub->fetch_assoc()){
    $ime_klub[$index]=$rows['ime_kluba'];
    $index++;
        
}

$ime_klub=array_unique($ime_klub);
sort($ime_klub);

   
?>


<!--Sad cu da kreiram formu za unos meceva-->
<form onsubmit="return test()" method="POST" >

<h3>Ovde mozete da kreirate utakmicu</h3>
<label>Odaberi sezonu u kojoj kreiras utakmicu:</label>

<!--pravim listu kreiranih sezona-->
 <select name='sez_za_mec' id="sez_za_mec">
                <option value="">Izaberi sezonu</option>
                <?php for($i=0;$i<count($sezona);$i++) {  ?>
                <option value= "<?php  echo $sezona[$i]; ?> "> <?php  echo $sezona[$i]; ?></option>
                <?php  } ?>                             
</select><br><br>


<label>Odaberite ekipe koje su odigrale mec:</label>

<!--pravim listu ekima ponudjenih za domacina-->
 <select name='domacin' id="domacin">
                <option value="">Domacin</option>
                <?php for($i=0;$i<count($ime_klub);$i++) {  ?>
                <option value= "<?php  echo $ime_klub[$i]; ?> "> <?php  echo $ime_klub[$i]; ?></option>
                <?php  } ?>                            
</select>

<label> vs </label>

<!--pravim listu ekima ponudjenih za goste-->
 <select name='gost' id="gost">
                <option value="">Gost</option>
                <?php for($i=0;$i<count($ime_klub);$i++) {  ?>
                <option value= "<?php  echo $ime_klub[$i]; ?> "> <?php  echo $ime_klub[$i]; ?></option>
                <?php  } ?>                            
</select><br><br>

<label>Unesi konacan rezultat:</label>   
<input type="number" name="rez_d" id="rez_d">
<label> : </label>
<input type="number" name="rez_g" id="rez_g">

<input type="submit" id="dugme_mec"  name="unesimec" value="Kreiraj mec">
<input type="reset" value="Ponisti sve" id="reset_dugme">
    
</form>

<!-- Sada cu da napravim funkciju koja ce da provjeri dali je sve upisano ukoliko zelimo da unesemo mec-->

<script>
  var sez_za_mec2=document.getElementById('sez_za_mec');
  var domacin2=document.getElementById('domacin');
  var gost2=document.getElementById('gost');
  var rez_dom2=document.getElementById('rez_d');
  var rez_gost2=document.getElementById('rez_g');
  var dugme_mec2=document.getElementById('dugme_mec')
  
  function test(){
      if(sez_za_mec2.value==""){
          alert('Izaberite sezonu');
          return false;
      }
      
      if(domacin2.value==""){
          alert('Izaberite ekipu domacin');
          return false;
      }
      
      if(gost2.value==""){
          alert('Izaberite gostujucu ekipu');
          return false;
      }
      
      if(rez_dom2.value==""){
          alert('Unesite broj golova domacina');
          return false;
      }
      
      if(rez_gost2.value==""){
          alert('Unesite broj golova gosta');
          return false;
      }
      
      return true;
  }
</script>

<!-- Ukoliko je sve uneseno i provjera je uspjesno izvrseno treba da napravimo da se taj mec i unese u bazu-->


<?php
  
if(isset($_POST["unesimec"])){

//trebam da izvucem id sezone koju smo odabrali u listi
$sez=$_POST['sez_za_mec'];
$upit_idsezone='SELECT id_sezone FROM sezona WHERE godina="'.$sez.'"';
$prikaz_idsezone=$conn->query($upit_idsezone);
$rows2=$prikaz_idsezone->fetch_assoc();   
// ova je nas id sezone koju smo odabrali    
$utakmica_idsezone=$rows2['id_sezone'];
    
    
//sada treba da nadjemo id domace ekipe
$doma=$_POST['domacin'];
$upit_domacinid='SELECT id_kluba FROM klub WHERE ime_kluba="'.$doma.'"';
$prikaz_domacinid=$conn->query($upit_domacinid);
$rows3=$prikaz_domacinid->fetch_assoc();
// ovo je id domace ekipe
$utakmica_domacinid=$rows3['id_kluba'];
    
//sada treba da nadjemo id gostujuce ekipe
$g=$_POST['gost'];
$upit_gostid='SELECT id_kluba FROM klub WHERE ime_kluba="'.$g.'"';
$prikaz_gostid=$conn->query($upit_gostid);
$rows4=$prikaz_gostid->fetch_assoc();
//ovo je id gostujuce ekipe
$utakmica_gostid=$rows4['id_kluba'];
    
//uneseni broj golova domace ekipe  
$utakmica_rez_d=$_POST['rez_d'];

//uneseni broj golova gostujuce ekipe
$utakmica_rez_g=$_POST['rez_g'];
    
    
//prvo treba provjeriti dali jev vec upisan mec koji mi zelimo da upisemo
$upit_provjera_meca='SELECT * FROM utakmica WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_klub_domacin="'.$utakmica_domacinid.'" AND id_klub_gost="'.$utakmica_gostid.'")';
$prikaz_provjera_meca=$conn->query($upit_provjera_meca);
if(mysqli_num_rows($prikaz_provjera_meca)==1){
    echo "Ovaj mec je vec unesen u bazu";
    die();
}

    if($utakmica_domacinid===$utakmica_gostid){
        echo "Doslo je do greske prilikom unosa ekipa. Morate izabrati razlicite ekipe.";
        die();
    }


$mec_upis='INSERT INTO utakmica(id_sezone, id_klub_domacin, id_klub_gost, gol_domacin, gol_gost) VALUES ('.$utakmica_idsezone.','.$utakmica_domacinid.','.$utakmica_gostid.','.$utakmica_rez_d.','.$utakmica_rez_g.')';
mysqli_query($conn,$mec_upis);

//ako je domacin pobjedio neka mu se upisu 3 boda
if($utakmica_rez_d>$utakmica_rez_g){
    
    $upit_b_d='SELECT bodovi FROM klubovi_u_sezoni WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_domacinid.'")';
    $prikaz_b_d=$conn->query($upit_b_d);
    $rows5=$prikaz_b_d->fetch_assoc();
    $bodovi_domacina=$rows5['bodovi'];
    
    $bodovi_domacina+=3;

    $domacin_bodovi_dodaj='UPDATE klubovi_u_sezoni SET bodovi="'.$bodovi_domacina.'" WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_domacinid.'")';
    mysqli_query($conn,$domacin_bodovi_dodaj);
    
    }
  
//ako je gost pobjedio neka mu se upisu 3 boda
if($utakmica_rez_d<$utakmica_rez_g){
    
   $upit_b_g='SELECT bodovi FROM klubovi_u_sezoni WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_gostid.'")';
   $prikac_b_g=$conn->query($upit_b_g);
   $rows6=$prikac_b_g->fetch_assoc();
   $bodovi_gosta=$rows6['bodovi'];
    
   $bodovi_gosta+=3;
    
   $gost_bodovi_dodaj='UPDATE klubovi_u_sezoni SET bodovi="'.$bodovi_gosta.'" WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_gostid.'")';
    mysqli_query($conn,$gost_bodovi_dodaj);
}

//ako je bilo nerjeseno neka se upise po 1 bod za obe ekipe
    
    //dodaj bod domacinu
    if($utakmica_rez_d==$utakmica_rez_g){
    $upit_b_d='SELECT bodovi FROM klubovi_u_sezoni WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_domacinid.'")';
    $prikaz_b_d=$conn->query($upit_b_d);
    $rows5=$prikaz_b_d->fetch_assoc();
    $bodovi_domacina=$rows5['bodovi'];
    
    $bodovi_domacina+=1;

    $domacin_bodovi_dodaj='UPDATE klubovi_u_sezoni SET bodovi="'.$bodovi_domacina.'" WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_domacinid.'")';
    mysqli_query($conn,$domacin_bodovi_dodaj);
        
    // dodaj bod gostu
    $upit_b_g='SELECT bodovi FROM klubovi_u_sezoni WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_gostid.'")';
    $prikac_b_g=$conn->query($upit_b_g);
    $rows6=$prikac_b_g->fetch_assoc();
    $bodovi_gosta=$rows6['bodovi'];
    
    $bodovi_gosta+=1;
    
    $gost_bodovi_dodaj='UPDATE klubovi_u_sezoni SET bodovi="'.$bodovi_gosta.'" WHERE (id_sezone="'.$utakmica_idsezone.'" AND id_kluba="'.$utakmica_gostid.'")';
    mysqli_query($conn,$gost_bodovi_dodaj);
        
        
    }
    
    
}
    
    

?>

</div>
<!--zatvaram div okvir_utamica-->


</body>
</html>


