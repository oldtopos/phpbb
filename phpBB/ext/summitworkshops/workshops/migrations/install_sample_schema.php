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

class install_sample_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'users', 'user_workshops');
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
	}

	/**
	 * Update database schema.
	 *
	 * https://area51.phpbb.com/docs/dev/3.2.x/migrations/schema_changes.html
	 *	add_tables: Add tables
	 *	drop_tables: Drop tables
	 *	add_columns: Add columns to a table
	 *	drop_columns: Removing/Dropping columns
	 *	change_columns: Column changes (only type, not name)
	 *	add_primary_keys: adding primary keys
	 *	add_unique_index: adding an unique index
	 *	add_index: adding an index (can be column:index_size if you need to provide size)
	 *	drop_keys: Dropping keys
	 *
	 * This sample migration adds a new column to the users table.
	 * It also adds an example of a new table that can hold new data.
	 *
	 * @return array Array of schema changes
	 */
	public function update_schema()
	{
		return [
			'add_tables'		=> [
				$this->table_prefix . 'summitworkshops_workshops_table'	=> [
					'COLUMNS'		=> [
						'workshops_id'				=> ['UINT', null, 'auto_increment'],
						'workshops_name'			=> ['VCHAR:255', ''],
					],
					'PRIMARY_KEY'	=> 'workshops_id',
				],
				$this->table_prefix . 'workshops_attendees'	=> [
					'COLUMNS'		=> [
						'workshops_attendees_id'	=> ['UINT', null, 'auto_increment'],
						'workshops_user_id'			=> ['UINT'],
						'start_date'			    => ['DATETIME'],
						'end_date'			 		=> ['DATETIME'],
						'is_instructor'			 	=> ['BOOL', 0],
						'is_junior_instructor'		=> ['BOOL', 0],
					],
					'PRIMARY_KEY'	=> 'workshops_attendees_id',
				],
				$this->table_prefix . 'workshops_schedule_attendees'	=> [
					'COLUMNS'		=> [
						'workshops_schedule_attendees_id'	=> ['UINT', null, 'auto_increment'],
						'user_id'							=> ['UINT'],
						'workshops_schedule_id'				=> ['UINT'],
					],
					'PRIMARY_KEY'	=> 'workshops_schedule_attendees_id',
				],
			],
			'add_columns'	=> [
				$this->table_prefix . 'users'			=> [
					'user_workshops'				=> ['UINT', 0],
				],
			],
		];
	}

	/**
	 * Revert database schema changes. This method is almost always required
	 * to revert the changes made above by update_schema.
	 *
	 * https://area51.phpbb.com/docs/dev/3.2.x/migrations/schema_changes.html
	 *	add_tables: Add tables
	 *	drop_tables: Drop tables
	 *	add_columns: Add columns to a table
	 *	drop_columns: Removing/Dropping columns
	 *	change_columns: Column changes (only type, not name)
	 *	add_primary_keys: adding primary keys
	 *	add_unique_index: adding an unique index
	 *	add_index: adding an index (can be column:index_size if you need to provide size)
	 *	drop_keys: Dropping keys
	 *
	 * This sample migration removes the column that was added the users table in update_schema.
	 * It also removes the table that was added in update_schema.
	 *
	 * @return array Array of schema changes
	 */
	public function revert_schema()
	{
		return [
			'drop_columns'	=> [
				$this->table_prefix . 'users'			=> [
					'user_workshops',
				],
			],
			'drop_tables'		=> [
				$this->table_prefix . 'summitworkshops_workshops_table',
			],
		];
	}
}
