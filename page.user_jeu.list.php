<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/console.php');
	require('./model/jeu.php');
	require('./model/user_Jeu.php');
?>
<html>
	<?php
		include('./inc.head.php');
	?>
	<body onload="reload(event)">

	<header>
		<?php
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
   		callPage('script.user_jeu.list.php?filtre='+document.getElementById("txt-filter").value, document.getElementById("list"));
	}

</script>
	<section>
		<header>
			<h1>Mes Jeux</h1>
		</header>
		<article>
		<?php
			echo '<a class="icon icon-add" href="./ajouter-user_jeu.html" title="Ajouter un nouveau jeu."></a>';
		?>
		<div class="float-right">
			Filtre :
			<input type="text" id="txt-filter" onchange="reload(event)"/>
		</div>
	</header>
	<div id="list">
				
	</div>
		</article>
	</section>
	</body>
</html>
