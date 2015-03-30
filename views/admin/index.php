	<style>

		.admin-start {
			width: 100%;
			height: 300px;
			display: block;
			margin-top: 170px;
			margin-right: 10px;
			text-align: center;
		}

		.admin-homepage-search {
			width: 280px;
			height: 40px;
			border: 2px solid black;
			border-radius: 12px;
			padding-left: 10px;			
		}

		.admin-homepage-copy {
			font-size: 20px;
		}	

		.admin-homepage-search-wrap {
			font-size: 20px;
			margin-top: 25px;
		}	

		.admin-homepage-submit { padding: 5px; cursor: pointer; }

	</style>

<div class="wrap">
	<? require_once(__DIR__ . '/../../config.php'); ?>

	<? require_once(PLUGIN_ROOT . '/views/header.php'); ?>
	<? require_once(PLUGIN_ROOT . '/views/sidebar.php'); ?>

	<div class="admin-content">
		<div class="admin-start">
			<span class="admin-homepage-copy">Select a category from the left to add or edit products, or</span>

			<div class="admin-homepage-search-wrap">
				<form action="admin.php?page=unibond-search" id="unibond-search-form" method="post">
					Search for a product:<br><br>
					<input class="admin-homepage-search" type="text" name="query" placeholder="search our catalogue" />
					<input class="admin-homepage-submit" type="submit" value="Go"/>
				</form>
			</div>

		</div>

	</div>

</div>