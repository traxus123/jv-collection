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
   		callPage('script.user.collec.jeu.list.php?user='+<?php echo $_GET['user']; ?>+'&filtre='+document.getElementById("txt-filter").value, document.getElementById("list"));
	}

</script>
	<section>
		<header>
			<h1>Jeux de <?php echo JVUser::select($_GET['user'])['pseudo']?></h1>
		</header>
		<article>
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
