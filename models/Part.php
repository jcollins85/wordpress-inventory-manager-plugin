<?

class Part extends Row
{
	public static $_table_name = 'parts';
	public static $_table_row_object = 'Part';
	public static $_connection_name = 'default';
	public static $_primary_key = 'id';

	public static $_relationships = array('data' => array('type' => 'has_many',
															 'model' => 'PartData',
															 'foreign_key' => array('product_id' => 'id'),
															 'key_on' => 'field_type_id',
															 'order' => 'field_type_id'),
										  'variants' => array('type' => 'has_many',
										  					'model' => 'Part',
										  					'foreign_key' => array('parent_id' => 'id')),
										  'number' => array('type' => 'has_one',
										  					'model' => 'PartData',
										  					'foreign_key' => array('product_id' => 'id'),
		  					'additional_where' => 'field_type_id = 1'),
										  'group' => array('type' => 'has_one',
										  		'model' => 'PartGroup',
										  		'foreign_key' => array('id' => 'part_group_id')));	
}

?>