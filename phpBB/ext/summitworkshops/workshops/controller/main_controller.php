<?php
/**
 *
 * Summit Workshops. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, John Novak, http://github.com/oldtopos
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace summitworkshops\workshops\controller;

/**
 * Summit Workshops main controller.
 */
class main_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config		$config		Config object
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 * @param \phpbb\language\language	$language	Language object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\language\language $language)
	{
		$this->config	= $config;
		$this->helper	= $helper;
		$this->template	= $template;
		$this->language	= $language;
	}

	/**
	 * Controller handler for route /demo/{name}
	 *
	 * @param string $name
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function handle($name)
	{
		$l_message = !$this->config['summitworkshops_workshops_goodbye'] ? 'WORKSHOPS_HELLO' : 'WORKSHOPS_GOODBYE';
		$this->template->assign_var('WORKSHOPS_MESSAGE', $this->language->lang($l_message, $name));

		return $this->helper->render('@summitworkshops_workshops/workshops_body.html', $name);
	}
}
