<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_attachmentsimport
 *
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.log.log');

use Joomla\Input\Input;
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
				$data["_linenum"] = $lineNum;
				yield $data;
			}
			elseif ($entry)  // means wrong json
			{
				JLog::add('Malformed json at line ' . $lineNum. ' : ' . json_last_error_msg(),
						  JLog::WARNING, 'jerror');
			}
		} while ($entry);
	}

	public function createContent($data, $name, $model, $fpath)
	{
		$id = null;
		$fields = $data["fields"];
		# FIXME
		$fields["catid"] = 2;

		// trick app input
		$savedInput = $app->input;
		$contentSource = array();
		$app->input = new Input($contentSource);  // source & options
		$app->input->set("task", "save");
		// use a form to validate and get all values
		$form = new JForm($name);
		$form->loadFile($fpath);
		$lineNum = $data["_linenum"] || "?";

		if ($form->validate($fields))
		{
			$fdata = array();
			foreach ($form->getFieldSet() as $field) {
				$fname = $field->name;
				if (key_exists($fname, $fields)) {
					$fdata[$fname] = $fields[$fname];
				}
				else
				{
					$fdata[$fname] = null;  // for now
				}
			}
			if ($model->save($fdata)){
				$id = $model->getState($name . '.id');
			}
			else
			{
				JLog::add(
					'Malformed json at line ' . $lineNum. ' : ' .
					implode("\n", $model->getErrors()),
					JLog::WARNING, 'jerror');
			}
		}
		else
		{
			JLog::add(
				'Malformed json at line ' . $lineNum. ' : ' . var_dump($form->getErrors()),
				JLog::WARNING, 'jerror');
		}

		// restore app input
		$app->input = $savedInput;
		return $id;
	}


	public function import($fpath)
	{
		$id_map = array();
		$article_model = null;
		$app = JFactory::getApplication();

		foreach ($this->iterdata($fpath) as  $data) {
			$fpath = $name = $model = null;

			// get type
			switch ($data["type"])
			{
				case "article":
					if ($article_model == null)
					{
						require_once JPATH_ADMINISTRATOR . '/components/com_content/models/article.php';
						$article_model = new ContentModelArticle();
					}
					$model = $article_model;
					$name = "article";
					$fpath = JPATH_ADMINISTRATOR . '/components/com_content/models/forms/article.xml';

					break;
			}
			$id = $this->createContent($data, $name, $model, $fpath);

			JLog::add('Created ' . $id . ' !', JLog::WARNING, 'jerror');

			break; // for now, TESTING


		}
		JLog::add('Not implemented !', JLog::WARNING, 'jerror');
		return false;
	}
}
