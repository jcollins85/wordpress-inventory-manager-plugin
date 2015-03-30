<div class="wrap">

	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<style>
		.breadcrumb {
		margin-bottom: 0px;
		margin-left: 20px;
		}

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
				
				$pg = Part::find(array(), array('id' => $_REQUEST['variantof']));

				$parent = $pg->group->category;
				// if ($_POST['part-group-id:'])
				// 	$value = Category::find(array(), array('id' => $_POST["category-id"]));
				// else
					// $parent = $pg->category;
					 
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
				> <a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=unibond-category-details&id=<?= $parent['id'] ?>"><?= $parent['name'] ?></a>
			<? endforeach; ?> > <?= $pg->group->name ?>
		</h3>

		<h1> Add Part Variant Part</h1>		

			<form action="admin.php?page=unibond-insert-part-variant" method="post">
		
			<input type="hidden" name="part[category_id]" value="<?= $_POST["category-id"]; ?>" />
			<input type="hidden" name="part[part_group_id]" value="<?= $_POST["part-group-id"]; ?>" />

			<div class="part-details">
				<p>You are adding a variant to part no. <b><?= $pg->data[0]->value ?></b>. You need only enter values that differ for this variant.</p>

				
			</div>

			<hr class="horizontal-bar" />

			<div class="part-attributes">

				<h2>Part Attributes</h2>

				<div class="part-fields">					
					<? foreach ($pg->group->fields as $value) {

							foreach ($pg->data as $data) {
								if(1 == 0){ ?>

								<?}
								elseif($data->field_type_id == $value->field->id){ ?>
									<span class="field-name-span"><?= $value->field->name; ?></span> <input type="text" class="" placeholder="<?= $data->value; ?>" name="field_data[<?= $value->field->id; ?>]" /><br /><br />
								<? }								
							}							
				
					} ?>				

					<!-- <span class="add-new-attribute-span" id="add-attribute"><a href="" class="underline">Add a new attribute</a> to this part group</span> --> <br /><br />

				</div>
				<input type="hidden" name="variantof" value="<?= $_REQUEST['variantof'] ?>">
				<input type="submit" class="save" value="Save" />
			</div>
		</form>

	</div>

	<div id="dialog-add-attribute">
	</div>

</div>
