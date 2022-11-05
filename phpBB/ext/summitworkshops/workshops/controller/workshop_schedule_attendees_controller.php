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

define('WORKSHOPS_SCHEDULE_ATTENDEES_TABLE', 'phpbb_'.'workshops_schedule_attendees');

/**
 * Summit Workshops main controller.
 */
class workshop_schedule_attendees_controller
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

	/** @var \phpbb\user */
	protected $user;

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
	 * @param \phpbb\user				$user		User object
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\language\language $language, \phpbb\request\request $request, \phpbb\user $user)
	{
		$this->db		= $db;
		$this->config	= $config;
		$this->helper	= $helper;
		$this->template	= $template;
		$this->language	= $language;
		$this->request 	= $request;
		$this->user		= $user;

		$this->u_action = 'add';
	}

	/**
	 * Controller handler for route /workshops/schedule/attendees/
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
			FROM ' . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE .
			' LIMIT ' . $page_rows . ' OFFSET ' . $offset;
		$result = $this->db->sql_query($sql);

		$workshop_schedule_attendees = $this->db->sql_fetchrowset($result);

		$l_message = 'WORKSHOPS_DISPLAY';

		$id = 42;
		$this->template->assign_var('WORKSHOPS_MESSAGE', $this->language->lang($l_message, $id));

		$this->template->assign_var('workshop_schedule_attendees', $workshop_schedule_attendees );

		return $this->helper->render('@summitworkshops_workshops/workshops_schedule_attendees_list_body.html', $id);
	}


	/**
	 * Controller handler for route /workshops/schedule/attendees/schedule/{schedule_id}
	 *
	 * @param string $name
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function list_schedule($schedule_id)
	{
		$offset = 0;
		$page_rows = 10;

		// First executing a SELECT query.
		// Note: By using the SELECT type, it always uses AND in the conditions.
		$sql = 'SELECT *
			FROM ' . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE .
			' WHERE workshops_schedule_attendees_schedule_id = ' . $schedule_id .
			' LIMIT ' . $page_rows . ' OFFSET ' . $offset;
		$result = $this->db->sql_query($sql);

		$workshop_schedule_attendees = $this->db->sql_fetchrowset($result);

		$l_message = 'WORKSHOPS_DISPLAY';

		$id = 42;
		$this->template->assign_var('WORKSHOPS_MESSAGE', $this->language->lang($l_message, $id));

		$this->template->assign_var('workshop_schedule_attendees', $workshop_schedule_attendees );

		return $this->helper->render('@summitworkshops_workshops/workshops_schedule_attendees_list_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/schedule/attendees/{id}
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
			FROM ' . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE . '
			WHERE workshops_schedule_attendees_id = ' . $id;
		$result = $this->db->sql_query($sql);

		$workshop_data = $this->db->sql_fetchrow($result);

		$l_message = 'WORKSHOPS_DISPLAY';

		$this->template->assign_var('WORKSHOPS_MESSAGE', $this->language->lang($l_message, $id));

		$this->setup_output_template( $workshop_data );

		return $this->helper->render('@summitworkshops_workshops/workshops_schedule_attendees_display_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/schedule/attendees/add
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

			$sql = 'INSERT INTO ' . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE . ' ' . $this->db->sql_build_array('INSERT', $workshop_info);
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

		return $this->helper->render('@summitworkshops_workshops/workshops_schedule_attendees_create_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/schedule/attendees/update/{id}
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

			$sql = "UPDATE " . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE . "
						SET ".  $this->db->sql_build_array("UPDATE", $workshop_info) . "
						WHERE workshops_schedule_attendees_id = '" . $id . "'";
			$this->db->sql_query($sql);
		}

		// First executing a SELECT query.
		// Note: By using the SELECT type, it always uses AND in the conditions.
		$sql = 'SELECT *
			FROM ' . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE . '
			WHERE workshops_schedule_attendees_id = ' . $id;

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

		return $this->helper->render('@summitworkshops_workshops/workshops_schedule_attendees_create_body.html', $id);
	}

	/**
	 * Controller handler for route /workshops/schedule/attendees/delete/{id}
	 * 
	 *
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function delete($id)
	{
		$sql = 'DELETE
			FROM ' . WORKSHOPS_SCHEDULE_ATTENDEES_TABLE . '
			WHERE workshops_schedule_attendees_id = ' . $id;
		$result = $this->db->sql_query($sql);

		return $this->helper->render('@summitworkshops_workshops/workshops_schedule_attendees_display_body.html', $id);
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
			'workshops_schedule_attendees_user_id' =>  $this->request->variable('workshops_schedule_attendees_user_id', -1, true),
			'workshops_schedule_attendees_schedule_id' => $this->request->variable('workshops_schedule_attendees_schedule_id', -1, true),
		);

		return $workshop_info;
	}

	public function setup_output_template( $workshop_attendees )
	{
		$this->template->assign_vars(
		array(
			'workshops_schedule_attendees_user_id' => $workshop_attendees[ 'workshops_schedule_attendees_user_id' ],
			'workshops_schedule_attendees_schedule_id' => $workshop_attendees[ 'workshops_schedule_attendees_schedule_id' ],
			)
		);
	}
}
