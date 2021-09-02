<?php session_start();
	include 'database.php';
	global $db;
?>

<!--
<?php
	$q = $db->query("SELECT * FROM joueurs");
	while ($table = $q->fetch()) {
		echo "pseudo : " . $table['pseudo'] . "<br/>";
	}
?>
-->
<!-- CONNEXION UTILISATEUR -->
<?php if(isset($_SESSION['pseudo']) && (isset($_SESSION['photo']))){ ?>
	<p>TA MERE : <?=$_SESSION['pseudo'];?></p>
	<p>TON PERE : <?=$_SESSION['photo'];?></p>
<?php
session_destroy();
	}else{
		?>
<div class="conn">
<form method="post">
	<input type="text" name="pseudo" id="pseudo" placeholder="Votre prénom ou prénom.n" required><br/>
	<input type="submit" name="connexion" id="connexion" value="Jouer">
</form>
</div>
<?php
	if(isset($_POST['connexion'])){
		
		extract($_POST);

		if(!empty($pseudo)){

			$q = $db->prepare("SELECT * FROM joueurs WHERE pseudo = :pseudo");
			$q->execute(['pseudo' => $pseudo]);
			$result = $q->fetch();
			
			if($result == true){
				//le compte existe fdp
				echo "Connecté !";
				$_SESSION['pseudo'] = $result['pseudo'];
				$_SESSION['photo'] = $result['photo'];
				?><meta http-equiv="refresh" content="1" /><?php
			}else{
				echo "<p>NIQUE TA MERE ! PAS DE LA SOIRÉE !</p>";
			}
		}else{
			?> <p class="insulte"><?php echo "MET TON PRENOM SALE SALOPE";
		}
	}
}
?>