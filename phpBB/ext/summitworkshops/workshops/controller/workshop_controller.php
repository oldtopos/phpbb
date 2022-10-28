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

define('WORKSHOPS_TABLE', 'phpbb_'.'workshops');

/**
 * Summit Workshops main controller.
 */
class workshop_controller
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface $db		database object
	 * @param \phpbb\config\config		$config		Config object
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 * @param \phpbb\language\language	$language	Language object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\language\language $language, \phpbb\request\request $request)
	{
		$this->db		= $db;
		$this->config	= $config;
		$this->helper	= $helper;
		$this->template	= $template;
		$this->language	= $language;
		$this->request 	= $request;

		$this->u_action = 'add';
	}

	/**
	 * Controller handler for route /workshops
	 *
	 * @param string $name
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function list()
	{
		$offset = 0;
		$page_rows = 10;

		// First executing a SELECT query.
		// Note: By using the SELECT type, it always uses AND in the conditions.
		$sql = 'SELECT *
			FROM ' . WORKSHOPS_TABLE .
			' LIMIT ' . $page_rows . ' OFFSET ' . $offset;
		$result = $this->db->sql_query($sql);

		$workshops_data = $this->db->sql_fetchrowset($result);

		$l_message = 'WORKSHOPS_DISPLAY';

		$id = 42;
		$this->template->assign_var('WORKSHOPS_MESSAGE', $this->language->lang($l_message, $id));

		$this->template->assign_var('workshops', $workshops_data );

		return $this->helper->render('@summitworkshops_workshops/workshops_list_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/{id}
	 *
	 * @param string $name
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function display($id)
	{
		// First executing a SELECT query.
		// Note: By using the SELECT type, it always uses AND in the conditions.
		$sql = 'SELECT *
			FROM ' . WORKSHOPS_TABLE . '
			WHERE workshops_id = ' . $id;
		$result = $this->db->sql_query($sql);

		$workshop_data = $this->db->sql_fetchrow($result);

		$l_message = 'WORKSHOPS_DISPLAY';

		$this->template->assign_var('WORKSHOPS_MESSAGE', $this->language->lang($l_message, $id));

		$this->setup_output_template( $workshop_data );

		return $this->helper->render('@summitworkshops_workshops/workshops_display_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/add
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function add()
	{
		// Create an array to collect errors that will be output to the user
		$errors = [];

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			$workshop_info = $this->extract_template_data();

			$sql = 'INSERT INTO ' . WORKSHOPS_TABLE . ' ' . $this->db->sql_build_array('INSERT', $workshop_info);
			$this->db->sql_query($sql); 
		}

		$id = 42;

		$s_errors = !empty($errors);
		
		// Set output variables for display in the template
		$this->template->assign_vars([
			'S_ERROR'		=> $s_errors,
			'ERROR_MSG'		=> $s_errors ? implode('<br />', $errors) : '',

			'U_ACTION'	=> $this->u_action,
		]);

		return $this->helper->render('@summitworkshops_workshops/workshops_create_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/update/{id}
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function update($id)
	{
		// Create an array to collect errors that will be output to the user
		$errors = [];

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			$workshop_info = $this->extract_template_data();

			$sql = "UPDATE " . WORKSHOPS_TABLE . "
						SET ".  $this->db->sql_build_array("UPDATE", $workshop_info) . "
						WHERE workshops_id = '" . $id . "'";
			$this->db->sql_query($sql);
		}

		// First executing a SELECT query.
		// Note: By using the SELECT type, it always uses AND in the conditions.
		$sql = 'SELECT *
			FROM ' . WORKSHOPS_TABLE . '
			WHERE workshops_id = ' . $id;

		$result = $this->db->sql_query($sql);

		$workshop_data = $this->db->sql_fetchrow($result);

		$this->setup_output_template( $workshop_data );

		$s_errors = !empty($errors);
		
		// Set output variables for display in the template
		$this->template->assign_vars([
			'S_ERROR'		=> $s_errors,
			'ERROR_MSG'		=> $s_errors ? implode('<br />', $errors) : '',

			'U_ACTION'		=> 'update/' . $id,
		]);

		return $this->helper->render('@summitworkshops_workshops/workshops_create_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/delete/{id}
	 * 
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function delete($id)
	{
		$sql = 'DELETE
			FROM ' . WORKSHOPS_TABLE . '
			WHERE workshops_id = ' . $id;
		$result = $this->db->sql_query($sql);

		return $this->helper->render('@summitworkshops_workshops/workshops_display_body.html', $id);
	}

	/**
	 * Set custom form action.
	 *
	 * @param string	$u_action	Custom form action
	 * @return void
	 */
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}

	public function extract_template_data()
	{
		$workshop_info = array(
			'workshops_title' =>  $this->request->variable('workshops_title', 'No title provided', true),
			'workshops_description' => $this->request->variable('workshops_description', 'No description provided', true),
			'workshops_country' => $this->request->variable('workshops_country', 'USA', true),
			'workshops_location' => $this->request->variable('workshops_location', 'No location provided', true),
			'workshops_start_date' => $this->request->variable('workshops_start_date', '2023-01-01 00:00:00', true),
			'workshops_end_date' => $this->request->variable('workshops_end_date', '2023-01-01 00:00:00', true),
			'workshops_deposit_amount' => $this->request->variable('workshops_deposit_amount', 99.0, true),
			'workshops_tuition_amount' => $this->request->variable('workshops_tuition_amount', 500.0, true),
		);

		return $workshop_info;
	}

	public function setup_output_template( $workshop_data )
	{
		$this->template->assign_vars(
		array(
			'workshops_title' => $workshop_data[ 'workshops_title' ],
			'workshops_description' => $workshop_data[ 'workshops_description' ],
			'workshops_country' => $workshop_data[ 'workshops_country' ],
			'workshops_location' => $workshop_data[ 'workshops_location' ],
			'workshops_start_date' => $workshop_data[ 'workshops_start_date' ],
			'workshops_end_date' => $workshop_data[ 'workshops_end_date' ],
			'workshops_deposit_amount' => $workshop_data[ 'workshops_deposit_amount' ],
			'workshops_tuition_amount' => $workshop_data[ 'workshops_tuition_amount' ]
			)
		);
	}
}
