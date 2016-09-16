<?php
/**
 * @package	 Joomla.Administrator
 * @subpackage  attachments_import
 *
 * @license	 GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


$input = JFactory::getApplication()->input;


// standard way of getting extension name
$parts = explode('.', $input->get('extension'));
$component = $parts[0];


if (!JFactory::getUser()->authorise('core.manage', $component))
{
	throw new JAccessExceptionNotallowed(JText::_('JERROR_ALERTNOAUTHOR'), 403);
}

$controller = JControllerLegacy::getInstance('Attachmentsimport');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
