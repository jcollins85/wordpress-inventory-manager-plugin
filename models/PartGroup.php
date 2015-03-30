<?

class PartGroup extends Row
{
	public static $_table_name = 'part_groups';
	public static $_table_row_object = 'PartGroup';
	public static $_connection_name = 'default';
	public static $_primary_key = 'id';

	public static $_relationships = array('fields' => array('type' => 'has_many',
															 'model' => 'PartGroupFields',
															 'foreign_key' => array('part_group_id' => 'id'),
															 'order_by' => 'field_type_id'),
											'category' => array('type' => 'has_one',
																'model' => 'Category',
																'foreign_key' => array('id' => 'category_id')),
											'related_groups' => array('type' => 'has_many',
															   'model' => 'RelatedPartsGroup',
															   'foreign_key' => array('related_parts_group_id' => 'id')),
											'parts' => array('type' => 'has_many',
												'model' => 'Part',
												'foreign_key' => array('part_group_id' => 'id')),
												'additional_where' => 'parent_id IS NULL');
}

?>