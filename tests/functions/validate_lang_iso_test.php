<?php
/**
*
* @package testing
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

require_once dirname(__FILE__) . '/../../phpBB/includes/functions_user.php';
require_once dirname(__FILE__) . '/validate_data_helper.php';

class phpbb_functions_validate_lang_iso_test extends phpbb_database_test_case
{
	protected $db;
	protected $helper;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/language_select.xml');
	}

	protected function setUp()
	{
		parent::setUp();

		$this->db = $this->new_dbal();
		$this->helper = new phpbb_functions_validate_data_helper($this);
	}

	public function test_validate_lang_iso()
	{
		global $db;

		$db = $this->db;

		$this->helper->assert_validate_data(array(
			'empty'		=> array('WRONG_DATA'),
			'en'		=> array(),
			'cs'		=> array(),
			'de'		=> array('WRONG_DATA'),
		),
		array(
			'empty'		=> '',
			'en'		=> 'en',
			'cs'		=> 'cs',
			'de'		=> 'de',
		),
		array(
			'empty'		=> array('language_iso_name'),
			'en'		=> array('language_iso_name'),
			'cs'		=> array('language_iso_name'),
			'de'		=> array('language_iso_name'),
		));
	}
}
