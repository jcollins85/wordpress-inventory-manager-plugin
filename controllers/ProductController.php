<?

class ProductController
{
	public static $part_num_field_id = '1';
	public static $part_desc_field_id = '2';
	public static $upload_path = "http://unibond.dev.kpd-i.com/wp-content/uploads/part-images/";

	public static function index()
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());

		require_once(PLUGIN_ROOT . '/views/admin/index.php');
	}

	public static function create_category()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$related_list = RelatedCategory::find_all(array());

		$new_category = new category;
		$new_category->populate($_POST['category']);
		$new_category->featured = 0;
		$new_category->save();

		$default_part_group = new PartGroup;		
		$default_part_group->name = "Default Part Group";
		$default_part_group->description = "This is the default part group";
		$default_part_group->category_id = $new_category->id;
		$default_part_group->save();

		$hidden_part_num = new PartGroupFields();
		$hidden_part_num->field_type_id = self::$part_num_field_id;
		$hidden_part_num->part_group_id = $default_part_group->id;
		$hidden_part_num->save();

		$hidden_part_desc = new PartGroupFields();
		$hidden_part_desc->field_type_id = self::$part_desc_field_id;
		$hidden_part_desc->part_group_id = $default_part_group->id;
		$hidden_part_desc->save();		

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $new_category->id .'";</script>';			
	}

	public static function edit_category()
	{																					    
		Row::run_query("UPDATE categories SET is_featured = '" . me($_POST['is_featured']) . "', description = '" . $_POST['category_desc'] . "', name = '" . me($_POST['category_name']). "', image_url = '" . $_POST['category_image'] . "', `order` = '" . $_POST['category_order'] ."' WHERE id = '" . $_POST['category_id'] . "'", "default");		
		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $_POST['category_id'] .'";</script>';			
	}

	public static function delete_category()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$related_list = RelatedCategory::find_all(array());

		Row::run_query("DELETE FROM categories WHERE id = '" . $_POST['category-id'] . "'", "default");
		Row::run_query("DELETE FROM part_groups WHERE category_id = '" . $_POST['category-id'] . "'", "default");
		Row::run_query("DELETE FROM parts WHERE category_id = '" . $_POST['category-id'] . "'", "default");
		
		echo '<script>document.location = "admin.php?page=unibond-main-menu";</script>';			
	}	

	public static function create_part()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());

		$new_part = new Part;
		$new_part->category_id = $_POST['part']['category_id'];
		$new_part->part_group_id = $_POST['part']['part_group_id'];
		$new_part->image_url = self::$upload_path . $_POST['field_data']['1'] . '.png';
		$new_part->save();

		foreach ($_POST['field_data'] as $key=>$data) {
			$part_value = new PartData();
			$part_value->field_type_id = $key;
			$part_value->product_id = $new_part->id;
			$part_value->value = $data;
			$part_value->save();
		}			

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $new_part->category_id .'";</script>';
	}	

	public static function create_subcategory()	
	{	
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$related_list = RelatedCategory::find_all(array());
			
		$new_category = new category;
		$new_category->populate($_POST['category']);
		$new_category->featured = 0;
		$new_category->save();		

		$default_part_group = new PartGroup;		
		$default_part_group->name = "Default Part Group";
		$default_part_group->description = "This is the default part group";
		$default_part_group->category_id = $new_category->id;
		$default_part_group->save();	

		$hidden_part_num = new PartGroupFields();
		$hidden_part_num->field_type_id = self::$part_num_field_id;
		$hidden_part_num->part_group_id = $default_part_group->id;
		$hidden_part_num->save();

		$hidden_part_desc = new PartGroupFields();
		$hidden_part_desc->field_type_id = self::$part_desc_field_id;
		$hidden_part_desc->part_group_id = $default_part_group->id;
		$hidden_part_desc->save();			

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $new_category->parent_id .'";</script>';
	}			

	public static function category_details()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$part_group_list = PartGroup::find_all(array(), "category_id = '". me($_GET['id']) . "'");
		$part_list = Part::find_all(array());
		$part_data = PartData::find_all(array());
		$current_category = Category::find(array(), array('id'=>$_GET['id']) ); 

		require_once(PLUGIN_ROOT . '/views/admin/category.php');
	}

	public static function part_group_details()
	{
		$attribute_list = FieldTypes::find_all(array());
		$current_part_group = PartGroup::find(array(), array('id'=>$_GET['id']) );
		$part_group_fields = PartGroupFields::find_all(array());

		require_once(PLUGIN_ROOT . '/views/admin/add-part-group.php');
	}

	public static function part_details()
	{
		$attribute_list = FieldTypes::find_all(array());
		$current_part_group = PartGroup::find(array(), array('id'=>$_GET['part-group-id']) );
		$category = Category::find_all(array());
		$part_group_fields = PartGroupFields::find_all(array());
		$part_data = PartData::find_all(array(), "product_id = '" . me($_GET['part-id']) . "'");
		$part = Part::find(array(), array('id'=>$_GET['part-id']));

		require_once(PLUGIN_ROOT . '/views/admin/add-part.php');
	}	

	public static function update_part() 
	{	
		$product_image = self::$upload_path . $_POST['field_data']['1'] . '.png';

		Row::run_query("UPDATE parts SET image_url = '" . $product_image . "' WHERE id = '" . $_POST['part-id'] . "'", "default");

		Row::run_query("DELETE FROM parts_data WHERE product_id = '" . $_POST['part-id'] . "'", "default");

		foreach ($_POST['field_data'] as $key=>$data) {
			$part_value = new PartData();
			$part_value->field_type_id = $key;
			$part_value->product_id = $_POST['part-id'];
			$part_value->value = $data;
			$part_value->save();
		}			

		echo '<script>document.location = "admin.php?page=unibond-part-details&part-group-id='. $_POST['part-group-id'] .'&part-id='. $_POST['part-id'] .'&category-id=' . $_POST['category-id'] . '";</script>'; 		
	}

	public static function create_related_category()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$related_list = RelatedCategory::find_all(array());

		$related_category = new RelatedCategory();
		$related_category->populate($_POST['related_category']);
		$related_category->save();

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $related_category->category_id .'";</script>';		
	}

	public static function delete_related_category()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$related_list = RelatedCategory::find_all(array());

		Row::run_query("DELETE FROM related_categories WHERE category_id = '" . $_POST['category_id'] . "' && related_category_id = '" . $_POST['related_category_id'] . "'", "default");
		
		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $_POST['category_id'] .'";</script>';					
	}		

	public static function create_related_part_group()	
	{		
		$category = Category::find_all(array());
		$current_part_group = PartGroup::find(array(), array('id'=>$_GET['id']) );
		$attribute_list = FieldTypes::find_all(array());
		$part_group_list = PartGroup::find_all(array());

		$related_part_group = new RelatedPartsGroup();
		$related_part_group->populate($_POST['related_part_group']);
		$related_part_group->save();

		echo '<script>document.location = "admin.php?page=unibond-part-group-details&id='. $related_part_group->related_parts_group_id .'";</script>';	
	}

	public static function delete_related_part_group()	
	{	
		$rpg = RelatedPartsGroup::find(array(), array('id' => $_GET['id']));
		
		RelatedPartsGroup::delete($rpg);

		echo '<script>document.location = "admin.php?page=unibond-part-group-details&id='. $rpg->related_parts_group_id .'";</script>';	
	}

	public static function create_part_group_link()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$part_group_list = PartGroup::find_all(array());

		require_once(PLUGIN_ROOT . '/views/admin/add-part-group.php');
	}	

	public static function create_part_link()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$current_part_group = PartGroup::find(array(), array('id'=>$_REQUEST['part-group-id']));

		require_once(PLUGIN_ROOT . '/views/admin/add-part.php');
	}	

	public static function create_part_group()	
	{
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$part_group_list = PartGroup::find_all(array());

		$part_group = new PartGroup();
		$part_group->populate($_POST['part_group']);
		$part_group->save();

		foreach ($_POST['part_group_fields'] as $data) {
			$value = new PartGroupFields();
			$value->field_type_id = $data;
			$value->part_group_id = $part_group->id;
			$value->save();
		}

		$hidden_part_num = new PartGroupFields();
		$hidden_part_num->field_type_id = self::$part_num_field_id;
		$hidden_part_num->part_group_id = $part_group->id;
		$hidden_part_num->save();

		$hidden_part_desc = new PartGroupFields();
		$hidden_part_desc->field_type_id = self::$part_desc_field_id;
		$hidden_part_desc->part_group_id = $part_group->id;
		$hidden_part_desc->save();		

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $part_group->category_id .'";</script>';
	}

	public static function update_part_group()
	{                
		Row::run_query("UPDATE part_groups SET name = '" . $_POST['part_group_name'] . "' WHERE id = '" . $_POST['part_group_id'] . "'", "default");
		Row::run_query("UPDATE part_groups SET description = '" . $_POST['part_group_description'] . "' WHERE id = '" . $_POST['part_group_id'] . "'", "default");                
                
        Row::run_query("DELETE FROM part_groups_fields WHERE part_group_id = '" . $_POST['part_group_id'] . "'", "default");

        $x = 0;

		foreach ($_POST['part_group_fields'] as $data) {
			$value = new PartGroupFields();
			$value->field_type_id = $data;
			$value->order = $_POST['part_group_fields_order'][$x];
			$value->part_group_id = $_POST['part_group_id'];
			$value->save();

			$x++;
		}

		$hidden_part_num = new PartGroupFields();
		$hidden_part_num->field_type_id = self::$part_num_field_id;
		$hidden_part_num->part_group_id = $_POST['part_group_id'];
		$hidden_part_num->save();

		$hidden_part_desc = new PartGroupFields();
		$hidden_part_desc->field_type_id = self::$part_desc_field_id;
		$hidden_part_desc->part_group_id = $_POST['part_group_id'];
		$hidden_part_desc->save();			                

		echo '<script>document.location = "admin.php?page=unibond-part-group-details&id='. $_POST['part_group_id'] .'";</script>'; 		
	}  		

	public static function create_attribute()	
	{	
		$category = Category::find_all(array());
		$attribute_list = FieldTypes::find_all(array());
		$current_category = Category::find(array(), array('id'=>$_GET['id']) );

		$attribute = new FieldTypes();
		$attribute->populate($_POST['field_types']);
		$attribute->save();

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $part_group->category_id .'";</script>';			
	}

	public static function delete_part_group()	
	{
		Row::run_query("DELETE FROM part_groups WHERE id = '" . $_POST['part-group-id'] . "'", "default");
		Row::run_query("DELETE FROM parts WHERE part_group_id = '" . $_POST['part-group-id'] . "'", "default");		
		
		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $_POST['category_id'] .'"</script>';			
	}	

	public static function search()
	{
		$category_results = Category::find_all(array(), "name LIKE '%".$_POST['query']."%'");
		$part_results = PartData::find_all(array(), "field_type_id = 1 AND value LIKE '%".$_POST['query']."%'");		

		require_once(PLUGIN_ROOT . '/views/admin/search-results.php');
	}

	public static function delete_part()	
	{
		Row::run_query("DELETE FROM parts WHERE id = '" . $_POST['part-id'] . "'", "default");
		Row::run_query("DELETE FROM parts_data WHERE product_id = '" . $_POST['part-id'] . "'", "default");
		
		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $_POST['category_id'] .'"</script>';			
	}	

	public static function create_part_variant()
	{
		require_once(PLUGIN_ROOT . '/views/admin/part-variant.php');
	}

	public static function insert_part_variant()
	{
		
		$orig = Part::find(array(), array('id' => $_REQUEST['variantof']));

		$p 					= new Part();
		$p->parent_id 		= $_REQUEST['variantof'];
		$p->part_group_id 	= $orig->part_group_id;
		$p->category_id 	= $orig->category_id;
		$p->save();
			
		foreach ($_REQUEST['field_data'] as $field_id => $value)
		{
			if ($value)
			{
				$pd = new PartData();
				$pd->product_id = $p->id;
				$pd->field_type_id = $field_id;
				$pd->value = $value;
				$pd->save();
			}
		}

		echo '<script>document.location = "admin.php?page=unibond-category-details&id='. $p->category_id .'"</script>';			

	}

}

?>