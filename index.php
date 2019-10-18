<?php
$generation_start = microtime(TRUE);

require_once "index.ctrl.php";

require_once "html-head.inc.php";
require_once "header.inc.php";


if(isset($_SESSION["user"])) {
	?>
<fieldset>
	<legend><?= L::admin_actions_legend ?></legend>


	<table class="no_border">
<!-- new directory -->
		<tr> <form action="actions/mkdir.post.php" method="post">
			<td><label for="new_dir"><?= L::admin_new_dir_label ?> :</label></td>
			<td><input type="text" name="new_dir" size="100" maxlength="256"/><input type="hidden" name="subdir" value="<?=$subdir?>"/></td>
			<td><button type="submit"><?= L::admin_create_button ?></button></td>
		</form> </tr>
		
<!-- new symlink -->
		<tr> <form action="actions/symlink.post.php" method="post">
			<td><label for="new_dir"><?= L::admin_new_symlink_label ?> :</label></td>
			<td><input type="text" name="destination" size="100" maxlength="2048"/><input type="hidden" name="subdir" value="<?=$subdir?>"/></td>
			<td><button type="submit"><?= L::admin_create_button ?></button></td>
		</form> </tr>
	</table>
	<br/>

<!-- download form -->
	<form action="actions/download.post.php" method="post">
		<table>
			<tr><td><?= L::admin_file_url_label ?></td> <td><input type="text" name="url" size="100" maxlength="2048"></td> <td rowspan="2"><button type="submit"><?= L::admin_download_button ?></button></td> </tr>
			<tr><td><?= L::admin_referer_label ?></td> <td><input type="text" name="page" size="100" maxlength="2048"></td></tr>
		</table>
		<input type="hidden" name="subdir" value="<?=$subdir?>"/>
	</form>
</fieldset>
<br/>
	<?php
}


// breadcrumb
echo implode(" / ", $breads);
echo "<br/><br/>";


// display
?>
<table>
	<tr>
<?php
$current_url = new Url();
$fields = array(
	"icon" => '',
	"name" => L::table_name_header,
	"last_modified" => L::table_last_modified_header,
	"size" => L::table_size_header
);
foreach ($fields as $field_name => $field_label) {
	$url = clone $current_url;
	$url->setQueryParameter("sort_field", $field_name);
	if( $sort_field == $field_name  &&  $sort_order == "ASC" )
		$url->setQueryParameter("sort_order", "DESC");
	else
		$url->setQueryParameter("sort_order", "ASC");
	$u = $url->getFullUrl();
	echo '		<th><a href="'.$u.'">'.$field_label.'</a></th>';
	
}
if(isset($_SESSION["user"])) {
	?>	<th>&nbsp;</th><?php
}
?>
	</tr>
	
	
<?php
foreach ($files_formated_data as $file_formated_data) {
	?>
	<tr>
		<td><?=$file_formated_data["icon"]?></td>
		<td><?=$file_formated_data["name"]?>
	<?php
	if(isset($_SESSION["user"])) {
		if(!empty($file_formated_data["link_destination"])) {
			?>
			<br/>
			<?=$file_formated_data["link_destination"]?>
			<?php
		}
	}
	?>
			</td>
			<td><?=$file_formated_data["last_modified"]?></td>
			<td><?=$file_formated_data["size"]?></td>
	<?php
	if(isset($_SESSION["user"])) {
		?>
			<td><?=$file_formated_data["actions"]?></td>
		<?php
	}
	?>
	</tr>
	<?php
}
?>



<tr>
<?php
foreach ($fields as $field_name => $field_label) {
	?>
	<th>
	<?php
	if($field_name === 'name') {
		echo L::table_files_total;
	}
	if($field_name === 'size') {
		$sum_of_files_size = sizeToString($sum_of_files_size);
		echo $sum_of_files_size;
	}
	?>
	</th>
	<?php
	
}
if(isset($_SESSION["user"])) {
	?>	<th>&nbsp;</th><?php
}
?>
	</tr>

</table>


<div id="dialog" title="<?=L::admin_confirm_title ?>">
	<p><?= L::admin_delete_confirm ?></p>
</div>


<?php
require_once "footer.inc.php";
require_once "html-foot.inc.php";
