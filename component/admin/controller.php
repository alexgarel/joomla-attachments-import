<?php
/**
 * @package	 Joomla.Administrator
 * @subpackage  attachments_import
 *
 * @license	 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/**
 * Attachmentsimport Controller
 *
 * @since  3.6
 */
class AttachmentsimportController extends JControllerLegacy
{
	/**
	 * Import the file
	 *
	 * @return  void
	 */
	public function import()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$model = $this->getModel('attachmentsimport');

		$result = $model->import();

		if ($result)
		{
			JLog::add('Import réalisé avec succès !', JLog::INFO, 'jerror');
		}
		else
		{
			JLog::add('Échec de l\'import !', JLog::ERROR, 'jerror');			
		}

		$this->display();
	}
}
