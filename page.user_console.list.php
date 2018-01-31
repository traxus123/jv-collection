<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
?>
<html>
	<?php
		include('./inc.head.php');
	?>
	<body onload="reload(event)">

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

	function reload(ev) {
   		callPage('script.user_console.list.php?Nom='+document.getElementById("Nom").value+'&Model='+document.getElementById("Model").value+'&Constructeur='+document.getElementById("Constructeur").value+'&Annee='+document.getElementById("Annee").value, document.getElementById("list"));
	}

</script>
<!-- miss one ? find her a <name>.html
_______________________▓▓▓▓▓▓▓▓▓▓▓▓__________▂▂▂
____________▓▓▓▓▓▓▓▓▓▒▒▒▒▒▐▒▐▒▒▒▓▓▓▓▓__▒░░░▒
________▓▓▓▓▒▒▒▀▀▅▅▄▄▒▒▒▒▒▒▐▒▐▒▒▒▒▒▒▒▒▒░░░░▒
______▓▓▓▒▒▒▒▒▒▒▒▒▒▒▒▀▄▒▒▒▒▐▒▐▒▒▒▒▒▒▒▒░░░░░▒▒
___▓▓▓▒▒▒▒▄▄▄▄▄▒▒▒▒▒▒▒▀▒▒▒▒░░░░░░░░▒▒░░░░▒░▒
__▓▓▓▄▅▀▀▀▒▒▒▒▒▒▀▀▀▅▒▒▒░░░░░░░░░░░░░░░░░░░▒░▒
__▓▓▀▒▒▒▒▒▒▄▄▄▄▒▒▒▒▒░░░░░░░░░░░░░░░░░░░░░▒░░▒
_▓▓▒▒▒▒▒▅▅▀▀▒▒▒▀▅▒▒░░░░░░░░░░░░░░░░░░░░░░▒░░░▒
_▓▓▒▒▒▅▀▒▒▒▒▒▒▒▒▒▒░░░░░░░░░░░░░░░░░░░░░▒░░░░▒▓
▓▓▒▒▒▌▒▒▒▒▒▒▒▒▒▒░░░░░░░░░░░░░░░░░░░░░░░░░░░▓▒▓
_▓▒▒▒▌▒▒▒▒▒▒▒▒▒▒░░░░░▄▄▄▄░░░░░░░░░░░░░░░░░░▓▒▒▓
_▓▒▒▒▌▒▒▒▒▒▒▒▒▒▒░░░░█▀▀▀▀▀▅▅░░░░░░░░░░░░░░░▓▒▒▒▓
_▓▒▒▒▌▒▒▒▒▒▒▒▒▒▒░░░░█____▓▓▓█▀▅▄░░░▄░░░░░░░░▓▒▒▒▓
__▓▒▒▒▌▒▒▒▒▒▒▒▒▒░░░░▐___▓▓▓█▌____█▀▀░░▄░░░░░▓▒▒▒▒▓
___▓▒▒▐▌▒▒▒▒▒▒▒▒▒░░░░▐__▓▓▓██▄____███▀▀░▄░░░▓▒▒▒▒▓
____▓▒▒▒▌▒▒▒▒▒▒▒▒▒░░░░___▓▓▐█__█▄▄▓░░▀▀▀░░░▓▓▒▒▒▐▒▓
_____▓▒▒▒▌▒▒▒▒▒▒▒▒░░░░░___▓▓██████▓░░░░░░░▓▒▒▒▒▒▐▒▓
______▓▒▒▒▌▒▒▒▒▒▒▒░░░░░░░__▓▓▀███▀▓░░░░░░▓▒▒▒▒▒▒▐▒▓
_______▓▒▒▒▌▒▒▒▒▒░░░░░░░░____▓▓▓▓▓_░░░░░░▓▒▒▒▒▒▒▐▒▐▓
_________▓▒▒▒█▒▒▒░▅▀░░░░░░░░░░░░░░░░░░░░▓▒▒▒▒▒▒▐▒▐▓
___________▓▓▒▒▌▒▒▒░░░▐░░░░░░░░░░░░░░░░▓▒▒▒▒▒▒▐▒▒▌▓
____________▓▓▒▒▐▌▒▒▒░▀░░░░░░░░░░░▒▒░░▓▒▒▒▒▒▒▒▐▒▐▒▓
______________▓▐▒▒▐▒▒▒▒▒▒▒▒▒▓_______▒░░▓▒▒▒▒▒▒▒█▒▒█▒▓
________________▓▌▒▒▐▒▒▒▒▒▒▒▒▓______▒░▓▒▒▒▒▒▒▒█▒▒█▒▒▓
_________________▓▐▒▒▀▌▒▒▒▒▒▒▓______▒▓▒▒▒▒▒▒▒█▒▒█▒▒▒▓
__________________▓▒▐▒▒▐▒▒▒▒▒▓______▓▓▒▒▒▒▒█▀▒▒█▒▒▒▒▓
___________________▓▒▐▒▒▐▒▒▒▒▓_____▓▓▒▒▒▒▄▀▒▒▄▀▒▒▒▒▒▓
_______▓▓▓▓▓_____▓▒▐▒▒▒▌▒▒▓_____▓▓▒▒▒▄▀▒▒▄▀▒▒▒▒▒▓▓
_____▓▓▒▓____▓____▓▒▐▒▒▒▐▒▒▓___▓▓▒▒▒▄▀▒▒▄▀▒▒▒▒▒▒▓
_____▓▒▒▓________▓▒▒▒▌▒▒▒▌▓____▓▒▒▒▄▀▒▒▄▀▒▒▒▒▒▒▒▓
_____▓▒▒▓______▓▒▒▒▒▌▒▒▒▌▓____▓▒▒▄▀▒▒▄▀▒▒▒▒▒▒▒▓
______▓▒▒▓▓▓▓▓▒▒▒▒▐▒▒▒▒▓____▓▒▒█▒▒▒█▒▒▒▒▒▒▒▒▓
________▓▒▒▒▒▒▒▒▒▒▐▒▒▒▓▓_____▓▒█▒▒▒█▒▒▒▒▒▒▒▒▓
_________▓▓▒▒▒▒▒▒▒▐▒▓▓▓______▓▒▌▒▒▒▌▒▒▒▒▒▒▒▒▓
____________▓▓▓▓▓▓▓▓▓__________▓▌▒▒▒▌▒▒▒▒▒▒▒▒▓
___________________________________▓▓▒▒▌▒▒▒▒▒▒▒▒▓
___________________________________▓▒▒▒▌▒▒▒▒▒▒▒▓
___________________________________▓▒▒▒▌▒▒▒▒▒▒▒▓
____________________________________▓▒▒▐▒▒▒▒▒▒▒▓____▓▓▓
_____________________________________▓▒▒▐▒▒▒▒▒▒▒▓_______▓
______________________________________▓▓▒▐▒▒▒▒▒▒▒▓▓____▓▓
_________________________________________▓▌▒▒▒▒▒▒▒▒▓▓▓▒▓
____________________________________________▓▓▒▒▒▒▒▒▒▒▒▓
________________________________________________▓▓▓▓▓▓▓

-->
	<header>
		<?php
			include('./inc.nav.php');
		?>
	</header>

	<section>
		<header>
			<h1>Mes Consoles</h1>
		</header>
		<article>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-user_console.html" title="Ajouter une nouvelle console."></a>';
		?>
		<div class="float-right">
			Nom :
			<input type="text" id="Nom" onchange="reload(event)"/>
			Model :
			<input type="text" id="Model" onchange="reload(event)"/>
			Constructeur :
			<input type="text" id="Constructeur" onchange="reload(event)"/>
			Annee :
			<input type="text" id="Annee" onchange="reload(event)"/>
		</div>
	</header>
	<div id="list">
				
	</div>
		</article>
	</section>
	<?php
		include('./inc.footer.php');
	?>
	</body>
</html>
