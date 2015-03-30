<?

function print_rf($val)
{
	echo '<pre>';
	print_r($val);
	echo '</pre>';
}

function me($val)
{
	return mysql_real_escape_string($val);
}

$GLOBALS['default'] = $GLOBALS['wpdb']->dbh;

define('PLUGIN_ROOT', __DIR__);
define('SALTY', 'jerryisfunny');

require_once(PLUGIN_ROOT . '/controllers/MenuController.php');
require_once(PLUGIN_ROOT . '/controllers/ProductController.php');
require_once(PLUGIN_ROOT . '/controllers/FrontEndController.php');
/* require_once(PLUGIN_ROOT . '/controllers/LoginController.php'); */
require_once(PLUGIN_ROOT . '/lib/Row.php');
require_once(PLUGIN_ROOT . '/models/Category.php');
require_once(PLUGIN_ROOT . '/models/CompetitorParts.php');
require_once(PLUGIN_ROOT . '/models/RelatedCategory.php');
require_once(PLUGIN_ROOT . '/models/FieldTypes.php');
require_once(PLUGIN_ROOT . '/models/Part.php');
require_once(PLUGIN_ROOT . '/models/PartData.php');
require_once(PLUGIN_ROOT . '/models/PartGroup.php');
require_once(PLUGIN_ROOT . '/models/PartGroupFields.php');
require_once(PLUGIN_ROOT . '/models/RelatedPartsGroup.php');

?>
