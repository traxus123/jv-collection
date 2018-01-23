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
   		callPage('script.user_jeu.list.php?filtre='+document.getElementById("txt-filter").value, document.getElementById("list"));
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
			window.location.replace("http://www.club-calliope.fr/accueil.html");
		}
		else if(buf.endsWith("discord")){
			document.getElementById("egg").innerHTML = '<img src="https://vignette.wikia.nocookie.net/villains/images/7/76/Discord_the_Spirit_of_Disharmony.jpg/revision/latest/scale-to-width-down/2000?cb=20160922220025">'
		}
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
