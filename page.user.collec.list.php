<?php
	require('./model/pdo.php');
	require('./model/user.php');
?>

<html>

<?php
	include('./inc.head.php');
?>

<body onload="reload(event)">
<!-- miss one ? find her a <name>.html
____________________________________▓▓▓
___________________________________▓▒▒▒▓▓
____________________▄▄▄▄▄▄▄▄▄_____▓▒▒▒▒▒▓
___▓▓▓▓▓____▄█████▓▓▓▓▓▓░░███████▓▒▒▒▒▓▒▓
____▓▒▓▒▓▓▓██▓█▓▓▓▓▓▓▓░░░▓▓▓▓▓▓▓▓▒▒▒▒▒▓▒▓
______▓▒▒▒▓▒▒▓▓▓▓▓▓▓▓░░░▓▓▓▓▓▓▓▓█▒▒▒▒▒▒▓▒▓
______█▓▓▒▒▓▒▒▓▒▒▓▓▓░░░▓▓▓▓▓▓▓▓█▒▒▒▒▒▒▒▓▒▓
____▄█▓▓█▓▓▓▒▒▒▓▒▓▓░░░░▓▓▓▓▓▓▓▓█▒▒▒▒▒▒▓▒▒▓
___█▓▓▓█▓▓█▓▓▒▓▒▓▓▓░░░░▓▓▓▓▓▓▓▓▓█▒▒▒▒▓▒▒▒▓
__█▓▓▓█▓▓█▓▓▓▓▓▓▓▓▓░░░█████████████▒▒▒▒▒▒▓
__█▓▓▓█▓▓█▓▓▓▓▓▓██████▒▌__▓█_____▓▓▒▒▒▒▒▒▒▓
_▐█▓▓█▓▓▓█▓▓████▒▒▒▒▒▒▌__▓▓█▄____▓▓▒▒▒▒▒▒▓
_▐█▓█▓▓▓▓███▒▒▒▒▒▒▒▒▒▒▌__▓▓█████▓▓▒▒▒▒▒▒▓
__█▓█▓▓██_▅▄██▄▒▒▒▒▒▒▒▐___▓▓█▄_██▓▓▄▅▅▒▒▒▓
__█▓▓██__▅▄▄▄▌__▀▄▒▒▒▒▒▐___▓▓▓████▓▅▅▄▒▒▒█
__█▓█_________▓▄___▀▒▒▒▒▒▐____▓▓▓▓▓▓▅▅▄▒▒▒██
__██___________▓▓█▀█▄▒▒▒▒▒▌________▒▒▒▒▒▒█▓█▌
_________________▓▓███▒▒▒▒▒▐____▒▒▒██▒▒██▓██▌
___________________▓▓▓▒▒▒▒▒▒▒▒▒▒▒▒█▓▓██▓▓██▓▌
____________________▓▒▒▄▒▒▌▒▒▒▒▒▒▒█▓▓▓▓██▓▓▓█
___________________▓▒▒▒▒▒▐▒▒▒▒▒▒▒█▓███▓▓▓█▓▓█▌
_____________________▓▓▓▄▀▒▒▒▒▓▓▓█▓▓▓▓▓▓█▓▓▓▓██
_________________________▓▓▓▓▓▓____█▓▓██▀▀█▓▓▓▓░░█
______________________________________▀▀__▄█▓▓▓▓▓░░▓█
_______________________________________▄██▓▓▓▓▓▓░░▓▓█
_____________________________________██▓▓▓▓▓▓▓▓░░▓▓█
______________________________________█▓▓▓▓▓▓▓░░░▓▓█
_______________________________________█▓▓▓▓▓░░░▓▓▓█
________________________________________█▓▓▓░░░▓▓▓▓█
__________________________________________██░░░▓▓▓▓█
_____________________________________________█░▓▓▓█
_______________________________________________████
-->
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
   		callPage('script.user.collec.list.php?filtre='+document.getElementById("txt-filter").value, document.getElementById("list"));
	}

</script>
<section>
	<header>
		<h1>
			Liste des utilisateurs
		</h1>
		<div class="float-right">
			Filtre :
			<input type="text" id="txt-filter" onchange="reload(event)"/>
		</div>
	</header>
	<div id="list">
				
	</div>
</section>

<?php
	include('./inc.aside.php');
	include('./inc.footer.php');
?>

</body>

</html>
