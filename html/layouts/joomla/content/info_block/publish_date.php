<?php
/**
 * @package     StarAzure
 * @subpackage  StarAzure HomeRun Template
 * @copyright   Copyright (C) 2018 StarAzure. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
?>
			<dd class="published">
				
				<time datetime="<?php echo JHtml::_('date', $displayData['item']->publish_up, 'c'); ?>" itemprop="datePublished">
					<?php 

					$day = JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_("d"))); 
					$mon = JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_("M"))); 
					$year = JText::sprintf(JHtml::_('date', $displayData['item']->publish_up, JText::_("Y"))); 
					
					?>
					
					<span class="badge badge-dark"><h5><?php echo $mon . " " . $year; ?></h5><h2 class=""><?php echo $day ?></h2></span>
				</time>
			</dd>