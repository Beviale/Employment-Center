<?php


ini_set('display_errors',0);
session_start();

// Connessione al database per il login alla piattaforma

$connessione= mysqli_connect("localhost","root");
if(!$connessione)
 {
    echo ("<H1>Connessione al server MySQL fallita</H1>"); 
	exit;
}
$DB = mysqli_select_db($connessione, "login");

if(!$DB)
{
    echo ("<H1>Connessione al database fallita</H1>");
	exit;
}

// Veririfica credenziali

if(!isset($_SESSION['verifica']))
{
$username= mysqli_real_escape_string($connessione, $_POST['uname']);  //Funzione che filtra i caratteri speciali
$password=md5($_POST['psw']);  //Crittografiamo la password con md5
$query = "SELECT * FROM utenti WHERE password = '$password' AND username='$username' ";
$Result = mysqli_query($connessione, $query);
if(!$Result)
    {
      print("Query fallita. Controllare L'inserimento!");
    }
if (mysqli_num_rows($Result)!=1)
{
	
	echo "<center><h3>Impossibile effettuare l'accesso! Ricontrolla le credenziali!</h3><img src='https://3.bp.blogspot.com/-u3Le4dovYsI/Wca3aAQEC8I/AAAAAAAAGjc/Zm2JWZVvMv8pUIvRNIbdQiYtf-o2f6zyACLcBGAs/s1600/alert-xxl.png'>";
	echo ('<form action="/maturita/login/login/login.html">
          <button type="submit">
          Ritorna alla pagina precedente
          </button>  
          </form>
          </center>');
          exit();	
}
}

$_SESSION['verifica']=1;





// Connessione al database per la gestione della piattaforma


$Connessione= mysqli_connect("localhost","root");
if(!$Connessione)
 {
    echo ("<H1>Connessione al server MySQL fallita</H1>"); 
	exit();
}
$database = mysqli_select_db($Connessione, "impiego");

if(!$database)
{
    echo ("<H1>Connessione al database fallita</H1>");
	exit();
}


// Inserimento nuovo iscritti alla tabella

if(isset($_POST['ID_nuovo_iscritto']))
{
	$ID_nuovo=$_POST['ID_nuovo_iscritto'];
  $Nome_nuovo=$_POST['Nome_nuovo_iscritto'];
  $Cognome_nuovo=$_POST['Cognome_nuovo_iscritto'];
  $Cittadinanza_nuovo=$_POST['Cittadinanza_nuovo_iscritto'];
  $Stato_nuovo=$_POST['Stato_nuovo_iscritto'];
  $Nascita_nuovo=$_POST['Nascita_nuovo_iscritto'];
  $Mail_nuovo=$_POST['Mail_nuovo_iscritto'];
  $Nazione_nuovo_iscritto=$_POST['Nazione_nuovo_iscritto'];
  $Regione_nuovo_iscritto=$_POST['Regione_nuovo_iscritto'];
  $Comune_nuovo_iscritto=$_POST['Comune_nuovo_iscritto'];
  $Sesso_nuovo_iscritto=$_POST['sesso'];




  if(date("Y") - $Nascita_nuovo<16)
  {
    echo '<script language="javascript">';
    echo 'alert("Attenzione! L utente inserito ha meno di 16 anni! Pertanto non può essere iscritto")';
    echo '</script>';

  }
  else if(date("Y") - $Nascita_nuovo>65)
  {
    echo '<script language="javascript">';
    echo 'alert("Attenzione! L utente inserito ha più di 65 anni! Pertanto non può essere iscritto")';
    echo '</script>';

  }
  else
  {
    $query_nuovo_iscritto="INSERT INTO iscritti(ID_iscritto, Nome, Cognome, Cittadinanza, Stato_attuale, Anno_nascita, Mail_iscritti, Nazione_residenza, Regione_residenza, Comune_residenza, Sesso) VALUES ($ID_nuovo, '$Nome_nuovo', '$Cognome_nuovo', '$Cittadinanza_nuovo', '$Stato_nuovo', $Nascita_nuovo, '$Mail_nuovo', '$Nazione_nuovo_iscritto', '$Regione_nuovo_iscritto', '$Comune_nuovo_iscritto', '$Sesso_nuovo_iscritto')";
    $Result_nuovo_iscritti = mysqli_query($Connessione, $query_nuovo_iscritto);
  
    if($Result_nuovo_iscritti)
     {
      echo '<script language="javascript">';
      echo 'alert("Utente inserito correttamente")';
      echo '</script>';
     }

  }
	
  
}




// Elimina iscritto
if(isset($_POST['ID_elimina_iscritto']))
{
  $elimina_iscritto=$_POST['ID_elimina_iscritto'];
  $query_elimina="DELETE FROM iscritti WHERE ID_iscritto=$elimina_iscritto";
  $Result_elimina_iscritti = mysqli_query($Connessione, $query_elimina);
   if($Result_elimina_iscritti)
  {
    echo '<script language="javascript">';
    echo 'alert("Utente eliminato correttamente")';
    echo '</script>';
  }

}




// Inserimento nuova azienda alla tabella

if(isset($_POST['ID_nuovo_azienda']))
{
  $ID_azienda=$_POST['ID_nuovo_azienda'];
  $Nome_azienda=$_POST['Nome_nuovo_azienda'];
  $Iva_azienda=$_POST['IVA_nuovo_azienda'];
  $Nazione_azienda=$_POST['Nazione_nuovo_azienda'];
  $Regione_azienda=$_POST['Regione_nuovo_azienda'];
  $Comune_azienda=$_POST['Comune_nuovo_azienda'];
  $Cap_azienda=$_POST['CAP_nuovo_azienda'];
  $Mail_azienda=$_POST['Mail_nuovo_azienda'];
  $query_nuovo_azienda="INSERT INTO aziende(ID_azienda, Nome_azienda, Partita_iva, Nazione_azienda, Regione_azienda, Comune_Azienda, Cap_azienda, Mail_aziende) VALUES ($ID_azienda, '$Nome_azienda', '$Iva_azienda', '$Nazione_azienda', '$Regione_azienda', '$Comune_azienda', '$Cap_azienda', '$Mail_azienda')";
  $Result_nuovo_azienda = mysqli_query($Connessione, $query_nuovo_azienda);
  
  if($Result_nuovo_azienda)
  {
    echo '<script language="javascript">';
    echo 'alert("Azienda inserita correttamente")';
    echo '</script>';
  }
  
}

// Elimina azienda
if(isset($_POST['ID_elimina_azienda']))
{
  $elimina_azienda=$_POST['ID_elimina_azienda'];
  $query_elimina_azienda="DELETE FROM aziende WHERE ID_azienda=$elimina_azienda";
  $Result_elimina_azienda = mysqli_query($Connessione, $query_elimina_azienda);
   if($Result_elimina_azienda)
  {
    echo '<script language="javascript">';
    echo 'alert("Azienda eliminata correttamente")';
    echo '</script>';
  }

}




// Inserimento nuova mansione alla tabella

if(isset($_POST['ID_nuovo_mansione']))
{
  $ID_mansione=$_POST['ID_nuovo_mansione'];
  $Nome_mansione=$_POST['Nome_nuovo_mansione'];
  $Titolo_mansione=$_POST['Titolo_nuovo_mansione'];
  $Stipendio_mansione=$_POST['Stipendio_nuovo_mansione'];
  $query_nuovo_mansione="INSERT INTO mansioni(ID_mansione, Nome, Titolo_studio, Stipendio_medio) VALUES ($ID_mansione, '$Nome_mansione', '$Titolo_mansione', $Stipendio_mansione)";
  $Result_nuovo_mansione = mysqli_query($Connessione, $query_nuovo_mansione);
  
  if($Result_nuovo_mansione)
  {
    echo '<script language="javascript">';
    echo 'alert("Mansione inserita correttamente")';
    echo '</script>';
  }
  
}


// Elimina mansione
if(isset($_POST['ID_elimina_mansione']))
{
  $elimina_mansione=$_POST['ID_elimina_mansione'];
  $query_elimina_mansione="DELETE FROM mansioni WHERE ID_mansione=$elimina_mansione";
  $Result_elimina_mansione = mysqli_query($Connessione, $query_elimina_mansione);
   if($Result_elimina_mansione)
  {
    echo '<script language="javascript">';
    echo 'alert("Mansione eliminata correttamente")';
    echo '</script>';
  }

}









// Inserimento nuova offerta nella tabella
if(isset($_POST['ID_nuovo_offerta']))
{
  $ID_offerta=$_POST['ID_nuovo_offerta'];
  $Codicea_offerta=$_POST['Codicea_nuovo_offerta'];
  $Contratto_offerta=$_POST['Contratto_nuovo_offerta'];
  $Nazione_offerta=$_POST['Nazione_nuovo_offerta'];
  $Regione_offerta=$_POST['Regione_nuovo_offerta'];
  $Comune_offerta=$_POST['Comune_nuovo_offerta'];
  $Scadenza_offerta=$_POST['Scadenza_nuovo_offerta'];
  $Scadenza_offerta_convertito=date('Y-m-d', strtotime($Scadenza_offerta));;
  $Codicem_offerta=$_POST['Codicem_nuovo_offerta'];
  $Eta_minima_offerta=$_POST['Eta_nuovo_offerta'];
  $Eta_massima_offerta=$_POST['Eta_nuovo_offerta_massima'];
  $Esperienza_offerta=$_POST['Esperienza_nuovo_offerta'];
  
  $query_nuovo_offerta="INSERT INTO offerte(ID_offerta, Codice_azienda, Contratto, Nazione_lavoro, Regione_lavoro, Comune_lavoro, Scadenza, Codice_mansione, eta_minima, eta_massima, esperienza_minima) VALUES ($ID_offerta, $Codicea_offerta, '$Contratto_offerta', '$Nazione_offerta', '$Regione_offerta', '$Comune_offerta', '$Scadenza_offerta_convertito', $Codicem_offerta, $Eta_minima_offerta, $Eta_massima_offerta, $Esperienza_offerta)";
  $Result_nuovo_offerta = mysqli_query($Connessione, $query_nuovo_offerta);
  
  if($Result_nuovo_offerta)
  {
    echo '<script language="javascript">';
    echo 'alert("Offerta inserita correttamente")';
    echo '</script>';
  }
  
}

// Elimina offerta
if(isset($_POST['ID_elimina_offerta']))
{
  $elimina_offerta=$_POST['ID_elimina_offerta'];
  $query_elimina_offerta="DELETE FROM offerte WHERE ID_offerta=$elimina_offerta";
  $Result_elimina_offerta = mysqli_query($Connessione, $query_elimina_offerta);
   if($Result_elimina_offerta)
  {
    echo '<script language="javascript">';
    echo 'alert("Offerta eliminata correttamente")';
    echo '</script>';
  }

}





// Inserimento nuova compatibilità alla tabella

if(isset($_POST['ID_nuovo_compatibili']))
{
  $ID_compatibili=$_POST['ID_nuovo_compatibili'];
  $Codiceo_compatibili=$_POST['Codiceo_nuovo_compatibili'];
  $Codicei_compatibili=$_POST['Codicei_nuovo_compatibili'];
  $query_nuovo_proposta="INSERT INTO proposte(ID_proposta, Codice_offerta, Codice_iscritto) VALUES ($ID_compatibili, $Codiceo_compatibili, $Codicei_compatibili)";
  $Result_nuovo_proposta = mysqli_query($Connessione, $query_nuovo_proposta);
  
  if($Result_nuovo_proposta)
  {
    echo '<script language="javascript">';
    echo 'alert("Compatibilità inserita correttamente")';
    echo '</script>';
  }
  
}

// Elimina compatibilità
if(isset($_POST['ID_elimina_compatibili']))
{
  $elimina_proposta=$_POST['ID_elimina_compatibili'];
  $query_elimina_proposta="DELETE FROM proposte WHERE ID_proposta=$elimina_proposta";
  $Result_elimina_proposta = mysqli_query($Connessione, $query_elimina_proposta);
   if($Result_elimina_proposta)
  {
    echo '<script language="javascript">';
    echo 'alert("Proposta eliminata correttamente")';
    echo '</script>';
  }

}



mysqli_close($connessione);
mysqli_close($Connessione);





?>
<!DOCTYPE html>
<html>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src="https://retegiovani.it/wp-content/uploads/2017/05/Centro-per-limpiego.jpg" alt="Avatar" class="avatar" style="width:100%">
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-black">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="#iscritti" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>ISCRITTI</p>
  </a>
  <a href="#aziende" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>AZIENDE</p>
  </a>
  <a href="#offerte" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>OFFERTE</p>
  </a>
  <a href="#compatibili" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>COMPATIBILI</p>
  </a>
  <a href="#mansioni" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>MANSIONI</p>
  </a>
  <a href="#trova" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>TROVA LAVORO</p>
  </a>
  <a href="#match" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>MATCH AUTOMATICO</p>
  </a>
</nav>



<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small"></span> Portale CPI</h1>
    <p>Benvenuto</p>

    
  </header>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">Ultimo aggiornamento versione 2.3.4</h2>
    <hr style="width:200px" class="w3-opacity">
    <br>- Aggiunta la possibilità del match automatico
    </br>
    <br>- Bug fix
    </br>
    <p class="w3-medium">Sviluppato da Alessandro Bevilacqua</p>
  <!-- End footer -->
  </footer>

<!-- END PAGE CONTENT -->
</div>

<br>
<br>
<br>
<br>
<br>
<hr width=100% size=4 color=000000>
<div id='iscritti'><center><h3>ISCRITTI</h3></center>
<br>
<form target="_blank" action="/maturita/iscritti.php">
<input type="submit" value="Visualizza tabella iscritti" />
</form>
<br>
<form target="_blank" action="/maturita/iscritti_stranieri.php">
<input type="submit" value="Visualizza tabella iscritti stranieri"/>
</form>
<br>
<form target="_blank" action="/maturita/effettua.php">
<input type="submit" value="Visualizza le mansioni per ogni iscritto" />
</form>
<br>
<h5>Inserisci nuovo iscritto</h5>
<table border='10'>
<form method='post' action='#iscritti'>
<tr>
    <td>ID</td>
    <td>Nome</td>
    <td>Cognome</td>
    <td>Cittadinanza</td>
    </td>
</tr>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_nuovo_iscritto" required></td>
  <td><input type="text" placeholder="Inserisci Nome" name="Nome_nuovo_iscritto" required></td>
  <td><input type="text" placeholder="Inserisci Cognome" name="Cognome_nuovo_iscritto" required></td>
  <td><input type="text" placeholder="Inserisci Cittadinanza" name="Cittadinanza_nuovo_iscritto" required></td>

</tr>
</table>
<table border='10'>
  <tr>
    <td>Stato di occupazione</td>
    <td>Anno di nascita</td>
    <td>Indirizzo mail</td>
  </tr>
  <tr>
    <td><input type="text" placeholder="Inserisci Stato" name="Stato_nuovo_iscritto" required></td>
    <td><input type="number" placeholder="Inserisci Anno" name="Nascita_nuovo_iscritto" required></td>
    <td><input type="email" placeholder="Inserisci indirizzo" name="Mail_nuovo_iscritto" required></td>
 </tr>
</table>
<table border='10'>
  <tr>
    <td>Nazione</td>
    <td>Regione</td>
    <td>Comune</td>
    <td>Sesso</td>
  </tr>
  <tr>
    <td><input type="text" placeholder="Inserisci nazione" name="Nazione_nuovo_iscritto" required></td>
    <td><input type="text" placeholder="Inserisci regione" name="Regione_nuovo_iscritto" required></td>
    <td><input type="text" placeholder="Inserisci comune" name="Comune_nuovo_iscritto" required></td>
    <td>
    <select name="sesso">
        <option value="M">M</option>
        <option value="F">F</option>
      </select>
    </td>

 </tr>
</table>


<td></td>
    <td align='right'><input type='submit' name='submit' value='Invia'></td>
</form>
<br>
<br>
<h5>Elimina iscritto</h5>
<form method='post' action='#iscritti'>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_elimina_iscritto" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Elimina'></td>
</form>
<br>
<br>
<br>
<br>
<br>

<hr width=100% size=4 color=000000>










<div id='aziende'><center><h3>AZIENDE</h3></center>
<br>
<form target="_blank" action="/maturita/aziende.php">
<input type="submit" value="Visualizza tabella aziende" />
</form>
<br>
<h5>Inserisci nuova azienda</h5>
<table border='10' >
<form method='post' action='#aziende'>
<tr>
    <td>ID</td>
    <td>Nome</td>
    <td>Partita IVA</td>
    <td>Nazione sede</td>
    <td>Regione sede</td>
    
    </td>
</tr>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_nuovo_azienda" required></td>
  <td><input type="text" placeholder="Inserisci Nome" name="Nome_nuovo_azienda" required></td>
  <td><input type="text" placeholder="Inserisci P.IVA" name="IVA_nuovo_azienda" required></td>
  <td><input type="text" placeholder="Inserisci Nazione" name="Nazione_nuovo_azienda" required></td>
  <td><input type="text" placeholder="Inserisci Regione" name="Regione_nuovo_azienda" required></td>
  
</tr>
</table>
<table border='10'>
<tr>
  <td>Comune sede</td>
  <td>CAP sede</td>
  <td>Indirizzo mail</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Comune" name="Comune_nuovo_azienda" required></td>
  <td><input type="text" placeholder="Inserisci CAP" name="CAP_nuovo_azienda" required></td>
  <td><input type="email" placeholder="Inserisci mail" name="Mail_nuovo_azienda" required></td>
</tr>
</table>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Invia'></td>
</form>
<br>
<br>
<h5>Elimina azienda</h5>
<form method='post' action='#aziende'>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_elimina_azienda" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Elimina'></td>
</form>
<br>
<br>
<br>
<br>
<br>

<hr width=100% size=4 color=000000>








<div id='offerte'><center><h3>OFFERTE</h3></center>
<br>
<form target="_blank" action="/maturita/offerte.php">
<input type="submit" value="Visualizza tabella offerte">
</form>
<br>
<h5>Inserisci nuova offerta</h5>
<table border='10'>
<form method='post' action='#offerte'>
<tr>
    <td>ID</td>
    <td>Codice azienda</td>
    <td>Contratto</td>
    <td>Nazione lavoro</td>
    <td>Regione lavoro</td>
    <td>Comune lavoro</td>

</tr>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_nuovo_offerta" required></td>
  <td><input type="number" placeholder="Inserisci Codice" name="Codicea_nuovo_offerta" required></td>
  <td><select name="Contratto_nuovo_offerta">
        <option value="Tirocinio">Tirocinio</option>
        <option value="Tempo determinato">Tempo determinato</option>
        <option value="Tempo indeterminato">Tempo indeterminato</option>
        <option value="A chiamata">A chiamata</option>
        <option value="A progetto">A progetto</option>
        <option value="Apprendistato">Apprendistato</option>
      </select>
    </td>
  <td><input type="text" placeholder="Inserisci Nazione" name="Nazione_nuovo_offerta" required></td>
  <td><input type="text" placeholder="Inserisci Regione" name="Regione_nuovo_offerta" required></td>
  <td><input type="text" placeholder="Inserisci Comune" name="Comune_nuovo_offerta" required></td>
</tr>
</table>
<table border='10'>
<tr>
    <td>Scadenza</td>
    <td>Codice mansione</td>
    <td>Eta' minima</td>
    <td>Eta' massima</td>
    <td>Anni esperienza</td>
</tr>
<tr>
  <td><input type="date" placeholder="Inserisci Scadenza" name="Scadenza_nuovo_offerta" required></td>
  <td><input type="number" placeholder="Inserisci Codice" name="Codicem_nuovo_offerta" required></td>
  <td><input type="number" placeholder="Inserisci eta" name="Eta_nuovo_offerta" required></td>
  <td><input type="number" placeholder="Inserisci eta" name="Eta_nuovo_offerta_massima" required></td>
  <td><input type="number" placeholder="Inserisci esperienza" name="Esperienza_nuovo_offerta" required></td>
</tr>
</table>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Invia'></td>
</form>
<br>
<br>
<h5>Elimina offerta</h5>
<form method='post' action='#offerte'>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_elimina_offerta" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Elimina'></td>
</form>
<br>
<br>
<br>
<br>
<br>

<hr width=100% size=4 color=000000>









<div id='compatibili'><center><h3>PROPOSTE DI LAVORO COMPATIBILI</h3></center>
<br>
<form target="_blank" action="/maturita/proposte.php">
<input type="submit" value="Visualizza tabella compatibili" />
</form>
<br>
<form target="_blank" action="/maturita/proposte_stranieri.php">
<input type="submit" value="Visualizza tabella compatibili stranieri" />
</form>
<br>
<h5>Inserisci una nuova Compatibilità</h5>
<table border='10' >
<style type="text/css">
  table {
  width: 70%;
}
</style>
<form method='post' action='#compatibili'>
<tr>
    
    <td>ID</td>
    <td>Codice offerta</td>
    <td>Codice iscritto</td>
</tr>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_nuovo_compatibili" required></td>
  <td><input type="number" placeholder="Inserisci Codice Offerta" name="Codiceo_nuovo_compatibili" required></td>
  <td><input type="number" placeholder="Inserisci Codice Iscritto" name="Codicei_nuovo_compatibili" required></td>
</tr>
</table>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Invia'></td>
</form>
<br>
<br>
<h5>Elimina compatibilità</h5>
<form method='post' action='#compatibili'>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_elimina_compatibili" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Elimina'></td>
</form>
<br>
<br>
<br>
<br>
<br>

<hr width=100% size=4 color=000000>










<div id='mansioni'><center><h3>MANSIONI</h3></center>
<br>
<form target="_blank" action="/maturita/mansioni.php">
<input type="submit" value="Visualizza tabella mansioni">
</form>
<br>
<h5>Inserisci nuova mansioni</h5>
<table border='10'>
<form method='post' action='#mansioni'>
<tr>
    <td>ID</td>
    <td>Nome</td>
    <td>Titolo di studio</td>
    <td>Stipendio medio</td>

</tr>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_nuovo_mansione" required></td>
  <td><input type="text" placeholder="Inserisci Nome" name="Nome_nuovo_mansione" required></td>
  <td><input type="text" placeholder="Inserisci Titolo" name="Titolo_nuovo_mansione" required></td>
  <td><input type="number" placeholder="Inserisci Stipendio" name="Stipendio_nuovo_mansione" required></td>
</tr>
</table>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Invia'></td>
</form>
<br>
<br>
<h5>Elimina mansione</h5>
<form method='post' action='#mansioni'>
<tr>
  <td><input type="number" placeholder="Inserisci ID" name="ID_elimina_mansione" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Elimina'></td>
</form>
<br>
<br>
<br>
<br>
<br>

<hr width=100% size=4 color=000000>


















<div id='trova'><center><h3>TROVA OFFERTE DI LAVORO</h3></center>
<br>
<br>
<h5>Filtra le offerte di lavoro disponibili</h5>
<br>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Codice azienda</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Codice Azienda" name="trova_codice_azienda" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Contratto</td>
</tr>
<tr>
   <td><select name="trova_contratto">
        <option value="Tirocinio">Tirocinio</option>
        <option value="Tempo determinato">Tempo determinato</option>
        <option value="Tempo indeterminato">Tempo indeterminato</option>
        <option value="A chiamata">A chiamata</option>
        <option value="A progetto">A progetto</option>
        <option value="Apprendistato">Apprendistato</option>
      </select>
    </td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Nazione lavoro</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Nazione Lavoro" name="trova_nazione_lavoro" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Regione lavoro</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Regione Lavoro" name="trova_regione_lavoro" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Comune lavoro</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Comune Lavoro" name="trova_comune_lavoro" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Codice mansione</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Codice Mansione" name="trova_codice_mansione" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Anni di esperienza richiesti</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Anni" name="trova_anni_esperienza" required></td>
</tr>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<table border='10'>
<form method='post' target="_blank" action='/maturita/trova_offerte.php'
<tr>
    <td>Range eta' minima</td>
    <td>Range eta' massima</td>
</tr>
<tr>
  <td><input type="text" placeholder="Inserisci Eta" name="trova_minima" required></td>
  <td><input type="text" placeholder="Inserisci Eta" name="trova_massima" required></td>
</tr>
</table>
<td></td>
    <td align='right'><input type='submit' name='submit' value='Filtra'></td>
</form>
<br>
<br>
<br>
<br>
<br>

<hr width=100% size=4 color=000000>



<div id='match'><center><h3>MATCH AUTOMATICO</h3></center>
<br>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</svg>
<p>Il Match Automatico ti permette di visualizzare per ogni iscritto le possibili combinazioni con le offerte di lavoro. Tali combinazioni vengono generate sulla base di alcuni criteri quali le mansioni, l'età minima, l'età massima e gli anni di esperienza richiesti.</p>
<form target="_blank" action="/maturita/automatico.php">
<input type="submit" value="Visualizza tabella" />
</form>
<br>




</body>
</html>
