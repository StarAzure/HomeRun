<?php
/**
 * @package     StarAzure
 * @subpackage  StarAzure Homerun
 * @copyright   Copyright (C) 2018 StarAzure. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

?>
<?php if (is_array($msgList) && !empty($msgList)) : ?>
	<div id="system-message-container">
		<div id="system-message">
			<?php foreach ($msgList as $type => $msgs) : ?>
				<div class="mt-3 alert alert-<?php echo $type; ?>">
					<?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
					<a href="#" class="close" data-dismiss="alert">×</a>

					<?php if (!empty($msgs)) : ?>
						<h4 class="alert-heading"><?php echo JText::_($type); ?></h4>
						<div>
							<?php foreach ($msgs as $msg) : ?>
								<p><?php echo $msg; ?></p>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
