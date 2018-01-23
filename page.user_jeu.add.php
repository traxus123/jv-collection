<?php
	require('./model/pdo.php');
	require('./model/console.php');
	require('./model/jeu.php');
	require('./model/user.php');
	if (count($_POST) > 0) {
		/* Vérification des données saisies. */
		$post_check = true;
		
		if (trim($_POST['Console']) == '') {
			$post_check = false;
		}
		if (trim($_POST['Nom']) == '') {
			$post_check = false;
		}
		if (trim($_POST['Genre']) == '') {
			$post_check = false;
		}
		if (trim($_POST['Developpeur']) == '') {
			$post_check = false;
		}
		if (trim($_POST['Editeur']) == '') {
			$post_check = false;
		}
		if (trim($_POST['Annee']) == '') {
			$post_check = false;
		}

		if ($post_check) {
			/* Insertion du jeu. */
			$jeu = jeu::u_select_name_model_const_date($_POST['Console'], $_POST['Nom'], $_POST['Genre'], $_POST['Developpeur'], $_POST['Editeur'], $_POST['Annee']);
			if($jeu == null){
				

				$xml = simplexml_load_string(file_get_contents("http://thegamesdb.net/api/GetGame.php?name=".$_POST['Nom']), "SimpleXMLElement", LIBXML_NOCDATA);
				$json = json_encode($xml);
				$array = json_decode($json,TRUE);

				if ($array['Game'][0]['Images']['boxart'][1] != ''){
					$return = Jeu::insert($_POST['Console'], $_POST['Nom'], $_POST['Genre'], $_POST['Developpeur'], $_POST['Editeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description'], 'http://thegamesdb.net/banners/'.$array['Game'][0]['Images']['boxart'][1]);
				}
				else{
					$return = Jeu::insert($_POST['Console'], $_POST['Nom'], $_POST['Genre'], $_POST['Developpeur'], $_POST['Editeur'], $_POST['Annee'], $_POST['Prix'], $_POST['Description'], '');
				}				
				$jeu = jeu::u_select_name_model_const_date($_POST['Console'], $_POST['Nom'], $_POST['Genre'], $_POST['Developpeur'], $_POST['Editeur'], $_POST['Annee']);
				$return = Console::u_insert($user->id, $jeu['id'], $_POST['Etat']);
			}
			else{
				$xml = simplexml_load_string(file_get_contents("http://thegamesdb.net/api/GetGame.php?name=".$_POST['Nom']), "SimpleXMLElement", LIBXML_NOCDATA);
				$json = json_encode($xml);
				$array = json_decode($json,TRUE);
				$return = Jeu::u_insert($user->id, $jeu['id'], $_POST['Etat']);
			}
			header('Location: ./list-jeu-utilisateur.html');
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
   		callPage('script.user_jeu.add.list.php?Nom='+document.getElementById("Nom").value+'&Console='+document.getElementById("Console").value+'&Genre='+document.getElementById("Genre").value+'&Developpeur='+document.getElementById("Developpeur").value+'&Editeur='+document.getElementById("Editeur").value+'&Annee='+document.getElementById("Annee").value, document.getElementById("list"));
	}

	function LoadList(ev){
		console.log(ev.target.id.split('_')[2]);

		document.getElementById("Nom").value = document.getElementById("s_nom_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;
		document.getElementById("Console").value = document.getElementById("s_console_"+ev.target.parentElement.parentElement.id.split('_')[2]).className;
		document.getElementById("Genre").value = document.getElementById("s_genre_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;
		document.getElementById("Developpeur").value = document.getElementById("s_developpeur_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;
		document.getElementById("Editeur").value = document.getElementById("s_editeur_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;
		document.getElementById("Annee").value = document.getElementById("s_annee_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;
		document.getElementById("Prix").value = document.getElementById("s_prix_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;
		document.getElementById("Description").value = document.getElementById("s_description_"+ev.target.parentElement.parentElement.id.split('_')[2]).innerHTML;

	}

</script>
<section>
	<header>
		<h1>Ajouter un jeu a ma collection</h1>
	</header>

	<form action="./ajouter-user_jeu.html" method="post">
		<table class="table-form">
			<tbody>
				<tr>
					<td>Nom du jeu :</td>
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
					<td>Console du jeu:</td>
					<td>
						<?php
							$row2 = Console::select_d_orderbyname ();
							echo '<select id="Console" onchange="GetList(event)" name="Console">';
							foreach ($row2 as $key => $value) {	
								echo '<option value="' . $value['id'] . '">' . $value['nom'] . '</option>';
							}
							echo '</select>'
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
					<td>Genre du jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Genre" id="Genre" onchange="GetList(event)" placeholder="Entrez un Genre." style="width: 100%;" type="text" value="' . $_POST['Genre'] . '" />';
							} else {
								echo '<input name="Genre" id="Genre" onchange="GetList(event)" placeholder="Entrez un Genre." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Genre']) == '')) {
								echo '<span class="error">* Le Genre doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Developpeur du jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Developpeur" id="Developpeur" onchange="GetList(event)" placeholder="Entrez un Developpeur." style="width: 100%;" type="text" value="' . $_POST['Developpeur'] . '" />';
							} else {
								echo '<input name="Developpeur" id="Developpeur" onchange="GetList(event)" placeholder="Entrez un Developpeur." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Developpeur']) == '')) {
								echo '<span class="error">* Le Developpeur doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Editeur du jeu :</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Editeur" id="Editeur" onchange="GetList(event)" placeholder="Entrez un Editeur." style="width: 100%;" type="text" value="' . $_POST['Editeur'] . '" />';
							} else {
								echo '<input name="Editeur" id="Editeur" onchange="GetList(event)" placeholder="Entrez un Editeur." style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Editeur']) == '')) {
								echo '<span class="error">* Le Editeur doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Annee du jeu :</td>
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
					<td>Prix du jeu :</td>
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
					<td>Description du jeu :</td>
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
				<tr>
					<td>etat du jeu:</td>
					<td>
						<?php
							if (count($_POST) > 0) {
								echo '<input name="Etat" placeholder="Entrez un Etat. (/10)" style="width: 100%;" type="text" value="' . $_POST['Etat'] . '" />';
							} else {
								echo '<input name="Etat" placeholder="Entrez un Etat. (/10)" style="width: 100%;" type="text" />';
							}
						?>
					</td>
					<td>
						<?php
							if ((count($_POST) > 0) && (trim($_POST['Etat']) == '')) {
								echo '<span class="error">* Le Etat doit être renseigné.</span>';
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<center><input type="submit" value="Envoyer" /></center>
	</form>
	<div id="list">

	</div>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
