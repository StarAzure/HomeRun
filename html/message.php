<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Template.StarAzure
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function renderMessage($msgList)
{
	// Initialise variables.
		$buffer = null;
		$lists = null;
 
		// Get the message queue
		$messages = JFactory::getApplication()->getMessageQueue();
 
		// Build the sorted message list
		if (is_array($messages) && !empty($messages))
		{
			foreach ($messages as $msg)
			{
				if (isset($msg['type']) && isset($msg['message']))
				{
					$lists[$msg['type']][] = $msg['message'];
				}
			}
		}
 
		// Build the return string
		$buffer = array();
 
		// If messages exist render them
		if (is_array($lists)) {
			$buffer[] = '<div class="alert-messages mt-4">';
			$first = 1;
			foreach ($lists as $type => $msgs) {
				if (count($msgs)) {
					$buffer[] = '<div role="alert" class="p-3 alert alert-dismissible fade show alert-'.strtolower( $type ).'">';
					if ($first) {
						$buffer[] = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>';
					}
					$first = 0;
					if (count($msgs) > 1) {
						$buffer[] = '<ul>';
						foreach ($msgs as $msg) {
							$buffer[] = '<li>'.$msg.'</li>';
						}
						$buffer[] = '</ul>';
					} else {
						$buffer[] = reset( $msgs );
					}
					$buffer[] = '</div>';
				}
			}
			$buffer[] = '</div>';
		}
 
		return implode( "\n", $buffer );
	}