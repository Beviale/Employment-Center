<?php
ini_set('display_errors',0);
session_start();

if(!isset($_SESSION['verifica']))
{
	echo "<h1>Non sei autorizzato ad accedere a questa pagina</h1>";
	exit();
}

$Connessione= mysqli_connect("localhost","root");
if(!$Connessione)
 {
    echo ("<H1>Connessione al server MySQL fallita</H1>"); 
	exit;
}
$DB = mysqli_select_db($Connessione, "impiego");

if(!$DB)
{
    echo ("<H1>Connessione al database fallita</H1>");
	exit;
}


echo ("<!DOCTYPE html>
<html>
<head>
<title>Mansioni per iscritto</title>
<h1>Mansioni per iscritto</h1>
<body>");

echo "<br><h3>Seleziona iscritto</h3>
<form method='POST' action='#'>
<td><input type='number' placeholder='Inserisci ID iscritto' name='ID_ricerca' required></td>
<input type='submit' name='submit' value='Invia'>
</form>";
echo "<br><h3>Aggiungi mansione</h3>
<form method='POST' action='#'>
<td><input type='number' placeholder='Inserisci ID iscritto' name='aggiungi_iscritti' required></td>
<td><input type='number' placeholder='Inserisci ID mansione' name='aggiungi_mansione' required></td>
<td><input type='number' placeholder='Inserisci anni esperienza' name='esperienza_anni' required></td>
<td><input type='number' placeholder='Inserisci mesi esperienza' name='esperienza_mesi' required></td>
<input type='submit' name='submit' value='Invia'>
</form>";

echo "<br><h3>Elimina riga</h3>
<form method='POST' action='#'>
<td><td><input type='number' placeholder='Inserisci ID riga' name='elimina_mansione' required></td>
<input type='submit' name='submit' value='Invia'>
</form>
<br>
<br>";







if(isset($_POST['aggiungi_iscritti']))
     {
     	$esperienza_anni=$_POST['esperienza_anni'];
      $esperienza_mesi=$_POST['esperienza_mesi'];
     	$aggiungi_iscritti=$_POST['aggiungi_iscritti'];
     	$aggiungi_mansione=$_POST['aggiungi_mansione'];

     	$query_aggiungi="INSERT INTO effettua(Codice_iscritti, Codice_mansione, anni_esperienza, mesi_esperienza) VALUES ($aggiungi_iscritti, $aggiungi_mansione, $esperienza_anni, $esperienza_mesi)  ";
    $Result_aggiungi= mysqli_query($Connessione, $query_aggiungi);
    if(!$Result_aggiungi)
     {
       print("Query fallita. Controllare L'inserimento!");
       exit();
     }
    echo '<script language="javascript">';
    echo 'alert("Hai inserito una nuova riga!")';
    echo '</script>';
 }





if(isset($_POST['elimina_mansione']))
{
    $elimina=$_POST['elimina_mansione'];
    $query_elimina="DELETE FROM effettua WHERE ID_effettua=$elimina";
    $Result_elimina= mysqli_query($Connessione, $query_elimina);
    if(!$Result_elimina)
     {
       print("Query fallita. Controllare L'inserimento!");
       exit();
     }
    echo '<script language="javascript">';
    echo 'alert("Hai eliminato la riga con successo!")';
    echo '</script>';

}






if(isset($_POST['ID_ricerca']))
{
	$ID_ricerca=$_POST['ID_ricerca'];
    $query_stampa="SELECT * FROM effettua WHERE Codice_iscritti=$ID_ricerca";
    $Result_stampa= mysqli_query($Connessione, $query_stampa);
    if(!$Result_stampa)
     {
       print("Query fallita. Controllare L'inserimento!");
       exit();
     }
    echo "<table>";
	echo "<tr>";
        echo "<th><b> ID riga </b></th>";
        echo "<th><b> ID Iscritto </b></th>";
        echo "<th><b> ID mansionme </b></th>";
        echo "<th><b> Anni di esperienza </b></th>";
        echo "<th><b> Mesi di esperienza </b></th>";


        
    echo "</tr>";
     while ($row_stampa = mysqli_fetch_assoc($Result_stampa)) 
    { 
    echo "<tr>";
       echo "<td>" . $row_stampa['ID_effettua'] . "</td>";
       echo "<td>" . $row_stampa['Codice_iscritti'] . "</td>";
       echo "<td>" . $row_stampa['Codice_mansione'] . "</td>";
       echo "<td>" . $row_stampa['anni_esperienza'] . "</td>";
       echo "<td>" . $row_stampa['mesi_esperienza'] . "</td>";


       
      echo "</tr>";
     }
     echo "</table>";
  

}

echo ('<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: green;
  color: white;
}
</style>');





echo "</body> </html>";
mysqli_close($Connessione);



?>