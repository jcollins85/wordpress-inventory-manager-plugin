<?

class FrontEndController

{

	public static function product_landing()
	{
		Unibond::$data['categories'] = Category::find_all(array(), "parent_id = '" . $_GET['parent-id'] . "'");
        Unibond::$data['sub_categories'] = Category::find_all(array(), "parent_id is not null");                
	}

	public static function search()
	{
		if ($_POST['part_description_search'] !== ""){	

			$words = explode(" ", $_POST['part_description_search']);

			foreach ($words as $word)
			{
			 if (trim($word))
			  $like_args[] = "description LIKE '%" . trim($word) . "%'";
			}

			$like_query = implode(" AND ", $like_args);

			Unibond::$data['category_results'] = Category::find_all(array(), $like_query);
		}

		if ($_POST['part_number_search'] !== ""){
			Unibond::$data['part_results'] = PartData::find_all(array(), "field_type_id = 1 AND value LIKE '%".$_POST['part_number_search']."%'");	
		}

		if ($_POST['part_competitor_search'] !== ""){
			Unibond::$data['competitor_result'] = CompetitorParts::find_all(array(), "competitor_part = '" . $_POST['part_competitor_search'] . "'");
		}	

		Unibond::$data['parts'] = Part::find_all(array());
		Unibond::$data['unibond_part'] = PartData::find_all(array());
	}		

	public static function product_details()
	{
		Unibond::$data['current_category'] = Category::find(array(), array('id' => $_GET['category-id']));
		Unibond::$data['categories'] = Category::find_all(array());
		Unibond::$data['part_group'] = PartGroup::find_all(array(), 'category_id = ' . $_GET['category-id']);
		Unibond::$data['part_group_fields'] = PartGroupFields::find_all(array());
		Unibond::$data['attribute_list'] = FieldTypes::find_all(array());
		Unibond::$data['part_data'] = PartData::find_all(array());
		Unibond::$data['parts'] = Part::find_all(array(), "category_id = '" . me($_GET['category-id']) . "'");
	}

	public static function part_group_list()
	{
		Unibond::$data['part_group_list'] = PartGroup::find_all(array(), "category_id = '" . me($_GET['category-id']) . "'");
		Unibond::$data['parts'] = PartGroup::find_all(array());
	}

	public static function contact_us()
	{
		$GLOBALS['email-success'] = false;

		// reCAPTCHA 
		require_once('recaptchalib.php');
	    $privatekey = "6LfLt9QSAAAAAM619R1EOeWtE6qzrYzv9NrOJmP-";
	    $resp = recaptcha_check_answer ($privatekey,
	                                $_SERVER["REMOTE_ADDR"],
	                                $_POST["recaptcha_challenge_field"],
	                                $_POST["recaptcha_response_field"]);

		if (!$resp->is_valid) {
	        // What happens when the CAPTCHA was entered incorrectly
	        $GLOBALS['captchaerror'] = true;

			//die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
			//"(reCAPTCHA said: " . $resp->error . ")");
		} else {
		// Your code here to handle a successful verification
			$GLOBALS['email-success'] = true;
		}
	}
}

?>