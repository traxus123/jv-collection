<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
	require('./model/jeu.php');
?>
<html>
	
<?php
	include('./inc.head.php');
?>
	
<body onload="reload(event)" onkeypress="buffer(event)">

<header>
	<?php
		include('./inc.banner.php');

		include('./inc.nav.php');
	?>
</header>
		
<script type="text/javascript">
	
	var buf = '';

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

	function reload(ev) {
   		callPage('script.user_jeu.list.php?Nom='+document.getElementById("Nom").value+'&Console='+document.getElementById("Console").value+'&Genre='+document.getElementById("Genre").value+'&Developpeur='+document.getElementById("Developpeur").value+'&Editeur='+document.getElementById("Editeur").value+'&Annee='+document.getElementById("Annee").value, document.getElementById("list"));
	}

	function buffer(ev){
		buf += String.fromCharCode(ev.which);
		console.log(buf);
		console.log(buf.length);
		if(buf.length > 10){
			buf = buf.slice(-10);
		}
		if(buf.endsWith("zythum")){
			window.location.replace("https://www.saveur-biere.com/fr/");
		}
		else if(buf.endsWith("calliope")){
			window.location.replace("http://www.club-calliope.fr/");
		}
		else if(buf.endsWith("discord")){
			document.getElementById("egg").innerHTML = '<img src="https://vignette.wikia.nocookie.net/villains/images/7/76/Discord_the_Spirit_of_Disharmony.jpg/revision/latest/scale-to-width-down/2000?cb=20160922220025">'
		}
	}

