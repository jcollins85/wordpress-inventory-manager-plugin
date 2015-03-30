<?

class MenuController 
{
	public static function index()
	{

	}

	public static function menu()
	{
		// these are actions that appear in the menu
 		add_menu_page('Unibond Menu', 'Unibond Menu', 'administrator', 'unibond-main-menu', array('ProductController', 'index'),  plugin_dir_url( __FILE__ ) . '../assets/menu-unibond.png'); 

		// these are actions that are hidden from the menu bust must exist
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-category', array('ProductController', 'create_category'));
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-edit-category', array('ProductController', 'edit_category'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-subcategory', array('ProductController', 'create_subcategory'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-related-category', array('ProductController', 'create_related_category'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-related-part-group', array('ProductController', 'create_related_part_group')); 		 		
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-delete-related-part-group', array('ProductController', 'delete_related_part_group')); 		 		
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-category-details', array('ProductController', 'category_details'));
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-part-group-details', array('ProductController', 'part_group_details'));
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-part-details', array('ProductController', 'part_details'));
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-update-part', array('ProductController', 'update_part'));
        add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-update-part-group', array('ProductController', 'update_part_group'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-delete-category', array('ProductController', 'delete_category'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-part-group', array('ProductController', 'create_part_group'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-delete-part-group', array('ProductController', 'delete_part_group'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-delete-part', array('ProductController', 'delete_part'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-delete-related-category', array('ProductController', 'delete_related_category'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-part-group-link', array('ProductController', 'create_part_group_link'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-part-link', array('ProductController', 'create_part_link'));		
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-attribute', array('ProductController', 'create_attribute'));
 		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-part', array('ProductController', 'create_part'));
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-search', array('ProductController', 'search')); 		 		 		
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-create-part-variant', array('ProductController', 'create_part_variant')); 		 		 		
		add_submenu_page('mio-hidden', 'Unibond Admin', '', 'administrator', 'unibond-insert-part-variant', array('ProductController', 'insert_part_variant')); 		 		 		
 	}
}
?>