<?php
/**
 *
 * Summit Workshops. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, John Novak, http://github.com/oldtopos
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace summitworkshops\workshops\migrations;

class install_ucp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'ucp'
				AND module_langname = 'UCP_WORKSHOPS_TITLE'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id !== false;
	}

	public static function depends_on()
	{
		return ['\summitworkshops\workshops\migrations\install_sample_schema'];
	}

	public function update_data()
	{
		return [
			['module.add', [
				'ucp',
				0,
				'UCP_WORKSHOPS_TITLE'
			]],
			['module.add', [
				'ucp',
				'UCP_WORKSHOPS_TITLE',
				[
					'module_basename'	=> '\summitworkshops\workshops\ucp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
