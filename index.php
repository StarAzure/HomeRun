<?php
/**
 * @package     StarAzure
 * @subpackage  StarAzure HomeRun Template
 *
 * @copyright   Copyright (C) 2018 StarAzure. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

//helper
$helper = require (__DIR__ . '/helper.php');
$helper->init($this);

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

//SA Remove possible junk stuff to make it fast and furious
// Remove Scripts
$doc = JFactory::getDocument();
JHtml::_('jquery.framework');
$dontInclude = array(
'/media/jui/js/jquery-noconflict.js',
'/media/jui/js/jquery-migrate.min.js'
);
foreach($doc->_scripts as $key => $script){
    if(in_array($key, $dontInclude)){
        unset($doc->_scripts[$key]);
    }
}

// Add js
//JHtml::_('script', 'popper.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));
//JHtml::_('script', 'jui/bootstrap.min.js', array('version' => 'auto', 'relative' => true));

// Add Stylesheets
//JHtml::_('stylesheet', 'bootstrap.min.css', array('version' => 'auto', 'relative' => true));
//JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));


// Logo file or site title param
if ($this->params->get('styleLogoImage'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('styleLogoImage') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<!-- Custom code -->
	<?php $helper->_('customCodeBeforeHead'); ?>
	<!-- // Custom code -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<jdoc:include type="head" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Custom style -->
	<?php $helper->addCustomStyle(); ?>
	<!-- Custom style-->
	<!-- Custom code -->
	<?php $helper->_('customCodeAfterHead'); ?>
	<!-- // Custom code -->
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction === 'rtl' ? ' rtl' : '');
?>">
	<!-- Custom code -->
	<?php $helper->_('customCodeBeforeBody'); ?>
	<!-- // Custom code -->

	<!-- Body -->
	<div class="body" id="top">

			<!-- Header -->
			<header class="header" id="header" role="banner">

				<div id="headerarea">

						<?php if ($this->countModules('navigation')) : ?>
							<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="starNav">
								<div class="container">
								<a class="navbar-brand mr-5" href="<?php echo $this->baseurl; ?>/">
									<?php echo $logo; ?>
									<?php if ($this->params->get('sitedescription')) : ?>
										<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
									<?php endif; ?>
								</a>

								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								 <i class="material-icons">menu</i>
								</button>

									<div class="collapse navbar-collapse" id="navbarNav">
											<jdoc:include type="modules" name="navigation" style="none" />

											<?php if ($this->countModules('nav-utility')) : ?>
											 <jdoc:include type="modules" name="nav-utility" style="xhtml" />
											<?php endif; ?>
											<!--
											<form class="form-inline my-2 my-lg-0">
												<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
												<button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
											</form>
											-->
									</div>
									</div>
							</nav>
						<?php endif; ?>

			</div>
			</header>


		<!-- FullScreen -->		
		<?php if ($this->countModules('fullScreen')) : ?>
			<div id="fullScr" class="p-0 container<?php echo ($params->get('fullContainer') ? '-fluid' : ''); ?>">
				<div class="fullScreen">
					<jdoc:include type="modules" name="fullScreen" style="xhtml" />
				</div>
			</div>
		<?php endif; ?>		
		<!-- Full Screen End -->


		<!-- Top A Start -->
		<?php if ($this->countModules('top-a')) : ?>
			<div id="topA" class="top-a <?php echo " py-".$params->get('top-a-padding');?>">
				<div class="p-0 container<?php echo ($params->get('top-a-width') ? '-fluid' : ''); ?>">
					<jdoc:include type="modules" name="top-a" style="xhtml" />
				</div>
			</div>
		<?php endif; ?>
		<!-- Top A End-->



		<!-- Top B Start -->
		<?php if ($this->countModules('top-b')) : ?>
			<div id="topB" class="top-b <?php echo " py-".$params->get('top-b-padding');?>">
				<div class="p-0 container<?php echo ($params->get('top-b-width') ? '-fluid' : ''); ?>">
				<jdoc:include type="modules" name="top-b" style="xhtml" />
				</div>
			</div>
		<?php endif; ?>
		<!-- Top B End-->

		<?php 
		$mainLayout = $params->get('layouts');
		switch ($mainLayout) {
			case "content-sidebara-sidebarb":
		        $sbAorder = 4;
		        $sbBorder = 5;
		        //$conOrder = 1;
		        break;
		    case "sidebara-content-sidebarb":
		        $sbAorder = 2;
		        $sbBorder = 4;
		        //$conOrder = 2;
		        break;
		    case "sidebara-sidebarb-content":
		        $sbAorder = 1;
		        $sbBorder = 2;
		        //$conOrder = 3;
		        break;
			}

			$conwidth = 12;
			($this->countModules('sidebar-a') == 0) ? $sbAwidth = 0 : $sbAwidth = 2;
			($this->countModules('sidebar-b') == 0) ? $sbBwidth = 0 : $sbBwidth = 2;

		?>

				<div id="mainContent" class="star content">
						<main id="content" role="main" class="">
							<!-- Begin Content -->
							<div class="container">
							<div class="row">
								<?php if ($this->countModules('sidebar-a')) : ?>
									<div class="col-md-<?php echo $sbAwidth . " order-" . $sbAorder;?>">									
										<jdoc:include type="modules" name="sidebar-a" style="xhtml" />				
									</div>
								<?php endif; ?>
								<div class="col-md-<?php echo $conwidth-($sbBwidth + $sbAwidth);?> order-3">
									<jdoc:include type="message" />
									<jdoc:include type="component" />
									<?php if ($this->countModules('breadcrumb')) : ?>
									<jdoc:include type="modules" name="breadcrumb" style="xhtml" />
									<?php endif; ?>
								</div>
								<?php if ($this->countModules('sidebar-b')) : ?>
									<div class="col-md-<?php echo $sbBwidth . " order-" . $sbBorder;?>">									
										<jdoc:include type="modules" name="sidebar-b" style="xhtml" />								
									</div>
								<?php endif; ?>
							</div>
							</div>
							<!-- End Content -->
						</main>
					</div>

		<!-- Bottom A Start -->
		<?php if ($this->countModules('bottom-a')) : ?>
			<div id="bottomA" class="bottom-a <?php echo " py-".$params->get('bot-a-padding');?>">
				<div class="p-0 container<?php echo ($params->get('bottom-a-width') ? '-fluid' : ''); ?>">
				<jdoc:include type="modules" name="bottom-a" style="xhtml" />
				</div>
			</div>
		<?php endif; ?>
		<!-- Bottom A End-->

		<!-- Bottom B Start -->
		<?php if ($this->countModules('bottom-b')) : ?>
			<div id="bottomB" class="bottom-b <?php echo " py-".$params->get('bot-b-padding');?>">
				<div class="p-0 container<?php echo ($params->get('bottom-b-width') ? '-fluid' : ''); ?>">
				<jdoc:include type="modules" name="bottom-b" style="xhtml" />
				</div>
			</div>
		<?php endif; ?>
		<!-- Bottom B End-->

	<!--Body Div Ends Below -->
	</div>

	<!-- Footer Section -->
	<footer class="footer" role="contentinfo">

		<!-- Footer Position Start -->
		<?php if ($this->countModules('footer')) : ?>
			<div id="starFooter" class="footer <?php echo " py-".$params->get('footer-padding');?>">
				<div class="p-md-0 container<?php echo ($params->get('footer-width') ? '-fluid' : ''); ?>">
				<jdoc:include type="modules" name="footer" style="xhtml" />
				</div>
			</div>
		<?php endif; ?>
		<!-- Footer Posiion End-->

		<!-- Copyright Position Start -->
			<div id="starCopyright" class="copyright <?php echo " py-".$params->get('copy-padding'). " text-" . $params->get('copy_text_color');?>">
				<div class="container<?php echo ($params->get('copy-width') ? '-fluid' : ''); ?>">

					<div class="row">
						<div class="col-sm-3 text-sm-left">
							<small>&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
							</small>
						</div>

						<div class="col-sm-6 copyright_menu">

							<?php $menu = JFactory::getApplication()->getMenu();
							$menu_items = $menu->getItems('menutype', ($params->get('foot_small_menu'))); ?>

							<ul class="nav copyright_menu text-sm-left">
								<?php foreach ($menu_items as $menu_item) :?>
									<li class="nav-item">
										 <a class="small nav-link text-<?php echo $params->get('copy_text_color');?>"
										  href="<?php echo $menu_item->link; ?>">
										 <?php echo $menu_item->title; ?>
										 </a>
									 </li>
								 <?php endforeach; ?>
								</ul>

						</div>
						<div class="col-sm-3 text-sm-right">
							<small><a href="#top" id="back-top" class="">
									<i class="material-icons">arrow_upward</i>
							</a></small>
						</div>

					</div>

				</div>
			</div>
		<!-- Copyright Position End-->

	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
	<!-- Custom code -->
	<?php $helper->_('customCodeAfterBody'); ?>
	<!-- // Custom code -->
</body>

</html>
