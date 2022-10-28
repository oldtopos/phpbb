<?php
/**
 *
 * Summit Workshops. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, John Novak, http://github.com/oldtopos
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [

	'WORKSHOPS_HELLO'		=> 'Hello %s!',
	'WORKSHOPS_GOODBYE'		=> 'Goodbye %s!',
	'WORKSHOPS_DISPLAY'		=> 'Showing workshop %d!',
	'WORKSHOPS_INFO'		=> 'Workshop %d Information',

	'WORKSHOPS_CREATE'		=> 'Add Workshop',
	'WORKSHOPS_INFO_NAME'	=> 'Workshop Name',
	'WORKSHOPS_INFO_DESCRIPTION'	=> 'Description',
	'WORKSHOPS_INFO_LOCATION'	=> 'Location',
	'WORKSHOPS_INFO_START_DATE'	=> 'Start Date',
	'WORKSHOPS_INFO_END_DATE'	=> 'End Date',
	'WORKSHOPS_INFO_DEPOSIT'	=> 'Deposit',
	'WORKSHOPS_INFO_TUITION'	=> 'Tuition',
	'WORKSHOPS_INFO_COUNTRY'	=> 'Country',
	'WORKSHOPS_INFO_ATTENDEES'	=> 'Max Attendees',

	'WORKSHOPS_TOPIC_TITLE'	=> 'Title',
	'WORKSHOPS_TOPIC_DESCRIPTION'	=> 'Description',
	'WORKSHOPS_TOPIC_IMAGE'	=> 'Topic Image',

	'WORKSHOPS_SCHEDULE_TITLE'			=> 'Title',
	'WORKSHOPS_SCHEDULE_DESCRIPTION'	=> 'Description',
	'WORKSHOPS_SCHEDULE_LOCATION'		=> 'Location',
	'WORKSHOPS_SCHEDULE_START_DATE'		=> 'Start Date',
	'WORKSHOPS_SCHEDULE_MEETING_LOCATION'		=> 'Meeting Location',
	'WORKSHOPS_SCHEDULE_MEETING_START_DATE'		=> 'Meeting Start Date',
	'WORKSHOPS_SCHEDULE_END_DATE'		=> 'End Date',
	'WORKSHOPS_SCHEDULE_ATTENDEES'		=> 'Max Attendees',
	'WORKSHOPS_SCHEDULE_WORKSHOP_ID'		=> 'Workshop ID',

	'WORKSHOPS_ATTENDEES_START_DATE'		=> 'Start Date',
	'WORKSHOPS_ATTENDEES_END_DATE'			=> 'End Date',
	'WORKSHOPS_ATTENDEES_INSTRUCTOR'		=> 'Instructor',
	'WORKSHOPS_ATTENDEES_JUNIOR_INSTRUCTOR'	=> 'Junior Instructor',
	'WORKSHOPS_ATTENDEES_USER_ID'			=> 'User ID',
	'WORKSHOPS_ATTENDEES_WORKSHOP_ID'		=> 'Workshop ID',

	'WORKSHOPS_SCHEDULE_ATTENDEES_USER_ID'	=> 'User ID',
	'WORKSHOPS_SCHEDULE_ATTENDEES_SCHEDULE_ID'	=> 'Schedule Item ID',

	'WORKSHOPS_EVENT'		=> ' :: Workshops Event :: ',

	'ACP_WORKSHOPS_GOODBYE'			=> 'Should say goodbye?',
	'ACP_WORKSHOPS_SETTING_SAVED'	=> 'Settings have been saved successfully!',

	'WORKSHOPS_PAGE'			=> 'Workshops Page',
	'VIEWING_SUMMITWORKSHOPS_WORKSHOPS'			=> 'Viewing Summit Workshops page',

	'WORKSHOPS_EDIT_WORKSHOP' => 'Edit',
	'WORKSHOPS_DELETE_WORKSHOP' => 'Delete',
	'WORKSHOPS_ADD_WORKSHOP' => 'Add New Workshop',

	'WORKSHOPS_EDIT_TOPIC' => 'Edit',
	'WORKSHOPS_DELETE_TOPIC' => 'Delete',
	'WORKSHOPS_ADD_TOPIC' => 'Add New Topic',

	'WORKSHOPS_EDIT_WORKSHOP_SCHEDULE' => 'Edit',
	'WORKSHOPS_DELETE_WORKSHOP_SCHEDULE' => 'Delete',
	'WORKSHOPS_ADD_WORKSHOP_SCHEDULE' => 'Add New Schedule Item',

	'WORKSHOPS_EDIT_ATTENDEE' => 'Edit',
	'WORKSHOPS_DELETE_ATTENDEE' => 'Delete',
	'WORKSHOPS_ADD_ATTENDEE' => 'Add New Attendee',

	'WORKSHOPS_SCHEDULE_EDIT_ATTENDEE' => 'Edit',
	'WORKSHOPS_SCHEDULE_DELETE_ATTENDEE' => 'Delete',
	'WORKSHOPS_SCHEDULE_ADD_ATTENDEE' => 'Add New Attendee',
]);
