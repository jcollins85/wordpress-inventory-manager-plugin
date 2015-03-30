<?

class RelatedCategory extends Row
{
	public static $_table_name = 'related_categories';
	public static $_table_row_object = 'RelatedCategory';
	public static $_connection_name = 'default';
	public static $_primary_key = 'id';

	public static $_relationships = array('category' => array('type' => 'has_one',
															 'model' => 'Category',
															 'foreign_key' => array('id' => 'related_category_id')));
}

?>