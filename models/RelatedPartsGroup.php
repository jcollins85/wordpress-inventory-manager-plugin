<?

class RelatedPartsGroup extends Row
{
	public static $_table_name = 'related_parts_group';
	public static $_table_row_object = 'RelatedPartsGroup';
	public static $_connection_name = 'default';
	public static $_primary_key = 'id';

	public static $_relationships = array('partgroup' => array('type' => 'has_one',
																  'model' => 'PartGroup',
																  'foreign_key' => array('id' => 'relatedto_parts_group_id')));
}

?>