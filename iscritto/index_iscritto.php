<?php


ini_set('display_errors', 0);
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

if(!isset($_SESSION['verifica_iscritto']))
{
$username= mysqli_real_escape_string($connessione, $_POST['uname_iscritto']);  //Funzione che filtra i caratteri speciali
$password=md5($_POST['psw_iscritto']);  //Crittografiamo la password con md5
$query = "SELECT * FROM iscritti WHERE password = '$password' AND username='$username' ";
$Result = mysqli_query($connessione, $query);
if(!$Result)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
$row_iscritto = mysqli_fetch_assoc($Result);
$_SESSION['Codice_iscritto']=$row_iscritto['Codice_iscritto'];

if (mysqli_num_rows($Result)!=1)
{
	
	echo "<center><h3>Impossibile effettuare l'accesso! Ricontrolla le credenziali!</h3><img src='https://3.bp.blogspot.com/-u3Le4dovYsI/Wca3aAQEC8I/AAAAAAAAGjc/Zm2JWZVvMv8pUIvRNIbdQiYtf-o2f6zyACLcBGAs/s1600/alert-xxl.png'>";
	echo ('<form action="/maturita/login_iscritti.html">
          <button type="submit">
          Ritorna alla pagina precedente
          </button>  
          </form>
          </center>');
          exit();	
}
}



$_SESSION['verifica_iscritto']=1;
$ID_iscritto=$_SESSION['Codice_iscritto'];
mysqli_close($connessione);







// Connessione databse impiego
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





$query = "SELECT * FROM iscritti WHERE ID_iscritto=$ID_iscritto";
$Result = mysqli_query($Connessione, $query);
if(!$Result)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
$row_iscritto=mysqli_fetch_assoc($Result);
$Nome_iscritto=$row_iscritto['Nome'];
$Cognome_iscritto=$row_iscritto['Cognome'];
$Cittadinanza_iscritto=$row_iscritto['Cittadinanza'];
$Stato_attuale=$row_iscritto['Stato_attuale'];
$Anno_nascita=$row_iscritto['Anno_nascita'];
$Nazione_iscritto=$row_iscritto['Nazione_residenza'];
$Regione_iscritto=$row_iscritto['Regione_residenza'];
$Comune_iscritto=$row_iscritto['Comune_residenza'];
$Sesso_iscritto=$row_iscritto['Sesso'];
$Mail_iscritto=$row_iscritto['Mail_iscritti'];


?>




<!DOCTYPE HTML>

<html>
	<head>
		<title>Home Page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
					<nav>
						<ul>
							<li><a href="#intro">Benvenuto</a></li>
							<li><a href="#one">I tuoi dati</a></li>
							<li><a href="#two">Proposte compatibili</a></li>
							<li><a href="#three">Mansioni</a></li>
							<li><a href="#four">Contattaci</a></li>

						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

			


                  <!-- intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>Benvenuto/a <?php echo $Nome_iscritto ?> </h1>
							<p>Attraverso questo portale puoi consultare i tuoi dati salvati nel database CPI e tenere sottocchio le proposte compatibili che i nostri addetti ti offrono.</p>
							<form id='logout' action='#' method='post' >
                            <input type="submit" class="button" name="esegui_logout" value="Esegui logout">
                            </form>
                            <?php
                            if(isset($_POST['esegui_logout']))
                            {
                            	$_SESSION['verifica_iscritto']=Null;
                            	header("location: http://127.0.0.1/maturita/benvenuto.php");


                            }



                            ?>
						</div>
					</section>









				<!-- One -->
					<section id="one" >
						<h2>I tuoi dati</h2>
						<b>Nome</b> <p> <?php echo $Nome_iscritto ?></p>
						<b>Cognome</b> <p> <?php echo $Cognome_iscritto ?></p>
						<b>Cittadinanza</b> <p> <?php echo $Cittadinanza_iscritto ?></p>
						<b>Stato attuale</b> <p> <?php echo $Stato_attuale ?></p>
						<b>Anno di nascita</b> <p> <?php echo $Anno_nascita ?></p>
						<b>Nazione residenza</b> <p> <?php echo $Nazione_iscritto ?></p>
						<b>Regione residenza</b> <p> <?php echo $Regione_iscritto ?></p>
						<b>Comune residenza</b> <p> <?php echo $Comune_iscritto ?></p>
						<b>Sesso</b> <p> <?php echo $Sesso_iscritto?></p>

						<b>Indirizzo mail</b> <p> <?php echo $Mail_iscritto ?></p>
	
					</section>







				<!-- two -->
				<?php
				$query_proposte = "SELECT * FROM proposte WHERE Codice_iscritto=$ID_iscritto";
                $Result_proposte = mysqli_query($Connessione, $query_proposte);
                if(!$Result_proposte)
                {
                	print("Query fallita. Controllare L'inserimento!");
                    exit();
                }
                $numero_proposte=mysqli_num_rows($Result_proposte);
                  
				?>
					<section id="two" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>Proposte compatibili</h1>
							<p>Attualmente risultano <b><?php echo $numero_proposte?></b> proposte compatibili. </p>
							<?php
							echo "<table border='20' width='1000'";
							echo "<tr>";
        					echo "<td><b> ID proposta </b></td>";
					        echo "<td><b> Codice offerta </b></td>";
					        echo "<td><b> Codice iscritto </b></td>";
					    echo "</tr>";
					     while ($row_proposte = mysqli_fetch_assoc($Result_proposte)) 
					    { 
					    echo "<tr>";
					       echo "<td>" . $row_proposte['ID_proposta'] . "</td>";
					       echo "<td>" . $row_proposte['Codice_offerta'] . "<a target='_blank' href='/maturita/iscritto/dettagli.php?dettagli=". $row_proposte['Codice_offerta']." '> Visualizza dettagli </a> </td>";
					       echo "<td>" . $row_proposte['Codice_iscritto'] . "</td>";

					      echo "</tr>";
					     }
					     echo "</table>";


							?>
						</div>
					</sectiion>






					<!--Three-->
					<?php
					$query_mansioni = "SELECT * FROM mansioni INNER JOIN effettua ON mansioni.ID_mansione=effettua.Codice_mansione WHERE effettua.Codice_iscritti=$ID_iscritto ";
	                $Result_mansioni = mysqli_query($Connessione, $query_mansioni);
	                if(!$Result_mansioni)
	                {
	                	print("Query fallita. Controllare L'inserimento!");
	                    exit();
	                }
	                $numero_mansioni=mysqli_num_rows($Result_mansioni);
	                  
					?>

					<section id="three" class="wrapper style1 fade-up">
						<div class="inner">
							<h1>Le tue mansioni</h1>
							<p>Attualmente risultano <b><?php echo $numero_mansioni?></b> mansioni. </p>
							<?php
							echo "<table border='20' width='1000'";
							echo "<tr>";
        					echo "<td><b> ID mansione </b></td>";
					        echo "<td><b> Nome </b></td>";
					        echo "<td><b> Titolo di studio </b></td>";
					        echo "<td><b> Stipendio medio </b></td>";
					        echo "<td><b> Anni esperienza </b></td>";
					        echo "<td><b> Mesi esperienza </b></td>";


					    echo "</tr>";
					     while ($row_mansioni = mysqli_fetch_assoc($Result_mansioni)) 
					    { 
					    echo "<tr>";
					       echo "<td>" . $row_mansioni['ID_mansione'] . "</td>";
					       echo "<td>" . $row_mansioni['Nome'] . "</td>";
					       echo "<td>" . $row_mansioni['Titolo_studio'] . "</td>";
					       echo "<td>" . $row_mansioni['Stipendio_medio'] . "</td>";
					       echo "<td>" . $row_mansioni['anni_esperienza'] . "</td>";
					       echo "<td>" . $row_mansioni['mesi_esperienza'] . "</td>";



					      echo "</tr>";
					     }
					     echo "</table>";


							?>


						</div>


					</section>





				








				<!-- Four -->
					<section id="four" class="wrapper style1 fade-up">
						<div class="inner">
							<h2>Contattaci</h2>
							<p>Desideri avere maggiori informazioni? Vuoi conoscere meglio gli iscritti CPI che ti sono stati proposti? Contattaci!</p>
							<div class="split style1">
								<section>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="name">Nome</label>
												<input type="text" name="name" id="name" />
											</div>
											<div class="field half">
												<label for="email">Email</label>
												<input type="text" name="email" id="email" />
											</div>
											<div class="field">
												<label for="message">Messaggio</label>
												<textarea name="message" id="message" rows="5"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><a href="" class="button submit">Invia messaggio</a></li>
										</ul>
									</form>
								</section>
								<section>
									<ul class="contact">
										<li>
											<h3>Indirizzo</h3>
											<span>Via Puglia, 30<br />
											Policoro, MT<br />
											Italia</span>
										</li>
										<li>
											<h3>Email</h3>
											<a href="#">centoimpiego@outlook.it</a>
										</li>
										<li>
											<h3>Telefono</h3>
											<span>(+39) 340-819-6309</span>
										</li>
										<li>
											<h3>Social</h3>
											<ul class="icons">
												<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
												<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
												<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
												<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
												<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
											</ul>
										</li>
									</ul>
								</section>
							</div>
						</div>
					</section>

			</div>

		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; Tutti i diritti sono riservati</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php
mysqli_close($Connessione);


?>