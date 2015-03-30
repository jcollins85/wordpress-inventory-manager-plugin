<div class="wrap">

	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<style>
		.admin-content dl {
			font-size: 12px;
			font-weight: bold;
		}

		.category-breadcrumb {
			margin-bottom: 0px;
			margin-left: 20px;
		}

		.category-name {


		}

		.category-description {
			width: 96%;
			margin-left: 20px;
			margin-bottom: 10px;
			height: 90px;
			border: 1px solid grey;
		}

		.admin-content h1 {
			display: inline-block;
			margin-top: 8px;
			margin-left: 20px;
		}

		.delete-button {
			float: right;
			display: inline-block;
			height: 35px;
			margin-right: 40px;		
			cursor: pointer;	
		}

		.horizontal-bar {
			margin-left: 20px;
			margin-right: 41px;			
		}

		.sub-categories {
			width: 45%;
			height: auto;
			margin-left: 20px;
			display: inline-block;
			float: left;	

			border-right: solid thick grey;	
			min-height: 116px;	
		}

		.sub-categories a:hover {
			text-decoration: underline !important;
			color: black;
		}

		.sub-categories a:link {
			text-decoration: none;
			color: black;		
		}

		.sub-categories a:active {
			text-decoration: none;		
		}				

		.sub-categories a:visited {
			text-decoration: none;	
			color: black;	
		}

		.related-categories {
			width: 45%;
			margin-left: 20px;
			display: inline-block;
			height: auto;
			float: left;
		}

		.related-categories h2 {
			margin-bottom: 0px;			
		}

		.vertical-line {
			border-left: thick solid grey;
			display: inline-block;
			height: auto;
			min-height: 250px;
			float: left;
		}

		.add-button {
			height: 25px;
			display: inline-block;
		}

		.add-sub-category {
			display: block;
			margin-top: 20px;			
		}

		.add-related-category {
			display: block;
			margin-top: 20px;
		}

		.add-new-category-within-span {
			display: inline-block;
			margin-left: 10px;			
			vertical-align: 8px;
			font-weight: bold;			
		}

		.add-related-span {
			display: inline-block;
			margin-left: 10px;
			vertical-align: 8px;
			font-weight: bold;
		}

		.part-group-delete-button, .add-button, .add-related { cursor: pointer; }

		.parts {
			width: 100%;
			margin-left: 20px;
			display: inline-block;
			height: auto;						
		}

		.parts h2 {
			margin-bottom: 0px;
		}

		.parts h3 {
			margin-bottom: 3px;
		}		

		.clear {
			clear: both;
		} 

		.product-catalogue-select {
			border: 2px grey solid;			
			width: 506px;
			height: 40px;
			padding: 10px 10px 9px 5px;
		}

		.add-parts-group {
			display: block;
			margin-top: 20px;
			margin-left: 20px;			
		}

		.add-parts-group-span {
			display: inline-block;
			margin-left: 5px;
			vertical-align: 10px;
			font-weight: bold;
		}	

		.add-new-part-span {
			font-size: 10px;
			display: block;
			margin-top: 15px;
		}	

		.submit-link {
			background-color: transparent;
			text-decoration: underline;
			border: none !important;
			color: black !important;
			cursor: pointer;
			margin-right: -5px;
		}

		.category-name-header {
			display: block;
			margin-top: 5px;
			margin-bottom: 10px;
		}

		.edit-button {
			display: inline-block;
			height: 25px;
			width: 55px;
			position: absolute;
			margin-top: 3px;
			margin-left: 15px;
			border-radius: 12px;
			border: 2px solid black;
			cursor: pointer;
		}	

		.edit{			
			margin-left: 16px;
			margin-top: 4px;			
			position: absolute;
		}

		.part-group-delete-button {			
			display: inline-block;
			height: 15px;
			margin-left: 5px;	
			vertical-align: -3px;		
			cursor: pointer;
		}	

		.part-delete-button {			
			display: inline-block;
			height: 10px;
			margin-left: 5px;	
			vertical-align: -1px;		
			cursor: pointer;
		}	

		.related-category-delete-button	{
			display: inline-block;
			height: 10px;
			margin-left: 5px;	
			vertical-align: -1px;		
			cursor: pointer;
		}	
		
		.part-copy-button {			
			display: inline-block;
			height: 10px;
			margin-left: 5px;	
			vertical-align: -1px;		
			cursor: pointer;
		}	

		.part-group-title {
			display: inline-block;
		}

		.part-list {
			display: inline-block;
		}

		.no-parts {
			display: block;
		}		

		p.description { margin-left: 20px; }

		.part-container {
			display: block;
		}

		.order-input { width: 60px !important; margin-right: 10px; }

	</style>

	<div class="admin-content">
		<h3 class="breadcrumb"><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=unibond-main_menu">Product Catalogue</a>
			<? 
				$parent = $current_category;
				$bc = array();
				do 
				{ 
					$bc[] = array('id' => $parent->id, 'name' => $parent->name);
				} while ($parent = $parent->parent); 

				$bc = array_reverse($bc);
				array_shift($bc);
				
			?>
			<? foreach ($bc as $parent): ?>
				> <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=unibond-category-details&id=<?= $parent['id'] ?>"><?= stripslashes($parent['name']); ?></a>
			<? endforeach; ?>
			
		</h3>			

		<div class="category-name-header">
			<h1><a href="<?php bloginfo('url'); ?>/product-information/?m=unibond&c=FrontEnd&a=product_details&category-id=<?= $current_category->id ?>" target="_blank"><?= htmlentities($current_category->name) ?></a></h1>
			<div class="edit-button"><span class="edit">Edit</span></div>
			
			<img class="delete-button" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/delete-btn.png" />
		</div>

		<? if ($current_category->is_featured): ?>
			<p class="description"><b>This product is featured on the homepage</b></p>
		<? endif; ?>

		<p class="description"><?= $current_category->image_url ?></p>

		<p class="description"><?= $current_category->description ?></p>

		<hr class="horizontal-bar" />

		<div class="category-container">
			<div class="sub-categories">
				
				<h2>Sub-Categories</h2>
				<? if (count($part_group_list) == 0): ?>
					<dl>
						<?
						$a = 0;
						foreach ($category as $value) { 
							if ($value->parent_id == $current_category->id){ 
								$a++; ?>
								<dt><a href="admin.php?page=unibond-category-details&id=<?= $value->id ?>"><?= $value->name ?></a></dt> <?
							}
						}
						?>
					</dl>

						<? if($a == 0){ ?>
							<span>This category has no subcategories</span>
						<? } ?>			
					<div class="add-sub-category">
						
						<img class="add-button" id="add-subcategory" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/add-btn.png" />

						<span class="add-new-category-within-span">Add a new category within this category</span>
					</div>
				<? else: ?>
					<span>You may not add sub categories to a category with part groups.</span>
				<? endif; ?>
			</div>

			<!-- <div class="vertical-line"></div> -->			

			<div class="related-categories">
				<h2>Related Categories</h2>

				<ul>
				<? 
					$i = 0;
					foreach ($current_category->related as $related_category): ?>

					<li>
						<a href="admin.php?page=unibond-category-details&id=<?= $related_category->related_category_id ?>"><?= $related_category->category->name ?></a>
						<img class="related-category-delete-button" related_category_id="<?= $related_category->related_category_id ?>" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/delete-btn.png" />
					</li>
					<? $i++;	
				 endforeach; ?>
				</ul>
				<?
					if($i == 0){ ?>
						<span>This category has no related categories</span>
					<? }
				?>

				<div class="add-related-category">
					<img class="add-button" id="add-related" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/add-btn.png" />

					<span class="add-related-span">Add a related category</span>
				</div>

			</div>
		</div>
		<div class="clear"></div>

		<hr class="horizontal-bar" />
		<div class="clear"></div>
		<? if ($a == 0): ?>
			<div class="parts">
				<h2>Parts</h2>
					<?
						$x = 0;
						foreach ($part_group_list as $value) { 
							if ($value->category_id == $current_category->id){ ?>
								<h3 class="part-group-title"><a href="admin.php?page=unibond-part-group-details&id=<?= $value->id ?>"><?= $value->name ?></a></h3>
								<img class="part-group-delete-button" part_group_id="<?= $value->id ?>" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/delete-btn.png" />
								<? $x++; 

								$y = 0;

								foreach ($value->parts as $part)
								{
									?>
									<? if ($part->parent_id) continue; ?>
									<div class="part-container">
											<span class="part-list"><a href="admin.php?page=unibond-part-details&part-group-id=<?= $value->id ?>&part-id=<?= $part->id ?>&category-id=<?= $current_category->id ?>"><?= $part->number->value ?></a></span>
											<img class="part-delete-button" part_id="<?= $part->id ?>" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/delete-btn.png" /><img class="part-copy-button" part_id="<?= $part->id ?>" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/copy.png" />
									</div>

									<?
									foreach ($part->variants as $variant)
									{
										?>
										<div class="part-container">
											<span class="part-list">&nbsp;&nbsp;Variant <?= $variant->data[0]->field->name ?> - <?= $variant->data[1]->value ?></span>
											<img class="part-delete-button" part_id="<?= $variant->id ?>" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/delete-btn.png" />
										</div>
										<?
									}

									?>


									<?
									$y++; 
								}
								

								
									if($y == 0){ ?>	
										<span class="no-parts">This group has no parts</span>	
									<? }
								?>

								<form action="admin.php?page=unibond-create-part-link" method="post">
									<input type="hidden" name="category-id" value="<?= $current_category->id; ?>" />								
									<input type="hidden" name="part-group-id" value="<?= $value->id; ?>" />	
									<span class="add-new-part-span" id="add-part"><input type="submit" class="submit-link" value="Add a new part"> to this group</span>
								</form>
								 <?
							}
						}
						
						if($x == 0){ ?>
							<span>This category has no part groups</span>	
						<? } ?>				
				
			</div>

			<hr class="horizontal-bar" />

			<div class="clear"></div>

			<div class="add-parts-group">
				<form action="admin.php?page=unibond-create-part-group-link" id="create-part-group-form" method="post">
					<input type="hidden" name="category-id" value="<?= $current_category->id; ?>" />		
					<input type="hidden" name="category-name" value="<?= $current_category->name; ?>" />		
					<input class="add-button" id="add-parts-group" type="image" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/add-btn.png" alt="Submit button">
					<span class="add-parts-group-span">Add a new part group</span>
				</form>

				
			</div>
		<? else: ?>
			<div class="parts">
				<h2>Parts</h2>
				<span>To add parts to this category it must not have any subcategories.</span>
			</div>
		<? endif; ?>
	</div>

	<div id="dialog-confirm">            
    </div>

    <div id="dialog-add-subcategory">            
    </div>
    
    <div id="dialog-add-related">            
    </div>

     <div id="dialog-edit-category">            
    </div>

