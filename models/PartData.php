<?

class PartData extends Row
{
	public static $_table_name = 'parts_data';
	public static $_table_row_object = 'PartData';
	public static $_connection_name = 'default';
	public static $_primary_key = 'id';

	public static $_relationships = array('field' => array('type' => 'has_one',
															 'model' => 'FieldTypes',
															 'foreign_key' => array('id' => 'field_type_id'),
															 ));	
}

?>