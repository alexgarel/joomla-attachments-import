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

	protected function iterdata($fpath) {
		// check file exists
		if (!file_exists($fpath)) {
			JLog::add('File ' . $fpath . ' does not exists !', JLog::ERROR, 'jerror');
			$handle = null;
		}
		// open file
		$handle = fopen($fpath, 'r');
		$lineNum = 0;
		$blank = array(null);
		do
		{
			$data = false;
			$entry = fgets($handle);
			$lineNum += 1;
			if ($entry) {
				$data = json_decode($entry, true);
			}
			if ($data) {
				yield $data;
			}
			elseif ($entry)  // means wrong json
			{
				JLog::add('Malformed json at line ' . $lineNum. ' : ' . json_last_error_msg(),
						  JLog::WARNING, 'jerror');
			}
		} while ($entry);
	}

	public function import($fpath)
	{
		$id_map = array();

		foreach ($this->iterdata($fpath) as  $data) {

			// get type
			// get id

		}
		JLog::add('Not implemented !', JLog::WARNING, 'jerror');
		return false;
	}
}
