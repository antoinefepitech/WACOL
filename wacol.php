<?php
/***********************************
WACOL (WebAcappella Converter OnLine)
/*************************************
v2.5.1
©Antoine Falais
CyberSoftCreation

Ce logiciel est en libre téléchargement
http://cybersoftcreation.fr
https://github.com/antoinefepitech/WACOL

La contribution est libre, sur requêtes par mail ou GitHub
antoine.falais@epitech.eu
*/
session_start();
global $SS;
global $numberUpdate;
$SS = "";
$SST = "<?php session_start();?>";
$HD = "";
$CHSS = "checked";
$T = "30";
$A= "";
$HDTtxt = "";
$numberUpdate =0;
$W = "";
$A = -1;
if (isset($_POST['wOpen']))
{
$W= "checked";
$A = 0;
}
if (!isset($_SESSION['numberUpdate']))
{
 $_SESSION['numberUpdate']  =0;
}
$numberUpdate = $_SESSION['numberUpdate'];
if (isset($_POST['T']))
{
	$T = $_POST['T'];
}
if (isset($_POST['SS']))
{
	$CHSS = "checked";
	$SS = $_POST['ssTxt'];
	$SST = $SS;
	$_SESSION['SS'] = "true";
}
else
{
	$CHSS = "";
	$SS = "";
	$_SESSION['SS'] = "false";
}
if (isset($_POST['HDT']))
	$HDTtxt = $_POST['HT'];
else
	$HDTtxt = "";

if ($A == 0)
	listageFichierPHP();

function listageFichierPHP()
{
	global $numberUpdate, $SS, $HDTtxt;
	$dirname = './'; 
	$dir = opendir($dirname); 
	while($file = readdir($dir)) { 
	if($file != '.' && $file != '..' && !is_dir($dirname.$file))  { 
			$info = new SplFileInfo('./'.$file);
			$ext = $info->getExtension();	
			if ($ext == "html")
			{
				$numberUpdate++;
				$content = file_get_contents("./" . $file);
				$content =  str_replace(".html", ".php", $content);
				$content = $SS . $HDTtxt . $content;
				$text2=fopen('./'.$file,'w+') or die("Une erreur c'est produite"); 
				fwrite($text2,$content); 
				fclose($text2); 
				$nameF = basename("./" . $file, '.html');				
				rename("./".$file, $nameF.'.php');
			}
		}
	}
	$_SESSION['numberUpdate'] = $numberUpdate;
}
?>
<!DOCTYPE html><html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifications : <?php echo $numberUpdate; ?></title>

<style media="screen">
body{
	width: 800px;
	margin: 0 auto 0 auto;
	background: #e0e0e0;
}
</style>
</head>
<body>
	<header>
		<div style="float:left;font-family:Segoe UI;font-size:44px;color:#5c5c5c;margin:0;padding:0">wAcole 2.5<p style="font-size:16px;margin:0;padding:0">(WebAcappella Converter OnLine)</p></div>
		<div style="float:right;margin-left:40px;margin-top:40px;font-family:Segoe UI;font-size:17px;color:#5c5c5c">
		Faite du PHP avec WebAcappella Sans aucune limite !</div>
			<div style="clear:both"></div>
		<div style="font-family:Segoe UI;font-size:20px;padding-top:40px;">
		<span>Nombre de modifications : </span> 
		<span style="font-weight:bold"><?php echo $numberUpdate; ?></span> 
		</div>
	</header>


	<form id="waco" action="" method="POST">
		<div style="clear:both"></div>
		<div id="headPertemp" style="margin-top:40px;">
			<div id="permant" style="float:left;font-family:Segoe UI;font-size:21px;color:#00">
				Header permanant 
				<p style="font-size:15px;margin:0;padding:0">(session_start();)</p>
				<input name="ssTxt" type="text" value="<?php echo $SST ?>" >
			</div>
			<div id="permant" style="float:right;font-family:Segoe UI;font-size:21px;color:#00">
			
				Header Tamporaire 
				<p style="font-size:15px;margin:0;padding:0">(header(location:xxx.html);)</p>
				<textarea  name="HT" ><?php echo $HDTtxt ?></textarea>
			</div>
		</div>
		<div style="clear:both"></div>
		<div id="HeaderActivat" style="font-family:Segoe UI;font-size:21px;color:#00">
			<p style="font-size:21px;margin:0;padding:0">Activation des Header !</p>
			<div id="ZoneCheck" style="margin-top:10px;margin-left:20px">
				<input  type="checkbox" name="SS" <?php echo $CHSS ?>   style="width:40px;height:40px;float:left"> 
				<span style="font-size:21px;margin-top:4px;margin-left:10px;;float:left;">Activer Header permanant !</span>
			<div style="clear:both"></div>
				<input  type="checkbox"  name="HDT" <?php echo $HD ?> style="width:40px;height:40px;float:left"  >
				<span style="font-size:21px;margin-top:4px;margin-left:10px;;float:left;">Activer Header Tamporaire !</span>
				<div style="clear:both"></div>
				<input name="T" style="width:40px;height:40px;float:left;text-align:center;margin-left:2px" type="text" value="<?php echo $T ?>">
				<span style="font-size:21px;margin-top:4px;margin-left:10px;float:left;">Temps d'actualisation</span>
			</div>
		</div>
		<div id="STARTBTN" style="font-family:Segoe UI;margin-top:150px;width:800px;text-align:center">
			<h1 style="font-size:28px;">Cocher et activer les conversions</h1>
			<input onChange="Actualise();"  type="checkbox"id="act" name="wOpen" <?php echo $W ?>  style="width:40px;height:40px;">
		</div>
	</form>

	<footer style="font-family:Segoe UI;margin-top:150px;width:800px;text-align:center;margin-top:150px;">
		<span><a id="tsite" style="font-family:Segoe UI;text-decoration:none;color:black;font-size:19px" href="http://www.antoine.falais.fr">Antoine Falais</a></span>
		<span style="font-family:Segoe UI;text-decoration:none;color:black;font-size:19px;margin-left:40px">-</span>
		<span style="font-family:Segoe UI;text-decoration:none;color:black;font-size:19px;margin-left:40px">contact@cybersoftcreation.fr</span>
		<span style="font-family:Segoe UI;text-decoration:none;color:black;font-size:19px;margin-left:40px">-</span>
		<p style="text-align:center;font-size:20px">©Antoine Falais</p>
	</footer>
	<!-- Document -->
	<script type="text/javascript">
	if (document.getElementById('act').checked)
		Refresh(<?php echo $T ?>);
	function Refresh(tmp)
	{
		if (document.getElementById('act').checked)
			setTimeout("Actualise()",tmp *1000);
	}

	function Actualise()
	{
		if (document.getElementById('act').checked)
	document.getElementById('waco').submit();
	}

	</script>
</body>
</html>