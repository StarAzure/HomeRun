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

<div class="starloginPage">
	<div class="mt-5 pt-3 px-5 login<?php echo $this->pageclass_sfx; ?>">
		<div class="row">
			<div class="col-md-6">
				<?php if ($this->params->get('show_page_heading')) : ?>
				<div class="page-header">
					<h1>
						<?php echo $this->escape($this->params->get('page_heading')); ?>
					</h1>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-md-6">
			 <span class="loginLogo"><span>
			</div>
		</div>

		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		<div class="login-description">
		<?php endif; ?>

			<?php if ($this->params->get('logindescription_show') == 1) : ?>
				<?php echo $this->params->get('login_description'); ?>
			<?php endif; ?>

			<?php if ($this->params->get('login_image') != '') : ?>
				<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT'); ?>"/>
			<?php endif; ?>

		<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
		</div>
		<?php endif; ?>

		<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal well">

			<fieldset>
				<?php foreach ($this->form->getFieldset('credentials') as $field) : ?>
					<?php if (!$field->hidden) : ?>
						<div class="control-group mt-4">
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
							<div class="controls mt-1">
								<?php echo $field->input; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php if ($this->tfa) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getField('secretkey')->label; ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getField('secretkey')->input; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
				<div  class="control-group form-check form-check-inline">
					<label class="form-check-label">
						<input id="remember" type="checkbox" name="remember" class="inputbox my-3" value="yes"/>
						<?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?>
					</label>
				</div>
				<?php endif; ?>

				<div class="control-group mb-3">
					<div class="controls">
						<button type="submit" class="btn btn-lg btn-block btn-primary">
							<i style="vertical-align: middle;" class="mr-2 material-icons">fingerprint</i><?php echo JText::_('JLOGIN'); ?>
						</button>
					</div>
				</div>

				<?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem'))); ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($return); ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</fieldset>
		</form>
	</div>
	<div class="mb-5">
		<ul class="list-group">
			<li class="list-group-item borderless pl-5">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
				<i style="vertical-align: middle;" class="mr-2 material-icons">vpn_key</i><?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
			</li>
			<li class="list-group-item borderless pl-5">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
				<i style="vertical-align: middle;" class="mr-2 material-icons">help_outline</i><?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
			</li>
			<?php
			$usersConfig = JComponentHelper::getParams('com_users');
			if ($usersConfig->get('allowUserRegistration')) : ?>
			<li class="list-group-item pl-5">
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<i style="vertical-align: middle;" class="mr-2 material-icons">recent_actors</i><?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?></a>
				<a class="ml-4 btn btn-sm btn-success" href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
					<i style="vertical-align: middle;" class="mr-2 material-icons">mouse</i><?php echo JText::_('REGISTER'); ?></a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
