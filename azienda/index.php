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

if(!isset($_SESSION['verifica_azienda']))
{
$username= mysqli_real_escape_string($connessione, $_POST['uname_azienda']);  //Funzione che filtra i caratteri speciali
$password=md5($_POST['psw_azienda']);  //Crittografiamo la password con md5
$query = "SELECT * FROM aziende WHERE password = '$password' AND username='$username' ";
$Result = mysqli_query($connessione, $query);
if(!$Result)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
$row_azienda = mysqli_fetch_assoc($Result);
$_SESSION['Codice_azienda']=$row_azienda['Codice_azienda'];

if (mysqli_num_rows($Result)!=1)
{
	
	echo "<center><h3>Impossibile effettuare l'accesso! Ricontrolla le credenziali!</h3><img src='https://3.bp.blogspot.com/-u3Le4dovYsI/Wca3aAQEC8I/AAAAAAAAGjc/Zm2JWZVvMv8pUIvRNIbdQiYtf-o2f6zyACLcBGAs/s1600/alert-xxl.png'>";
	echo ('<form action="/maturita/login_azienda/Login_v2/login_azienda.html">
          <button type="submit">
          Ritorna alla pagina precedente
          </button>  
          </form>
          </center>');
          exit();	
}
}



$_SESSION['verifica_azienda']=1;
$ID_azienda=$_SESSION['Codice_azienda'];
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





$query = "SELECT * FROM aziende WHERE ID_azienda=$ID_azienda";
$Result = mysqli_query($Connessione, $query);
if(!$Result)
    {
      print("Query fallita. Controllare L'inserimento!");
      exit();
    }
$row_azienda=mysqli_fetch_assoc($Result);
$Nome_azienda=$row_azienda['Nome_azienda'];
$Partita_iva=$row_azienda['Partita_iva'];
$Nazione=$row_azienda['Nazione_azienda'];
$Regione=$row_azienda['Regione_azienda'];
$Comune=$row_azienda['Comune_azienda'];
$Via=$row_azienda['Sede_azienda'];
$CAP=$row_azienda['Cap_azienda'];
$Mail=$row_azienda['Mail_aziende'];







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
							<li><a href="#three">Offerte</a></li>
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
							<h1>Benvenuta azienda <?php echo $Nome_azienda ?> </h1>
							<p>Attraverso questo portale puoi consultare i tuoi dati salvati nel database CPI e tenere sottocchio le proposte compatibili che i nostri addetti ti offrono.</p>
							<form id='logout' action='#' method='post' >
                            <input type="submit" class="button" name="esegui_logout" value="Esegui logout">
                            </form>
                            <?php
                            if(isset($_POST['esegui_logout']))
                            {
                            	$_SESSION['verifica_azienda']=Null;
                            	header("location: http://127.0.0.1/maturita/benvenuto.php");


                            }



                            ?>
						</div>
					</section>









				<!-- One -->
					<section id="one" >
						<h2>I tuoi dati</h2>
						<b>Nome azienda</b> <p> <?php echo $Nome_azienda ?></p>
						<b>Partita IVA</b> <p> <?php echo $Partita_iva ?></p>
						<b>Nazione</b> <p> <?php echo $Nazione ?></p>
						<b>Regione</b> <p> <?php echo $Regione ?></p>
						<b>Comune</b> <p> <?php echo $Comune ?></p>
						<b>Via</b> <p> <?php echo $Via ?></p>
						<b>CAP</b> <p> <?php echo $CAP ?></p>
						<b>Indirizzo mail</b> <p> <?php echo $Mail ?></p>
					</section>







				<!-- two -->
				<?php
				$query_proposte = "SELECT * FROM proposte INNER JOIN offerte ON proposte.Codice_offerta=offerte.ID_offerta WHERE offerte.Codice_azienda=$ID_azienda";
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
					        echo "<td><b> Codice iscritto</b></td>";
					    echo "</tr>";
					     while ($row_proposte = mysqli_fetch_assoc($Result_proposte)) 
					    { 
					    echo "<tr>";
					       echo "<td>" . $row_proposte['ID_proposta'] . "</td>";
					       echo "<td>" . $row_proposte['Codice_offerta'] . "</td>";
					       echo "<td>" . $row_proposte['Codice_iscritto'] . "<a target='_blank' href='/maturita/azienda/dettagli.php?dettagli=". $row_proposte['Codice_iscritto']." '> Visualizza dettagli </a> </td>";

					      echo "</tr>";
					     }
					     echo "</table>";


							?>
						</div>
					</sectiion>





					<!-- Three -->
					<?php
					$query_offerte = "SELECT * FROM offerte WHERE Codice_azienda=$ID_azienda";
	                $Result_offerte = mysqli_query($Connessione, $query_offerte);
	                if(!$Result_proposte)
	                {
	                	print("Query fallita. Controllare L'inserimento!");
	                    exit();
	                }
	                $numero_offerte=mysqli_num_rows($Result_offerte);
	                  
					?>
						<section id="three" class="wrapper style1 fullscreen fade-up">
							<div class="inner">
								<h1>Le tue offerte</h1>
								<p>Attualmente risultano <b><?php echo $numero_offerte?></b> offerte pubblicate. </p>
								<?php
								echo "<table border='20' width='1000'";
								echo "<tr>";
									echo "<td><b> ID offerta </b></td>";
							        echo "<td><b> Codice azienda </b></td>";
							        echo "<td><b> Contratto </b></td>";
							        echo "<td><b> Nazione lavoro </b></td>";
							        echo "<td><b> Regione lavoro</b></td>";
							        echo "<td><b> Comune lavoro</b></td>";
							        echo "<td><b> Scadenza</b></td>";
							        echo "<td><b> Codice mansione</b></td>";
							        echo "<td><b> Età minima</b></td>";
							        echo "<td><b> Età massima</b></td>";
							        echo "<td><b> Anni esperienza</b></td>";
						    echo "</tr>";
						     while ($row_offerte = mysqli_fetch_assoc($Result_offerte)) 
						    { 
						    echo "<tr>";
							   echo "<td>" . $row_offerte['ID_offerta'] . "</td>";
						       echo "<td>" . $row_offerte['Codice_azienda'] . "</td>";
						       echo "<td>" . $row_offerte['Contratto'] . "</td>";
						       echo "<td>" . $row_offerte['Nazione_lavoro'] . "</td>";
						       echo "<td>" . $row_offerte['Regione_lavoro'] . "</td>";
						       echo "<td>" . $row_offerte['Comune_lavoro'] . "</td>";
						       echo "<td>" . $row_offerte['Scadenza'] . "</td>";
						       echo "<td>" . $row_offerte['Codice_mansione'] . "</td>";
						       echo "<td>" . $row_offerte['eta_minima'] . "</td>";
						       echo "<td>" . $row_offerte['eta_massima'] . "</td>";
						       echo "<td>" . $row_offerte['esperienza_minima'] . "</td>";
						       
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