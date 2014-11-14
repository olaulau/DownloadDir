<?php 
require_once '../includes/ALL.inc.php';

Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style></style>
	<link rel="stylesheet" href="./../jstree/themes/default/style.min.css" />
</head>
<body>

<?php
if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			?>
			<form action="move.post.php" method="post">
				deplacer vers :<br/>
				<input type="hidden" id="new_subdir" name="new_subdir" value="" size="100"/>
				<div id="tree" class="demo"></div>

				<input type="hidden" name="subdir" value="<?=$_GET["subdir"]?>">
				<input type="hidden" name="file" value="<?=$_GET["file"]?>">
				<input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
				<button type="submit">Valider</button>
			</form>
			
			<script src="./../js/jquery-2.1.1.min.js"></script>
			<script src="./../jstree/jstree.min.js"></script>
			
			<script>
			$.jstree.defaults.core.themes.variant = "large";
			$('#tree').jstree
			({
				'core' :
				{
					"multiple" : false,
				    "animation" : 0,
					'data' :
					{
						'url' : 'move_directories.json.php',
					}
				}
			});
			
			$('#tree').on('changed.jstree', function (e, data) {
			    var tab = [];
			    var currentNode = data.instance.get_node(data.selected[0]);
			    tab.unshift(currentNode.text);
			    var parent;
			    while( (parent = currentNode.parent) !== "#" ) {
			    	currentNode = data.instance.get_node(parent);
			    	tab.unshift(currentNode.text);
			    }
			    $('#new_subdir').val(tab.join('/'));
			});
			</script>
			<?php 
		}
		else {
			echo "n'existe pas. bug ?";
		}
	}
	else {
		echo "pb de parametre.";
	}
	
}
else {
	sleep(3);
	exit;
}
?>

</body>
</html>