</div>

<?	

	function display_dropdown($category, $depth)
	{
		if ($category)
		{
				
				echo '<option value="' . $category->id . '"> ' . str_repeat("&nbsp;&nbsp;&nbsp;", $depth) . mysql_real_escape_string($category->name) . '</option>'; 
		}

		if (!$category)
		{
			$categories = Category::find_all(array(), "parent_id is null or parent_id = 0"); 
		}
		else 
		{
			$categories = Category::find_all(array(), "parent_id = '" . me($category->id) . "'");
		}

		foreach ($categories as $category)
		{
			display_dropdown($category, $depth + 1);
		} 
	}

?>


	<script>
			$('.delete-button').bind('click', function(e) { 

				e.preventDefault();
		
			$( "#dialog-confirm" ).html('<h1 class="ui-h1-center">Are you sure you want to delete this item?</h1><form action="admin.php?page=unibond-delete-category" id="delete-category-form" method="post"><input type="hidden" name="category-id" value="<?= $current_category->id; ?>" /></form>').dialog({
				resizable: false,
				height:200,
				width: 485,				
				modal: true,
				dialogClass: 'wp-dialog',
				buttons: {
					Yes: function() {
						$('form#delete-category-form').submit();
					},
					No: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});

			$('#add-subcategory').bind('click', function(e) { 

				e.preventDefault();		

			$( "#dialog-add-subcategory" ).html('<h1>Create New Sub Category</h1><form action="admin.php?page=unibond-create-subcategory" id="new-subcategory-form" method="post"><input type="text" placeholder="Category Name" name="category[name]" /><br/><br/><textarea name="category[description]" placeholder="Description" rows="5" cols="77"></textarea><input type="hidden" name="category[parent_id]" value="<?= $current_category->id; ?>"></form>').dialog({
				resizable: false,
				height:300,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {
						$('form#new-subcategory-form').submit();
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					}					
				}
			});

		    $(function(){
		      $(':input[placeholder]').placeholder();
		    });	

		});		

			$('#add-related').bind('click', function(e) { 

				e.preventDefault();			



				$( "#dialog-add-related" ).html('<h1>Add A Related Category</h1><form action="admin.php?page=unibond-create-related-category" id="create-related-category-form" method="post"><select class="product-catalogue-select" name="related_category[related_category_id]"><? display_dropdown(null, 0); ?></select><br/><br/><textarea name="related_category[description]" placeholder="Relationship Description" rows="5" cols="77"></textarea><input type="hidden" name="related_category[category_id]" value="<?= $current_category->id; ?>"></form>').dialog({
					resizable: false,
					height:300,
					width: 500,								
					modal: true,
					buttons: {
						"Save": function() {
							$('form#create-related-category-form').submit();
						},
						"Cancel": function() {
							$( this ).dialog( "close" );
						}					
					}
				});
			});

		$('.edit').bind('click', function(e) { 

			e.preventDefault();

			<? 
				if ($a == 0)
					$featured_code = '<input class="check" type="checkbox" name="is_featured" value="1" ' . ($current_category->is_featured == 1 ? 'checked="checked"' : '') . '"><label for="is_featured">Featured on Homepage</label>';
				else
					$featured_code = '<input type="hidden" name="is_featured" value="0"/>';
			?>

			description = '<?= mysql_real_escape_string($current_category->description); ?>';

			$( "#dialog-edit-category" ).html('<h1>Edit Category</h1><form action="admin.php?page=unibond-edit-category" id="edit-category-form" method="post"><input type="hidden" name="category_id" value="<?= $current_category->id ?>"><input type="text" value="<?= htmlentities($current_category->name) ?>" placeholder="Category Name" name="category_name" /><br/><br/><textarea name="category_desc" placeholder="Category Description" rows="5" cols="75">' + description + '</textarea><br/><br/><input type="text" value="<?= htmlentities($current_category->image_url) ?>" placeholder="Category Image" name="category_image" /><br/><br/><input type="text" class="order-input" value="<?= $current_category->order ?>" placeholder="Order" name="category_order" /><?= $featured_code; ?></form>').dialog({
				resizable: false,
				height:320,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {
						$('form#edit-category-form').submit();
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					}					
				}
			});

		    $(function(){
		      $(':input[placeholder]').placeholder();
		    });	
			
		});	

			$('.part-group-delete-button').bind('click', function(e) { 

				e.preventDefault();
		
			$( "#dialog-confirm" ).html('<h1 class="ui-h1-center">Are you sure you want to delete this part group?</h1><form action="admin.php?page=unibond-delete-part-group" id="delete-part-group-form" method="post"><input type="hidden" name="category_id" value="<?= $current_category->id ?>"><input type="hidden" name="part-group-id" value="'+ $(this).attr('part_group_id') + '" /></form>').dialog({
				resizable: false,
				height:200,
				width: 550,				
				modal: true,
				buttons: {
					Yes: function() {
						$('form#delete-part-group-form').submit();
					},
					No: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});

			$('.part-delete-button').bind('click', function(e) { 

				e.preventDefault();
		
			$( "#dialog-confirm" ).html('<h1 class="ui-h1-center">Are you sure you want to delete this part?</h1><form action="admin.php?page=unibond-delete-part" id="delete-part-form" method="post"><input type="hidden" name="category_id" value="<?= $current_category->id ?>"><input type="hidden" name="part-id" value="'+ $(this).attr('part_id') + '" /></form>').dialog({
				resizable: false,
				height:200,
				width: 480,				
				modal: true,
				buttons: {
					Yes: function() {
						$('form#delete-part-form').submit();
					},
					No: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});	

			$('.related-category-delete-button').bind('click', function(e) { 

				e.preventDefault();
		
			$( "#dialog-confirm" ).html('<h1 class="ui-h1-center">Are you sure you want to delete the relation?</h1><form action="admin.php?page=unibond-delete-related-category" id="delete-related-category-form" method="post"><input type="hidden" name="category_id" value="<?= $current_category->id ?>"><input type="hidden" name="related_category_id" value="'+ $(this).attr('related_category_id') + '" /></form>').dialog({
				resizable: false,
				height:200,
				width: 550,				
				modal: true,
				buttons: {
					Yes: function() {
						$('form#delete-related-category-form').submit();
					},
					No: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});

		$('.part-copy-button').bind('click', function(e) { 

			e.preventDefault();
		
			document.location = 'admin.php?page=unibond-create-part-variant&variantof=' + $(this).attr('part_id');
		});					

	</script>
