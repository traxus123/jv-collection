<?php
	require('./model/pdo.php');
	require('./model/user.php');
	require('./model/user_Console.php');
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
   		callPage('script.user_console.list.php?filtre='+document.getElementById("txt-filter").value, document.getElementById("list"));
	}

</script>

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
			Filtre :
			<input type="text" id="txt-filter" onchange="reload(event)"/>
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
