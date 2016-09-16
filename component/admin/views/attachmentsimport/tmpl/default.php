<?php
/**
 * @package	 Joomla.Administrator
 * @subpackage  com_attachmentsimport
 *
 * @license	 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//JHtml::_('behavior.formvalidator');  // js validation
JHtml::_('behavior.keepalive');
//JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$input = $app->input;

$formAction = JRoute::_('index.php?option=com_attachmentsimport');

?>


<form action="<?php echo  $formAction ?>"
	  enctype="multipart/form-data"
	  method="post" name="adminForm" id="adminForm" class="form-validate">

	<div id="j-main-container">
		<div class="control-group">
			<label for="import_file" class="control-label">Import from File</label>
			<div class="controls">
				<input id="import_file" name="import_file" class="span5 input_box"
				       size="70" value="" type="text">
			</div>
		</div>
		<input type="hidden" name="task" value="import"/>
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
		
