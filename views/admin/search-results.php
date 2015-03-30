<div class="wrap">

	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<style>

		.admin-content h1 {
			display: inline-block;			
			margin-left: 20px;
		}		

		.categories-table{
			margin-left: 20px;
			margin-right: 20px;
		}

		.parts-table {
			margin-left: 20px;
			margin-right: 20px;
		}

		.category {
			width: 100%;
		}

		.parts {
			width: 100%;
		}

		.parts-small-td {
			width: 200px;
		}

		.table-title {
			background-color: grey;
		}

		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;		
			line-height: 175%;
			padding-left: 10px;
		}

	</style>


	<div class="admin-content">
		<h1>Search Results for "<?= $_POST["query"] ?>"</h1>

		<div class="categories-table">
			<h2>Categories</h2>
			
			<table class="category">
				<tr class="table-title">
					<td>Category Name</td>
				</tr>	
				<?
					$a;
				
					foreach ($category_results as $value) { 					
						$a++; ?>
			
						<tr><td><a href="admin.php?page=unibond-category-details&id=<?= $value->id ?>"><?= $value->name ?></a></td></tr>			
						<?
					}					

					if($a == 0){ ?>
						<tr>
							<td>No results found.</td>
						</tr>
					<? } ?>				
			</table>
		</div>

		<div class="parts-table">
			<h2>Parts</h2>

			<table class="parts">
				<tr class="table-title">
					<td class="parts-small-td">Part No</td>					
				</tr>
				<?
					$b;				
					foreach ($part_results as $value) { 					
						$b++; ?>
						<tr><td><a href="admin.php?page=unibond-category-details&id=<?= $value->id ?>"><?= $value->value ?></a></td></tr>			
						<?
					}					

					if($b == 0){ ?>
						<tr>
							<td>No results found.</td>
						</tr>
					<? } ?>	
			</table>

		</div>



	</div>	

</div>