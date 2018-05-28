<div class="bar-title"><h2>Categories</h2></div>
<?php
	if(isset($_SESSION['user']))
	{
		if($_SESSION['user']['view'] == '9')
		{
?>
			<a href="#"><div class="sidebar-item admin-link">Edit Categories</div></a>
			<form action="<?=$_SERVER["REQUEST_URI"];?>" method="post">
				<table>
					<tr>
						<td><input type="text" name="add-category" /></td>
						<td><input type="image" src="img/plus.png" style="width:25px;"/></td>
					</tr>
				</table>
			</form>
<?php	}
	}
?>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>