<?php
/**
 * @package     StarAzure
 * @subpackage  StarAzure HomeRun Template
 * @copyright   Copyright (C) 2018 StarAzure. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="starRegisterPage">
	<div class="my-5 p-4 registration<?php echo $this->pageclass_sfx; ?>">
		<?php if ($this->params->get('show_page_heading')) : ?>
			<div class="page-header">
				<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
			</div>
		<?php endif; ?>

		<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
			<?php // Iterate through the form fieldsets and display each one. ?>
			<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
				<?php $fields = $this->form->getFieldset($fieldset->name); ?>
				<?php if (count($fields)) : ?>
					<fieldset>
					<?php // If the fieldset has a label set, display it as the legend. ?>
					<?php if (isset($fieldset->label)) : ?>
						<legend><?php echo JText::_($fieldset->label); ?></legend>
					<?php endif; ?>
					<?php // Iterate through the fields in the set and display them. ?>
					<?php foreach ($fields as $field) : ?>
						<?php // If the field is hidden, just display the input. ?>
						<?php if ($field->hidden) : ?>
							<?php echo $field->input; ?>
						<?php else : ?>
							<div class="control-group">
								<div class="control-label">
								<?php echo $field->label; ?>
								<?php if (!$field->required && $field->type !== 'Spacer') : ?>
									<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
								<?php endif; ?>
								</div>
								<div class="controls mb-3">
									<?php echo $field->input; ?>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					</fieldset>
				<?php endif; ?>
			<?php endforeach; ?>
			<div class="my-3 control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary btn-block validate"><i style="vertical-align: middle;" class="mr-2 material-icons">folder_shared</i><?php echo JText::_('JREGISTER'); ?></button>
					<a class="btn btn-danger btn-block" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>">  <i style="vertical-align: middle;" class="mr-2 material-icons">cancel</i> <?php echo JText::_('JCANCEL'); ?></a>
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="registration.register" />
				</div>
			</div>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	</div>
</div>

