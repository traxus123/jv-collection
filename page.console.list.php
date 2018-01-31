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

	function reload(ev) {
   		callPage('script.console.list.php?Nom='+document.getElementById("Nom").value+'&Model='+document.getElementById("Model").value+'&Constructeur='+document.getElementById("Constructeur").value+'&Annee='+document.getElementById("Annee").value, document.getElementById("list"));
	}

</script>

<section>
	<header>
		<h1>
			Liste des consoles
		</h1>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-console.html" title="Ajouter une nouvelle console."></a>';
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
	<div class="half" id="list">
				
	</div>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
