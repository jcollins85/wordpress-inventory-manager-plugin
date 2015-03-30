<?

class Category extends Row
{
	public static $_table_name = 'categories';
	public static $_table_row_object = 'Category';
	public static $_connection_name = 'default';
	public static $_primary_key = 'id';

	public static $_relationships = array('related' => array('type' => 'has_many',
															 'model' => 'RelatedCategory',
															 'foreign_key' => array('category_id' => 'id')),
										  'parent' => array('type' => 'has_one',
										  					 'model' => 'Category',
										  					 'foreign_key' => array('id' => 'parent_id')));
}

?>