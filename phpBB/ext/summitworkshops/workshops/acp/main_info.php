<?php
/**
 *
 * Summit Workshops. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, John Novak, http://github.com/oldtopos
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace summitworkshops\workshops\acp;

/**
 * Summit Workshops ACP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\summitworkshops\workshops\acp\main_module',
			'title'		=> 'ACP_WORKSHOPS_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_WORKSHOPS',
					'auth'	=> 'ext_summitworkshops/workshops && acl_a_board',
					'cat'	=> ['ACP_WORKSHOPS_TITLE'],
				],
			],
		];
	}
}
