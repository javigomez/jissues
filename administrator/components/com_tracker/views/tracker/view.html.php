<?php
/**
 * @package     JTracker
 * @subpackage  com_tracker
 *
 * @copyright   Copyright (C) 2012 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Default view class for the tracker component
 *
 * @package     JTracker
 * @subpackage  com_tracker
 * @since       1.0
 */
class TrackerViewTracker extends JViewLegacy
{
	protected $filterCategory = '';

	/**
	 * @var JInput
	 */
	protected $input = null;

	protected $project;

	protected $lists;

	/**
	 * @var JRegistry
	 */
	protected $fields = null;

	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 *
	 * @see     fetch()
	 * @since   12.2
	 */
	public function display($tpl = null)
	{
		$this->input = JFactory::getApplication()->input;

		$this->project = new stdClass;
		$this->project->id = 0;

		$this->project->id = $this->input->post->getUint('project_id');

		$this->lists = new JRegistry;

		if ($this->project->id)
		{
			$this->lists->set('categories', JHtmlProjects::listing('categories', 0, 'com_tracker.' . $this->project->id . '.categories'));
			$this->lists->set('textfields', JHtmlProjects::listing('com_tracker.' . $this->project->id . '.textfields'));
			$this->lists->set('fields', JHtmlProjects::listing('com_tracker.' . $this->project->id . '.fields'));
			$this->lists->set('checkboxes', JHtmlProjects::listing('com_tracker.' . $this->project->id . '.checkboxes'));
		}

		parent::display($tpl);
	}
}
