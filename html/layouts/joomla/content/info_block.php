<?php
/**
 * @package     StarAzure
 * @subpackage  StarAzure HomeRun Template
 * @copyright   Copyright (C) 2018 StarAzure. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$blockPosition = $displayData['params']->get('info_block_position', 0);

?>

<div class="row">
  <div class="col-sm-9">
    		<dt class="article-info-term invisible" style="display:none">
				<?php if ($displayData['params']->get('info_block_show_title', 1)) : ?>
					<?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?>
				<?php endif; ?>
			</dt>
    <div class="row">
      <div class="col-4 col-sm-6">
        
		<?php if ($displayData['params']->get('show_publish_date')) : ?>
			<?php echo $this->sublayout('publish_date', $displayData); ?>
		<?php endif; ?>

		<?php if ($displayData['params']->get('show_hits')) : ?>
			<span class="badge badge-info">	<?php echo $this->sublayout('hits', $displayData);?></span>
		<?php endif; ?>


      </div>
      <div class="col-8 col-sm-6">
        
			<?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
				<?php echo $this->sublayout('author', $displayData); ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
				<?php echo $this->sublayout('parent_category', $displayData); ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_category')) : ?>
				<?php echo $this->sublayout('category', $displayData); ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_associations')) : ?>
				<?php echo $this->sublayout('associations', $displayData); ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_create_date')) : ?>
				<?php echo $this->sublayout('create_date', $displayData); ?>
			<?php endif; ?>

			<?php if ($displayData['params']->get('show_modify_date')) : ?>
				<?php echo $this->sublayout('modify_date', $displayData); ?>
			<?php endif; ?>


      </div>
    </div>
  </div>
</div>


<hr class="p2">






