<?php
	require('./model/pdo.php');
	require('./model/console.php');
	require('./model/user.php');
	if (count($_POST) > 0) {
		/* Vérification des données saisies. */
		$post_check = true;
		/*
		if (trim($_POST['Nom']) == '') {
			$post_check = false;
		}
		*/
		if ($post_check) {
			/* Insertion du jeu. */

			$return = Console::insert($_POST['Nom'], $_POST['Model'], $_POST['Constructeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description'], ' ');
			header('Location: ./list-console.html');
		}
	}
?>

<html>

<?php
	include('./inc.head.php');
?>

<body onload="GetList(event)">

<header>
	<?php
		include('./inc.banner.php');
		include('./inc.nav.php');
	?>
</header>
<script type="text/javascript">
	function AjaxCaller(){
        var xmlhttp=false;
        try{
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
            try{
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(E){
                xmlhttp = false;
            }
        }

        if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }

    function callPage(url, div){
        ajax=AjaxCaller(); 
        ajax.open("GET", url, true); 
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4){
                if(ajax.status==200){
                    div.innerHTML = ajax.responseText;
                }
            }
        }
        ajax.send(null);
    }

	function GetList(ev) {
   		callPage('script.console.add.list.php?Nom='+document.getElementById("Nom").value+'&Model='+document.getElementById("Model").value+'&Constructeur='+document.getElementById("Constructeur").value+'&Annee='+document.getElementById("Annee").value, document.getElementById("list"));
	}

	function LoadList(ev){
		console.log(ev.target.id.split('_')[2]);

		document.getElementById("Nom").value = document.getElementById("s_nom_"+ev.target.id.split('_')[2]).innerHTML
		document.getElementById("Model").value = document.getElementById("s_model_"+ev.target.id.split('_')[2]).innerHTML
		document.getElementById("Constructeur").value = document.getElementById("s_constructeur_"+ev.target.id.split('_')[2]).innerHTML
		document.getElementById("Annee").value = document.getElementById("s_annee_"+ev.target.id.split('_')[2]).innerHTML
		document.getElementById("Prix").value = document.getElementById("s_prix_"+ev.target.id.split('_')[2]).innerHTML
		document.getElementById("Description").value = document.getElementById("s_description_"+ev.target.id.split('_')[2]).innerHTML

	}

</script>
<section>
	<header>
		<h1>Ajouter une console</h1>
	</header>

	<form action="./ajouter-console.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Nom de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Nom" id="Nom" onchange="GetList(event)" placeholder="Entrez un Nom." style="width: 100%;" type="text" value="' . $_POST['Nom'] . '" />';
							} else {
								echo '<input name="Nom" id="Nom" onchange="GetList(event)" placeholder="Entrez un Nom." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Nom']) == '')) {
								echo '<span class="error">* Le Nom doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Model de la console:</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Model" id="Model" onchange="GetList(event)" placeholder="Entrez un Model." style="width: 100%;" type="text" value="' . $_POST['Model'] . '" />';
							} else {
								echo '<input name="Model" id="Model" onchange="GetList(event)" placeholder="Entrez un Model." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Model']) == '')) {
								echo '<span class="error">* Le Model doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Constructeur de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Constructeur" id="Constructeur" onchange="GetList(event)" placeholder="Entrez un Constructeur." style="width: 100%;" type="text" value="' . $_POST['Constructeur'] . '" />';
							} else {
								echo '<input name="Constructeur" id="Constructeur" onchange="GetList(event)" placeholder="Entrez un Constructeur." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Constructeur']) == '')) {
								echo '<span class="error">* Le Constructeur doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Annee de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Annee" id="Annee" onchange="GetList(event)" placeholder="Entrez un Annee." style="width: 100%;" type="text" value="' . $_POST['Annee'] . '" />';
							} else {
								echo '<input name="Annee" id="Annee" onchange="GetList(event)" placeholder="Entrez un Annee." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Annee']) == '')) {
								echo '<span class="error">* L\'annee doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Prix de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Prix" id="Prix" placeholder="Entrez un Prix." style="width: 100%;" type="text" value="' . $_POST['Prix'] . '" />';
							} else {
								echo '<input name="Prix" id="Prix" placeholder="Entrez un Prix." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Prix']) == '')) {
								echo '<span class="error">* Le Prix doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Description de la console :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Description" id="Description" placeholder="Entrez un Description." style="width: 100%;" type="text" value="' . $_POST['Description'] . '" />';
							} else {
								echo '<input name="Description" id="Description" placeholder="Entrez un Description." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Description']) == '')) {
								echo '<span class="error">* Le Description doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<center><input type="submit" value="Envoyer" /></center>

		<div id="list">

		</div>
	</form>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
