<?php
/**
 * @package	 Joomla.Administrator
 * @subpackage  attachments_import
 * @license	 GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorlds View
 *
 * @since  0.0.1
 */
class AttachmentsImportViewAttachmentsImport extends JViewLegacy
{
	/**
	 * The JForm object
	 *
	 * @var  JForm
	 */
	protected $form;
	
	/**
	 * Display the view.
	 *
	 * @param   string  $tpl  The name of the template file to parse
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	public function display($tpl = null)
	{
		$this->form = $this->get('Form');

		$errors = $this->get('Errors');
		if (count($errors))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}

		$this->addToolbar();
		return parent::display($tpl);
	}
 
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()	{
		JToolBarHelper::title(JText::_('COM_ATTACHMENTS_IMPORT_TITLE'));
		JToolBarHelper::apply('import', 'Check and import');
	}
}
