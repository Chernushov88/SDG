<?php
/**
 * @package Content - Related News
 * @version 1.7.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;
ImageHelper::setDefault($_params);
//var_dump($article_id); die("abc");
if (count($items)){
	if ((int)$this->params->get('usecss', 1)){
		$css_url = JURI::root() . 'plugins/content/relatednews/assets/css/relatednews.css';
		$document = JFactory::getDocument();
		$document->addStyleSheet($css_url);
	}
	if ($this->params->get('title')){
		echo '<div class="related-items-title">';
		echo $this->params->get('title');
		echo '</div>';
	}
	echo '<ul class="related-items">';
	foreach ($items as $id => $item) { 
		if($item->id != $article_id){?>
			<li class="related-item">
			<?php
			if ((int)$this->params->get('item_image_display', 1)){ ?>
				<a class="related-item-image-link" href="<?php echo $item->link; ?>" <?php echo RelatedBaseHelper::parseTarget($_params->get('item_link_target'));?>>
					<?php $img = RelatedBaseHelper::getArticleImage($item, $_params);
	    				  echo RelatedBaseHelper::imageTag($img);?>
				</a>
			<?php }?>
			<?php
			if ((int)$this->params->get('item_date_display', 1)==1): ?>
				<a href="<?php echo $item->link; ?>" <?php echo RelatedBaseHelper::parseTarget($_params->get('item_link_target'));?>>
				<span class="related-item-date"><?php echo JHtml::date($item->created, 'Y-m-d - h:i:s'); ?></span> - </a>
			<?php
			endif;
			?>
				<a href="<?php echo $item->link; ?>" <?php echo RelatedBaseHelper::parseTarget($_params->get('item_link_target'));?>>
					<?php echo $item->title; ?>
				</a>
			<?php
			if ((int)$_params->get('item_date_display', 1) == 2): ?>
				<a href="<?php echo $item->link; ?>" <?php echo RelatedBaseHelper::parseTarget($_params->get('item_link_target'));?>> - 
				<span class="related-item-date"><?php echo JHtml::date($item->created, 'Y-m-d - h:i:s'); ?></span></a>
			<?php
			endif;
			?>
			</li>
	<?php
	}}
	echo '</ul>';
}

?>