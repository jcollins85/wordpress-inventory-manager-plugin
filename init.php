<?

class Unibond
{
	public static $data;
}

if (is_admin())
{
	
	add_action('admin_menu', array('MenuController', 'menu'));
	
}
elseif ($_GET['m'] == 'unibond')
{
	$controller = ucwords($_GET['c']) . 'Controller';	
	call_user_func($controller . '::' . $_GET['a']);

}
?>
