<style>
	.admin-sidebar {
		height: 100%;
		width: 325px;		
		border-right: 1px solid black;
		display: inline-block;	
		min-height: 1000px;	
		padding-bottom: 20px;
	}	

	.admin-sidebar h2 {
		margin-left: 20px;
		padding-bottom: 10px;
	}

	.admin-sidebar dl {
		margin-left: 35px;
		font-size: 12px;
		font-weight: bold;		
	}

	.admin-sidebar a { display: block; }

	.order { color: #CCCCCC; }

</style>

<div class="admin-sidebar">
	<h2>Products & Categories</h2>


	<? display_categories(null, 0); ?>

	<!--
	<dl>
		<? foreach ($category as $value) {
			if($value->parent_id == null) { ?>
				<dt><a href="admin.php?page=unibond-category-details&id=<?= $value->id; ?>"><?= $value->name; ?></a></dt><?
			}
		 } ?>
	</dl>
	-->

</div>

<?

	function display_categories($category, $depth)
	{
		if ($category->id == 244 || $category->id == 245)
		{
			echo '<span style="margin-left: 20px; font-size: 17px;">' . $category->name . '</span>';
		}
		else 
		{
			echo '<a class="depth-'. $depth .'" style="margin-left: ' . (20 * $depth) . 'px; display: block" href="admin.php?page=unibond-category-details&id=' . $category->id . '">' . stripslashes($category->name) . '</a> &nbsp;&nbsp; <span class=order>' . $category->order . '</span>';
		}	

		if (!$category)
		{
			$categories = Category::find_all(array(), "parent_id is null or parent_id = 0", '`order`'); 
		}
		else 
		{
			$categories = Category::find_all(array(), "parent_id = '" . me($category->id) . "'", '`order`');
		}

		foreach ($categories as $category)
		{
			display_categories($category, $depth + 1);
		} 
	}

?>