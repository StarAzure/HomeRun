<?php
/**
 * @package     StarAzure
 * @subpackage  StarAzure HomeRun Template
 * @copyright   Copyright (C) 2018 StarAzure. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
$params = $displayData->params;
?>

<?php $images = json_decode($displayData->images); ?>
	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
		<?php $imgfloat = empty($images->float_fulltext) ? $params->get('float_fulltext') : $images->float_fulltext; ?>

		<div class="card mb-3 align-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img class="img-fluid"  
		<?php if ($images->image_fulltext_caption) :
			echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_fulltext_caption) . '"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/> 
		</div>
		<hr>
	<?php endif; ?>
