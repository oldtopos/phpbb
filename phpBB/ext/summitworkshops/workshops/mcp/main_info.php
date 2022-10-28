<?php
/**
 *
 * Summit Workshops. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, John Novak, http://github.com/oldtopos
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace summitworkshops\workshops\mcp;

/**
 * Summit Workshops MCP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\summitworkshops\workshops\mcp\main_module',
			'title'		=> 'MCP_WORKSHOPS_TITLE',
			'modes'		=> [
				'front'	=> [
					'title'	=> 'MCP_WORKSHOPS',
					'auth'	=> 'ext_summitworkshops/workshops',
					'cat'	=> ['MCP_WORKSHOPS_TITLE'],
				],
			],
		];
	}
}
