<?php
/**
 *
 * Summit Workshops. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, John Novak, http://github.com/oldtopos
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace summitworkshops\workshops\ucp;

/**
 * Summit Workshops UCP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\summitworkshops\workshops\ucp\main_module',
			'title'		=> 'UCP_WORKSHOPS_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'UCP_WORKSHOPS',
					'auth'	=> 'ext_summitworkshops/workshops',
					'cat'	=> ['UCP_WORKSHOPS_TITLE'],
				],
			],
		];
	}
}
