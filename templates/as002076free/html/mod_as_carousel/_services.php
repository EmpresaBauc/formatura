<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_camera_slideshow
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
	$item_images = json_decode($item->images);
	if($layout!='edit'){
		$canEdit = $item->params->get('access-edit');
		JHtml::addIncludePath(JPATH_BASE.'/components/com_content/helpers');
	}
	$user = JFactory::getUser(); ?>

<div class="item_content">
<?php if ($canEdit) : ?>
<!-- Icons -->
<div class="item_icons btn-group pull-right"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-cog"></i> <span class="caret"></span> </a>
	<ul class="dropdown-menu">
		<?php if ($canEdit) : ?>
		<li class="edit-icon"> <?php echo JHtml::_('icon.edit', $item, $params); ?> </li>
		<?php endif; ?>
	</ul>
</div>
<?php endif;

$item_heading = $params->get('item_heading', 'h4');
	
if ($params->get('item_title')) : ?>
<<?php echo $item_heading; ?> class="item_title item_title__<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $item->link != '') : ?>
	<a href="<?php echo $item->link;?>"><?php echo $item->title;?></a>
	<?php else : ?>
	<?php echo $item->title; ?>
	<?php endif; ?>
</<?php echo $item_heading; ?>>
<?php endif;
	
if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif;

if ($params->get('show_tags', 1) && !empty($item->tags)) :
$item->tagLayout = new JLayoutFile('joomla.content.tags');

echo $item->tagLayout->render($item->tags->itemTags);
endif;

if ($params->get('published')) : ?>
	<time datetime="<?php echo JHtml::_('date', $item->publish_up, 'Y-m-d H:i'); ?>" class="item_published">
		<?php echo JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_TPL1')); ?>
	</time>
<?php endif;

echo $item->beforeDisplayContent;

echo $item->introtext; ?>
	
<!-- Read More link -->
<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
	$readMoreText = JText::_('TPL_COM_CONTENT_READ_MORE');
		if ($item->alternative_readmore){
			$readMoreText = $item->alternative_readmore;
		}
	echo '<a class="btn btn-info readmore" href="'.$item->link.'"><span>'. $readMoreText .'</span></a>';
endif; ?>

</div>