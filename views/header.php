<style>
	body {
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	}

	.wrap {
		border: 1px solid black;
	}	

	.admin-content {
		left: 330px;
		right: 17px;
		display: inline-block;
		height: 100%;
		position: absolute;
		min-height: 1000px;
	}	

	.required {
		color: red;
	}

	a:hover {
		text-decoration: underline !important;
		color: black;
	}

	a:link {
		text-decoration: none;
		color: black;		
	}

	a:active {
		text-decoration: none;		
	}				

	a:visited {
		text-decoration: none;	
		color: black;	
	}

	.underline {
		text-decoration: underline !important;
	}

	.admin-header {
		height: 90px;
		width: 100%;
		background-color: grey;
		border-bottom: 1px solid black;

	}	

	.logo {
		height: 107px;
		width: 140px;
		padding-left: 10px;
		padding-top: 5px;
		padding-right: 65px;
		display: inline-block;
	}

	.logo-image {
		height: 80px;

	}

	.breadcrumb {
		margin-left: 20px;
	}

	.header-button {
		width: 100px;
		height: 50px;		
		border: 1px solid black;
		border-radius: 12px;
		display: inline-block;
		position: absolute;
		margin-top: 20px;
		background-color: #FFFFFF;
	}

	.new-part {

	}

	.new-category {		
		/* margin-left: 125px; */
	}

	.header-button-span {
		position: absolute;
		margin-top: 17px;
		margin-left: 14px;
		text-align: center;
		width: 70px;
		font-size: 15px;
	}

	.span-new-category {	
		margin-top: 6px;
		margin-left: 16px;
	}

	.header-search {
		float: right;
		margin-left: 25px;		
		margin-top: 25px;
		margin-right: 25px;
		display: inline-block;
		width: 385px;	

	}

	.header-search-bar {
		width: 340px;
		height: 40px;
		border: 1px solid black !important;
		border-radius: 12px !important;
		padding-left: 10px;
	}

	.ui-dialog {
		background-color: white;
		padding: 30px;
		border: 2px solid black;
		border-radius: 5px;
	}

	.ui-dialog input {	
		border: 2px solid grey;
		height: 40px;
		width: 100%;
		padding-left: 10px;
	}

	.ui-dialog h1{	
		margin-top: -20px;
	}	

	.ui-dialog input.check { width: 20px; height: 10px; }

	.ui-dialog textarea {
		border: 2px solid grey;
		width: 100%;
		padding-left: 10px;
		padding-top: 5px;
	}

	.ui-dialog label { }

	.ui-dialog-titlebar {
		visibility: hidden;
	}	

	.ui-dialog-buttonpane {
		float: right;
		margin-top: -5px;
	}	

	.ui-button {		
		height: 35px;
		width: 100px;
		margin-top: -35px;
	}

	.ui-h1-center {
		margin: 0 auto;
	}

	button { cursor: pointer; }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/js/html5placeholder.jquery.js"></script>

	<!--[if lt IE 10]>
	<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 

<script type="text/javascript">	
	    $(function(){
	      $(':input[placeholder]').placeholder();
	    });		    
</script>

<div class="admin-header">
	<div class="logo">
		<a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=unibond-main-menu"><img class="logo-image" src="<?php bloginfo('url'); ?>/wp-content/plugins/unibond/assets/unibond_logo.png" /></a>
	</div>

<!--
	<div id="new-part" class="header-button new-part">
		<span class="header-button-span"><a href="admin.php?page=unibond-create-part-link">New Part</a></span>
	</div>
-->

	<div id="new-category" class="header-button new-category">
		<span class="header-button-span span-new-category"><a href="">New Category</a></span>
	</div>

	<div class="header-search">
		<form action="admin.php?page=unibond-search" id="unibond-search-form" method="post">
			<input type="text" class="header-search-bar" name="query" placeholder="search parts and categories" />
			<input type="submit" value="Go"/>
		</form>
	</div>
</div>
    
    <div id="dialog-add-new-category">            
    </div>


<script>

		$('#new-category').bind('click', function(e) { 

			e.preventDefault();			

			$( "#dialog-add-new-category" ).html('<h1>Create New Category</h1><form action="admin.php?page=unibond-create-category" id="new-category-form" method="post"><input type="text" placeholder="Category Name" name="category[name]" /><br/><br/><textarea name="category[description]" placeholder="Description" rows="5" cols="77"></textarea><select name="category[parent_id]"><option  value="244">Uni-Bond</option><option value="245">SPT</option></select></form>').dialog({
				resizable: false,
				height:300,
				width: 500,								
				modal: true,
				buttons: {
					"Save": function() {
						$('form#new-category-form').submit();
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