<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_attachmentsimport
 *
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.log.log');

/**
 * Attachments import model
 *
 * @since 3.6
 */
class AttachmentsimportModelAttachmentsimport extends JModelLegacy
{
	/**
	 * @var object JTable object
	 */
	protected $_table = null;

	/**
	 * @var object JTable object
	 */
	protected $_url = null;

	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	protected $_context = 'com_installer.install';

	public function import()
	{
		JLog::add('Non implémenté !', JLog::WARNING, 'jerror');
		return false;
	}
}
