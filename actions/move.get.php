<?php 
require_once '../includes/ALL.inc.php';
$app_base_path = app_base_path();

Session::start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style></style>
	<link href="<?=$app_base_path?>/vendor/vakata/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
	<link href="<?=$app_base_path?>/index.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
if(isset($_SESSION["user"])) {
	if(!empty($_GET["file"])) {
		$full_file = $base_dir."/" . $_GET["subdir"] . "/" . $_GET["file"];
		if(file_exists($full_file)) {
			?>
			<form action="move.post.php" method="post">
				<?= L::actions_move_to ?> :<br/>
				<input type="hidden" id="new_subdir" name="new_subdir" value="" size="100"/>
				<div id="tree" class="demo"></div>

				<input type="hidden" id="subdir" name="subdir" value="<?=$_GET["subdir"]?>">
				<input type="hidden" id="file" name="file" value="<?=$_GET["file"]?>">
				<input type="hidden" id="redirect" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
				<button type="submit"><?= L::common_submit_button ?></button>
			</form>
			
			<script src="<?=$app_base_path?>/vendor/components/jquery/jquery.min.js"></script>
			<script src="<?=$app_base_path?>/vendor/vakata/jstree/dist/jstree.min.js"></script>
			
			<script>
			// http://stackoverflow.com/a/901144/1248801
			function getParameterByName(name) {
			    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
			    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			    results = regex.exec(location.search);
			    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
			}
			
			$.jstree.defaults.core.themes.variant = "large";
			$('#tree').jstree
			({
				//"plugins" : [ "checkbox", "contextmenu", "dnd", "search", "sort", "state", "types", "unique", "wholerow" ],
				"plugins" : [ "wholerow" ],
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

			$('#tree').on('ready.jstree', function (e, data) {
				$('#tree').jstree(true).deselect_all(true);
				var node_to_select = '/' + getParameterByName('subdir');
				$('#tree').jstree(true).select_node(encodeURIComponent(node_to_select));
			}).jstree();


			$('#tree').on('changed.jstree', function (e, data) {
				var currentNode = data.instance.get_node(data.selected[0]);
				$('#tree').jstree(true).open_node(currentNode); // click on node open it
				
				var tab = [];
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
			echo L::actions_doesnt_exist;
		}
	}
	else {
		echo L::actions_parameter_problem;
	}
	
}
else {
	sleep(3);
	exit;
}
?>

</body>
</html>