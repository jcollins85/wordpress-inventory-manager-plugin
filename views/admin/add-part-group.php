<div class="wrap">

	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<style>
		.admin-content h1 {	margin-left: 20px; }
		.breadcrumb { margin-bottom: 0px; margin-left: 20px; }	
		select { height: 40px; border: 2px solid grey; padding: 10px 10px 9px 5px; width: 500px; }
		.part-group-details { margin-left: 20px; }
		.part-group-details input {	height: 40px; border: 2px solid grey; padding-left: 5px; width: 500px; }	
		.part-attributes { margin-left: 20px; }
		.horizontal-bar { margin-left: 20px; margin-right: 41px; }
		.add-new-attribute-span { font-size: 10px; display: block; }
		.part-attributes input { margin-right: 5px;	margin-top: 5px; vertical-align: text-top; height: 24px;	}
		.part-attributes input { margin-right: 5px;	margin-top: 0px; vertical-align: text-top; height: 21px;	}\9; /* IE8 and below - red border */
		.related-part-groups { margin-left: 20px; }
		.add-button { height: 25px;	display: inline-block; }
		.add-related-part-group { display: inline-block; margin-left: 10px; margin-top: 25px; vertical-align: 8px; font-weight: bold; }	
		.save { float: right; margin-right: 180px; margin-top: 85px;}			
		.part-delete-button { width: 12px; }
		.association-delete-button { width: 12px; }		
		.order { float: right; margin-right: 75% !important; }
		.attribute-holder { display: block; height: 25px; width: 100%; }
		.related-part-groups { margin-left: 20px; }
	</style>

	<div class="admin-content">

		<h3 class="breadcrumb">Product Catalogue
			<? 
				
				if ($_POST['category-id'])
					$parent = Category::find(array(), array('id' => $_POST["category-id"]));
				else
					$parent = $current_part_group->category;
				$bc = array();
				do 
				{ 
					$bc[] = array('id' => $parent->id, 'name' => $parent->parent->name);
				} while ($parent = $parent->parent); 

				$bc = array_reverse($bc);
				array_shift($bc);
				
			?>
			<? foreach ($bc as $parent): ?>
				> <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=unibond-category-details&id=<?= $parent['id'] ?>"><?= $parent['name'] ?></a>
			<? endforeach; ?>
		</h3>

		<h1><? if ($_GET['id'] != null) { echo "Edit"; } else { echo "Add"; } ?></h1>
		
                <? if ($_GET['id'] != null) { ?>
                    <form action="admin.php?page=unibond-update-part-group" method="post">
                    <input type="hidden" name="part_group_id" value="<?= $_GET['id']; ?>" />
                   
                   <? } else { ?>
                        <form action="admin.php?page=unibond-create-part-group" method="post">                      
                        <input type="hidden" name="part_group[category_id]" value="<?= $_POST["category-id"]; ?>" />	
                   <? } ?>		
			
			<div class="part-group-details">
				<h2>Part Group Details</h2>		

				<!--
				<select>
					<option value="Part Group Type">Part Group Type</option>
					<option value="Part Group Type">Part Group Type</option>
					<option value="Part Group Type">Part Group Type</option>
				</select>	
				-->				

				<? if ($_GET['id'] != null) { ?>
					<input type="text" name="part_group_name" value="<?= $current_part_group->name ?>"  /><span class="required">*</span>
                                        <br /><br />
                                        <textarea name="part_group_description" rows="5" cols="100"  /><?= $current_part_group->description ?> </textarea>
				<? } 

				else { ?>				
					<input type="text" name="part_group[name]" placeholder="Part Group Name" /><span class="required">*</span>
                                        <br /><br />
                                        <textarea name="part_group[description]" rows="5" cols="100" placeholder="Description" /></textarea>
				<? } ?>

			</div>

			<hr class="horizontal-bar" />

			<div class="part-attributes">
				<h2>Part Attributes</h2>	
				
					<? foreach ($attribute_list as $value) { 
						$x = 0;
						if ($value->name == 'Part Number' | $value->name == 'Part Description') {

						} 
						else { 
							foreach ($part_group_fields as $group_field) {
									if ($group_field->part_group_id == $_GET['id'] && $group_field->field_type_id == $value->id){ ?>
										<div class="attribute-holder"><input type="checkbox" checked="checked"  name="part_group_fields[]" value="<?= $value->id; ?>"><label for="<?= $value->name; ?>"><?= $value->name; ?></label> <input type="text" placeholder="Order"  class="order" name="part_group_fields_order[]" value="<?= $group_field->order ?>"></div>
										 <? $x = 1;									
										}
										
								}
							if ($x == 0)	{ ?>
								<div class="attribute-holder"><input type="checkbox"  name="part_group_fields[]" value="<?= $value->id; ?>"><label for="<?= $value->name; ?>"><?= $value->name; ?></label></div>
							<? }

							}							 					
					}?>

					<? if ($_GET['id'] == null) { ?>
						<input type="hidden" name="hidden_part_number" value="" />	
						<input type="hidden" name="hidden_part_desc" value="" />
					<? } ?>

				<span class="add-new-attribute-span" id="add-attribute"><a href="" class="underline">Add a new attribute</a> to this part group</span>	

			</div>		

			<? if ($_GET['id'] != null): ?>
				<hr class="horizontal-bar" />

				<div class="related-part-groups">
					<h2>Associated Part Groups</h2>	
					<div class="part-container">
					<? foreach ($current_part_group->related_groups as $related_part_group): ?>

						<? 

							$parent = Category::find(array(), array('id' => $related_part_group->partgroup->category_id));

							$bc = array();
							do 
							{ 
								$bc[] = $parent->parent->name;
							} while ($parent = $parent->parent); 

						?>
						
							<span class="part-list"><a href="admin.php?page=unibond-part-group-details&amp;id=<?= $related_part_group->relatedto_parts_group_id ?>"><?= implode(" > ", $bc) . ' ' . $related_part_group->partgroup->name ?></a></span>
							<a href="admin.php?page=unibond-delete-related-part-group&id=<?= $related_part_group->id ?>"><img class="association-delete-button" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/delete-btn.png">
						</a><br />				
					<? endforeach ?>
					</div>
										
					<img class="add-button" id="add-related" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/add-btn.png" />

					<span class="add-related-part-group">Add an associated part group</span>									

				</div>
			<? endif; ?>

			<input type="submit" class="save" value="Done" />

		</form>

	</div>


	<div id="dialog-add-attribute">
	</div>

	<div id="dialog-add-related">
	</div>

