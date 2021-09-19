<?php
ini_set('display_errors',0);
session_start();




// Portale CPI

if(!isset($_SESSION['verifica']))
{

	echo ("<form action='login/login/login.html'>
    <button type='submit' class='glow-on-hover'>ACCEDI COME CPI</button>
    </form>");
}
else
{
	echo ("<form action='/maturita/home.php'>
    <button type='submit' class='glow-on-hover'>ACCEDI COME CPI</button>
    </form>");
}


// Portale Azienda

if(!isset($_SESSION['verifica_azienda']))
{
    echo ("<form action='login_azienda/Login_v2/login_azienda.html'>
    <button type='submit' class='glow-on-hover'>ACCEDI COME AZIENDA</button>
    </form>");
}
else
{
    echo ("<form action='/maturita/azienda/index.php'>
    <button type='submit' class='glow-on-hover'>ACCEDI COME AZIENDA</button>
    </form>");
}

// Portale iscritti

if(!isset($_SESSION['verifica_iscritto']))
{
    echo ("<form action='login_iscritti.html'>
    <button type='submit' class='glow-on-hover'>ACCEDI COME ISCRITTO</button>
    </form>");
}
else
{
    echo ("<form action='/maturita/iscritto/index_iscritto.php'>
    <button type='submit' class='glow-on-hover'>ACCEDI COME ISCRITTO</button>
    </form>");
}













?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Benvenuto</title>
</head>
<body>

<style>

html,
body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    background: #000;
}

.glow-on-hover {
    width: 220px;
    height: 50px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}


html, body {
  width: 100%;
  height:100%;
}

body {
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}
</style>

<script type="text/javascript">
    if (sessionStorage !== undefined) 
    {
        if (sessionStorage.getItem("showAlert") == null) 
        if(confirm("Attenzione! Proseguendo su questa pagina dichiari di aver accettato il nostro regolamento sulla privacy."))
        sessionStorage.setItem("showAlert", false);
        else
        window.location.replace("/maturita/regolamento.html");
    }
</script>
    
       



</body>
</html>