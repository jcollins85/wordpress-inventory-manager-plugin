<div class="wrap">

	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<style>
		.admin-content {
			display: inline-block;
			width: 1021px;
			height: auto;
			position: absolute;
			border: 2px solid black;
			min-height: 1000px;
		}

		.horizontal-bar {
			margin-left: 20px;
			margin-right: 41px;			
		}

		.breadcrumb {
			margin-bottom: 0px;
			margin-left: 20px;
		}

		.delete-button {
			float: right;
			display: inline-block;
			height: 35px;
			margin-right: 50px;
			margin-top: 7px;
		}

		.description {
			width: 960px;
			margin-left: 20px;
			margin-bottom: 10px;
			height: 90px;
			border: 1px solid grey;
		}	

		.admin-content h1 {
			display: inline-block;
			margin-top: 0px;
			margin-left: 20px;
		}

		.sub-categories {
			width: 485px;
			height: auto;
			margin-left: 20px;
			display: inline-block;
			float: left;
		}		

		.vertical-line {
			border-left: thick solid grey;
			display: inline-block;
			height: auto;
			min-height: 240px;
			float: left;
		}

		.related-categories {
			width: 485px;
			margin-left: 20px;
			display: inline-block;
			height: auto;
			float: left;
		}

		h2 {
			margin-bottom: 0px;			
		}		

		.add-sub-category{
			margin-top: 15px;
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

		.add-button {
			height: 25px;
			display: inline-block;
		}

		.add-related-category {
			display: block;
			margin-top: 20px;
		}	

		.add-new-parts-group {
			display: block;
			margin-top: 20px;
			margin-left: 20px;
		}

		.add-new-attribute-span {
			font-size: 10px;
			display: block;
		}	

		.save {
			float: right;
			margin-right: 180px;
			margin-top: 85px;
		}	

		.parts {
			width: 100%;
			margin-left: 20px;
			display: inline-block;
			height: auto;						
		}	

		.table-title {
			background-color: grey;
		}	

		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;		
			line-height: 175%;
			padding-left: 10px;
			text-align: center;
		}		

		.parts-group-table table {
			width: 100%;
		}

		.parts-group-table {			
			margin-right: 60px;
			margin-bottom: 15px;
		}		

		.product-catalogue-select {
			border: 2px grey solid;			
			width: 506px;
			height: 40px;
			padding: 10px 10px 9px 5px;
		}				

	</style>

	<div class="admin-content">
		<h3 class="breadcrumb">Product Catalogue > LED Stop/Turn/Tail/Back Up Lamps > Oval LED Lamps ></h3>

		<h1>10 Diodes Series</h1>

		<img class="delete-button" src="../../assets/delete-btn.png" />

		<textarea class="description" name="description" rows="5" cols="100">Description</textarea>

		<hr class="horizontal-bar" />

		<div class="sub-categories">
			<h2>Sub-Categories</h2>

			<span>This category has no sub-categories</span>										

			<div class="add-sub-category">
				<img class="add-button" id="add-subcategory" src="../../assets/add-btn.png" />

				<span class="add-new-category-within-span">Add a new category within this category</span>
			</div>

		</div>

		<div class="vertical-line"></div>

		<div class="related-categories">
			<h2>Related Categories</h2>
			<span>This category has no related categories</span>

			<div class="add-related-category">
				<img class="add-button" id="add-related" src="../../assets/add-btn.png" />

				<span class="add-related-span">Add a related category</span>
			</div>

		</div>	

		<div class="clear"></div>

		<hr class="horizontal-bar" />

		<div class="clear"></div>

		<div class="parts">
			<h2>Parts</h2>

			<h3>Default Parts Group</h3>

			<div class="parts-group-table">
				<table>
					<tr class="table-title">
						<td>Part No.</td>
						<td>Lens Colour</td>
						<td>Diodes</td>
						<td>Function</td>
						<td>SAE</td>
						<td>Amp Draw</td>
						<td>Package</td>
					</tr>

					<tr>
						<td>LED2238-10A</td>
						<td>Amber</td>
						<td>10</td>
						<td>Signal/Park</td>
						<td>16P</td>
						<td>0.03/0.21</td>
						<td>Bulk</td>
					</tr>
				</table>
			</div>

			<span class="add-new-attribute-span"><a href="" class="underline">Add a new part</a> to this category</span>	

			<h3>Flush Mount Lamps with Flanges Installed</h3>					

			<div class="parts-group-table">			
				<table>
					<tr class="table-title">
						<td>Part No.</td>
						<td>Lens Colour</td>
						<td>Diodes</td>
					</tr>

					<tr>
						<td>LED2238-10A</td>
						<td>Amber</td>
						<td>10</td>
					</tr>		

				</table>
			</div>

			<span class="add-new-attribute-span"><a href="" class="underline" >Add a new part</a> to this category</span>				

		</div>

		<hr class="horizontal-bar">

		<div class="add-new-parts-group">
			<img class="add-button" src="../../assets/add-btn.png" />

			<span class="add-related-span">Add a new parts group</span>	
		</div>

		<input type="submit" class="save" value="Save" />

	</div>

	<div id="dialog-confirm">
	</div>

    <div id="dialog-add-subcategory">            
    </div>
    
    <div id="dialog-add-related">            
    </div>	

	<script>
			$('.delete-button').bind('click', function(e) { 

				e.preventDefault();
		
			$( "#dialog-confirm" ).html('<h1>Are you sure you want to delete this item?</h1>').dialog({
				resizable: false,
				height:200,
				width: 650,				
				modal: true,
				buttons: {
					Yes: function() {
						$( this ).dialog( "close" );
					},
					No: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});

			$('#add-subcategory').bind('click', function(e) { 

				e.preventDefault();		

			$( "#dialog-add-subcategory" ).html('<h1>Create New Sub Category</h1><form action="category.php" id="new-sub-category-form" method="post"><input type="text" value="Category Name" name=sub-category-name /><br/><br/><textarea name="sub-category-description" rows="5" cols="59">Description</textarea></form>').dialog({
				resizable: false,
				height:300,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {
						$('form#new-category-form').submit();
					}
				}
			});
		});		

			$('#add-related').bind('click', function(e) { 

				e.preventDefault();			

			$( "#dialog-add-related" ).html('<h1>Add A Related Category</h1><form action="category.php" id="add-related-category-form" method="post"><select class="product-catalogue-select"><option value="Part Group Type">Product Catalogue</option><option value="Part Group Type">Product Catalogue</option><option value="Part Group Type">Product Catalogue</option></select><br/><br/><textarea name="relationship-description" rows="5" cols="59">Relationship Description</textarea></form>').dialog({
				resizable: false,
				height:300,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {
						$('form#new-category-form').submit();
					}
				}
			});
		});


	</script>	