</div>



<script>
			$('#add-attribute').bind('click', function(e) { 

				e.preventDefault();
			
			$( "#dialog-add-attribute" ).html('<h1>Add A New Attribute</h1><form action="admin.php?page=unibond-create-attribute" id="add-attribute-form" method="post"><select class="product-catalogue-select" name="field_types[name]"><option>Select Attribute Name</option><? foreach ($attribute_list as $value) { ?><option value="<?= $value->id; ?>"><?= $value->name; ?></option><? } ?></select><br/><br/>OR<br/><br/><textarea name="field_types[name]" placeholder="Attribute Name" rows="5" cols="77"></textarea></form>').dialog({
				resizable: false,
				height:300,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {

						$.post('admin.php?page=unibond-create-attribute', $('#add-attribute-form').serialize(), function() {

							 location.reload();

						});

						$( this ).dialog( "close" );

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

				<? 
				
					$part_groups = PartGroup::find_all(array());

					foreach ($part_groups as $pg) 
					{
						$parent = $pg->category;
						$bc = array();
						do 
						{ 
							$bc[] = $parent->parent->name;
						} while ($parent = $parent->parent); 

						$related_select_data .= '<option value="' . $pg->id . '">' . implode(" > ", $bc) . ' ' . $pg->name . '</option>'; 


					};

				?>

			$( "#dialog-add-related" ).html('<h1>Add an associated part group</h1><form action="admin.php?page=unibond-create-related-part-group" id="create-related-part-group-form" method="post"><select class="product-catalogue-select" name="related_part_group[relatedto_parts_group_id]"><?= $related_select_data ?></select><br/><br/><input type="hidden" name="related_part_group[related_parts_group_id]" value="<?= $current_part_group->id; ?>"></form>').dialog({
				resizable: false,
				height:300,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {
						$('form#create-related-part-group-form').submit();
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

</script>