</script>
<!-- miss one ? find her a <name>.html
________________________________▄▄████████▄▄
______________________________▄█▓▓▓▓▓▓▓▓▓▓▓▓█▄
_____________________________█▓▓███▓▓▓▓▓▓▓▓▓█▓█____________▄▄▄▄▄
____________________________▐███▓▓▓██▓▓▓▓▓▓▓█▓▓█_______▄██▓▓▓▓▓█▄
_____________________▄▄▄____█▓▓▓▓▓▓▓█▓▓▓▓▓▓▓█▓▓█___▄█▓▓▓▓▓▓▓▓▓▓▓█▄
___________________█▓▓▓▓██▄█▓▓▓▓▓▓▓█▓▓▓▓▓▓█▓▓▓█_▄█▓░░░▓▓▓▓▓▓▓▓▓▓█▄
______▄▄███████████▓▓▓▓▓██▓▓▓▓▓▓▓█▓▓▓▓▓█▓▓▓▓██▓░░░░░░▓▓▓▓▓▓▓▓▓█▄
___▄██▓▓▓▓▓▓▓▓▓█▓▓███▓▓▓▓▓▓▓▓▓▓█▓▓▓▓▓█▓▓▓▓▓▓▓░░░░░░░░▓▓▓▓▓▓▓▓▓█
__██▓▓▓▓▓▓▓▓▓▓▓▓█▓▓▓█▓▓▓▓▓▓▓▓▓█▓▓▓▓▓▓▓██▓▓▓▓░░░░░░░░░▓▓▓▓▓▓▓▓█▓█
_██▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓▓█▓▓▓▓▓▓▓▓▓▓███▓▓▓▓▓█▓▓▓░░░░░░░░░░▓▓▓▓▓▓▓█▓▓█
██▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓██▓▓▓▓▓▓▓▓▓▓▓▓▓█▓▓▓▓█▓▓▓░░░░░░░▓░░░▓▓▓▓▓█▓▓▓▓█
██▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓███████░░░░░░░▓░░░▓▓▓██▓▓▓▓▓█▌
██▓▓▓▓▓▓▓▓▓▓▓▓████▀▀▀▀██▓▓▓▓▓▓▓▓███░░░░░░░░░░░░░░▓░░░▓▓▓▓█▓▓▓▓▓▓█
▐█▓▓▓▓▓▓▓▓▓▓██__________▓██▓▓▓▓▓▓█░░░░░░░░░░░░░░░░░▓░░░▓▓▓▓█▓▓▓▓▓▓█
_▐█▓▓▓▓▓▓▓▓██__________▓▓░░░█▓▓▓█░░░░░░░░░░░░░░░░░░▓████████▓▓▓▓▓▓█
___█▓▓▓▓▓▓▓█__________▓▓░░░░░░███░░░░░▄▄▄▄░░░░▐░░░███▓▓▓▓▓▓▓▓▓████▓█
____█▓▓▓▓▓▓█_________▓▓░░░░░░░░█░░░░▄▀_____▀█▄░▄▌░█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓██▄
___█_█▓▓▓▓▓█________▓▓░░░░░░░░░░░░▄▀__________▀█░░█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓██▄
__█▓█_█▓▓▓▓█_______▓▓░░░░░░░░░░░█▓▓▓▓▓▓_______█▄█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓█
__▐█▓███▓▓▓█______▓▓░░░░░░░░░░░█▓▓██▌___▓_____█░█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓█
___█▓▓▓▓▓▓▓▓█_____▓▓░░░░░░░░░░█▓████▌____▓____▐▄▄█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓▓█
____█▓▓▓▓▓▓▓█_____▓▓░░░░░█░░░░█▓█████▄___▓_____░░░█▓▓▓███▓▓▓▓▓▓▓▓▓▓█▓▓█
______██▓▓▓▓█_____▐▄▓░░░░░█░░░▐▓█████▀▀█▓▓▓____░██████▓▓▓█▓▓████▓▓█▓▓▓█
_________▀▀▀▀______█▄▀▀▀▀█▀░░░░▐▓█████▄▄██▓▓__███▓▓▓▓▓████▓▓▓▓█▓▓▓▓▓▓▓█
_____________________▄▄__▓_▐█▌░░░░▐▓████████▓▓__██▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓▓▓▓▓▓▓█
_______________________▓__▓▀█░░░░░░░▓███████▓▓_▐█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█▓▓▓▓▓▓▓█
________________________▓__▓▀░░░░░░░_▓██████▓▓__█▓▓▓▓▓▓▓▓█▓▓▓▓▓██▓▓▓▓▓▓▓█
________________________▓▓░░░░░░░░░░_▓▓▓▓▓▓___▐█▓▓▓▓▓▓▓▓▓█████▓▓▓▓▓▓▓▓█
_______________________▓░░░░▄░░░░░░░░░_________░░█▓▓▓▓▓▓▓▓▓▓▓█▓▓████████
_______________________▓░░░▀░░▄▄░░░░░░░░░░░░░░██▓▓▓▓▓▓▓▓▓▓▓█▓▓▓██
________________________▓▓▓▄▄█___█▀░░░░░░░░░░░░░██▓▓▓▓▓▓▓▓▓▓█▓▓▓▓██
_____________________________▀▄__█░░░░░░░░░░░░░▓▓▓██▓▓▓▓▓▓▓▓▓█▓▓▓▓▓█
________________________________█▓▓░░░░░░░▓▓▓▓_______██▓▓▓▓▓▓▓█▓▓▓▓▓▓█
_____________________________________▓▓▓▓▓▓▓_____________▄▄███████▓▓▓▓▓▓█
_________________________________________________________▄█▓▓▓▓▓▓▓▓▓▓▓▓▓▓█
_________________________________________________________█▓▓▓▓▓▓▓▓▓▓▓▓▓▓█
________________________________________________________▐█▓▓▓▓▓██▀▀█████
__________________________________________________________█▓▓▓▓▓▓█▄
____________________________________________________________▀▀█▓▓▓▓███▀
________________________________________________________________▀▀▀▀
-->
	<section>
		<header>
			<h1>Mes Jeux</h1>
		</header>
		<article>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-user_jeu.html" title="Ajouter un nouveau jeu."></a>';
		?>
		<div class="float-right">
			Nom :
			<input type="text" id="Nom" onchange="reload(event)"/>
			Console (TODO) :
			<input type="text" id="Console" onchange="reload(event)"/>
			Genre :
			<input type="text" id="Genre" onchange="reload(event)"/>
			Developpeur :
			<input type="text" id="Developpeur" onchange="reload(event)"/>
			Editeur :
			<input type="text" id="Editeur" onchange="reload(event)"/>
			Annee :
			<input type="text" id="Annee" onchange="reload(event)"/>
		</div>
		<div id='egg'></div>
		<div id="list">
				
		</div>
		</article>
	</section>
	<?php
		include('./inc.footer.php');
	?>
	</body>
</html>
