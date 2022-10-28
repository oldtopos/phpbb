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

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['summitworkshops_workshops_goodbye']);
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
	}

	public function update_data()
	{
		return [
			['config.add', ['summitworkshops_workshops_goodbye', 0]],

			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_WORKSHOPS_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_WORKSHOPS_TITLE',
				[
					'module_basename'	=> '\summitworkshops\workshops\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
