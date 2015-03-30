<div class="wrap">

	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<style>
		.admin-content h1 {
			display: inline-block;			
			margin-left: 20px;
		}	

		.part-details {
			margin-left: 20px;
		}

		.part-attributes {
			margin-left: 20px;
		}

		.part-fields {
			margin-left: 10px;
		}

		.horizontal-bar {
			margin-left: 20px;
			margin-right: 41px;			
		}

		.add-new-attribute-span {
			font-size: 10px;
		}

		select {
			height: 40px;
			border: 2px solid grey;
			padding: 10px 10px 9px 5px;
			width: 500px;				
		}

		.part-details input {			
			height: 40px;
			border: 2px solid grey;
			padding-left: 5px;
			width: 500px;			
		}

		.part-fields input {			
			height: 40px;
			border: 2px solid grey;			
			width: 500px;
			display: inline-block;
		}

		.save {
			float: right;
			cursor: pointer;
			margin-right: 180px;
		}

		.field-name-span {
			display: inline-block;
			width: 105px;
		}

	</style>

	<div class="admin-content">		

		<h3 class="breadcrumb">Product Catalogue
			<? 
				
				$pg = PartGroup::find(array(), array('id' => $_REQUEST['part-group-id']));
				// if ($_POST['part-group-id:'])
				// 	$value = Category::find(array(), array('id' => $_POST["category-id"]));
				// else
					$parent = $pg->category;
					 
				// $current_part_group->category;
				$bc = array();
				do 
				{ 
					$bc[] = array('id' => $parent->id, 'name' => $parent->parent->name);
				} while ($parent = $parent->parent); 

				$bc = array_reverse($bc);
				array_shift($bc);
				
			?>
			<? foreach ($bc as $parent): ?>
				> <a href="/wp-admin/admin.php?page=unibond-category-details&id=<?= $parent['id'] ?>"><?= $parent['name'] ?></a>
			<? endforeach; ?> > <?= $pg->name ?>
		</h3>

		<? if (!$_REQUEST['variantof']): ?>
			<h1><? if ($_GET['part-id'] != null) { echo "Edit"; } else { echo "Add"; } ?>  Part</h1>		
		<? else: ?>
			<h1> Add Part Variant Part</h1>		
		<? endif; ?>

		<?
		if ($_GET['part-id'] != null) { ?>
			<form action="admin.php?page=unibond-update-part" method="post">
				<input type="hidden" name="part-id" value="<?= $_GET["part-id"]; ?>" />
				<input type="hidden" name="part-group-id" value="<?= $_GET["part-group-id"]; ?>" />
				<input type="hidden" name="category-id" value="<?= $_GET["category-id"]; ?>" />
		<? } else { ?>
			<form action="admin.php?page=unibond-create-part" method="post">
		<? }
		?>
			<input type="hidden" name="part[category_id]" value="<?= $_POST["category-id"]; ?>" />
			<input type="hidden" name="part[part_group_id]" value="<?= $_POST["part-group-id"]; ?>" />

			<div class="part-details">
				<h2>Part Details</h2>		

				<!--
				<select class="product-catalogue-select" name="" onchange="updatePartGroup()">
					<? if ($_GET['category-id'] == null) {
							foreach ($category as $value) { ?>
								<option value="<?= $value->id ?>"><?= $value->name ?></option>
							<? } ?>
					<? } 
					else {
						foreach ($category as $value) {
							if ($value->id == $_GET['category-id'] || $_POST['category-id']){ ?>
								<option value="<?= $value->id ?>"><?= $value->name ?></option>
							<? }
						}
					 }?>								
				</select>

				<br /><br />

				
				<select id="part-group-dropdown">
					<option value="Product Type">Product Type</option>
					<option value="Product Type">Product Type</option>
					<option value="Product Type">Product Type</option>	
				</select>	
				
				<br /><br />

				-->

				<? 				
				if ($_GET['part-id'] != null) { 
					foreach ($part_data as $data){
						if ($data->field_type_id == '1'){ ?>
							<input type="text" placeholder="Part No." value="<?= $data->value ?>" name="field_data[1]" /><span class="required">*</span><br /><br />
						<? }
					}									
					
					foreach ($part_data as $data){
						if ($data->field_type_id == '2'){ ?>						
							<textarea name="field_data[2]" placeholder="Description" rows="5" cols="100" /><?= $data->value ?></textarea>
						<? }
					} ?>					
										
				<? }
				else { ?>
					<input type="text" placeholder="Part No." name="field_data[1]" /><span class="required">*</span>			

					<br /><br />

					<textarea name="field_data[2]" placeholder="Description" rows="5" cols="100" /></textarea>										
					
				<? } ?>

			</div>

			<hr class="horizontal-bar" />

			<div class="part-attributes">

				<h2>Part Attributes</h2>

				<div class="part-fields">					
					<? foreach ($current_part_group->fields as $value): ?>
						<? if ($value->field_type_id == 1 || $value->field_type_id == 2) continue; ?>
						<span class="field-name-span"><?= $value->field->name; ?></span> 

						<? 

						$found = false;
						foreach ($part_data as $part)
						{
							if ($part->field_type_id == $value->field_type_id)
							{
								$found = true;
								$display_value = $part->value;
							}
						}

						if (!$found)
							$display_value = '';


						?>

						<input type="text" class="" value="<?= $display_value; ?>" name="field_data[<?= $value->field->id; ?>]" />
						<br /><br />
					<? endforeach ?>
							
					<!-- <span class="add-new-attribute-span" id="add-attribute"><a href="" class="underline">Add a new attribute</a> to this part group</span> --> <br /><br />

				</div>
				<input type="submit" class="save" value="Save" />
			</div>
		</form>

	</div>

	<div id="dialog-add-attribute">
	</div>

</div>

<script>
			$('#add-attribute').bind('click', function(e) { 

				e.preventDefault();
			
			$( "#dialog-add-attribute" ).html('<h1>Add A New Attribute</h1><form action="admin.php?page=unibond-create-attribute" id="add-attribute-form" method="post"><select class="product-catalogue-select" name="field_types[name]"><option>Select Attribute Name</option><? foreach ($attribute_list as $value) { ?><option value="<?= $value->id; ?>"><?= $value->name; ?></option><? } ?></select><br/><br/>OR<br/><br/><textarea name="field_types[name]" placeholder="Attribute Name" rows="5" cols="75"></textarea></form>').dialog({
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

		function updatePartGroup(){


		}
			

</script>
