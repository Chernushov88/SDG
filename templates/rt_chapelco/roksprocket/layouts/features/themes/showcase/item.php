<?php
/**
 * @version   $Id: item.php 9136 2013-04-05 11:09:53Z arifin $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 * @var $item RokSprocket_Item
 */

if(!function_exists('word_count')){
function word_count($str, $asArray = 0){
	$count = preg_match_all("/\=|\d{1,}|\p{L}[\p{L}\p{Mn}\p{Pd}'\x{2019}]*/u", $str, $matches);

	if ($asArray == 2){
		$positions = array();
		$cursor = 0;
		foreach($matches[0] as $value){
			$positions[$cursor] = $value;
			$cursor += strlen($value) + 1;
		}

		return $positions;
	} else {
		return $count;
	}
}
}

?>

<li class="sprocket-features-index-<?php echo $index;?><?php echo (!($index - 1)) ? ' active' : '';?>" data-showcase-pane>
	<div class="sprocket-features-container">
		<?php
		if ($item->getPrimaryImage()) :
		?>
		<div class="sprocket-features-img-container">
			<?php if ($item->getPrimaryLink()) : ?>
				<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>"><img src="<?php echo $item->getPrimaryImage()->getSource(); ?>" alt="" style="max-width: 100%; height: auto;" /></a>
			<?php else: ?>
				<img src="<?php echo $item->getPrimaryImage()->getSource(); ?>" alt="" />
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="sprocket-features-content">
			<?php if ($parameters->get('features_show_title') && $item->getTitle()) : ?>
				<h2 class="sprocket-features-title">
					<?php if ($item->getPrimaryLink()) : ?>
						<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>">
							<?php
							$icon = "";
							if ($item->getParam('features_item_icon') != '-none-') $icon = "<span class='rt-feature-bubble " . $item->getParam('features_item_icon') . "'></span>";			
									$item_title = $item->getTitle();
			                		$words = word_count($item_title, 2);
			                		$first_word = array_shift($words);
			                		$item_title = '<span class="title-1">' . $first_word . '</span>'.$icon.'<span class="title-2">'.implode($words, " ").'</span>';
			                		echo $item_title;
			                ?>
						</a>
					<?php else: ?>
						<?php
						$icon = "";
						if ($item->getParam('features_item_icon') != '-none-') $icon = "<span class='rt-feature-bubble " . $item->getParam('features_item_icon') . "'></span>";			
								$item_title = $item->getTitle();
		                		$words = word_count($item_title, 2);
		                		$first_word = array_shift($words);
		                		$item_title = '<span class="title-1">' . $first_word . '</span>'.$icon.'<span class="title-2">'.implode($words, " ").'</span>';
		                		echo $item_title;
		                ?>
					<?php endif; ?>
				</h2>
			<?php endif; ?>
			<?php if ($parameters->get('features_show_article_text') && ($item->getText() || $item->getPrimaryLink())) : ?>
				<div class="sprocket-features-desc">
					<span>
						<?php echo $item->getText(); ?>
					</span>
					<?php if ($item->getPrimaryLink()) : ?>
					<a href="<?php echo $item->getPrimaryLink()->getUrl(); ?>" class="readon"><span><?php rc_e('READ_MORE'); ?></span></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</li>
