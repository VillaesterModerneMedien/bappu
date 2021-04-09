<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$attributes = array();

if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
}

if ($item->anchor_css)
{
	$attributes['class'] = $item->anchor_css;
}

if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}


$position = strpos($item->title, '||');
$newTitle = substr($item->title, 0, $position - 1);
$linktype = $newTitle;

if ($item->menu_image && $module->id != 'menu-mobile')
{
	if ($item->menu_image_css)
	{
		$image_attributes['class'] = $item->menu_image_css . ' svg';
		$linktype = JHtml::_('image', $item->menu_image, $newTitle, $image_attributes);
	}
	else
	{
		//$linktype = JHtml::_('image', $item->menu_image, $item->title);
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $newTitle . '" class="menuIcon svg">';
	}

	if ($item->params->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $newTitle . '</span>';
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
elseif ($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

echo JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);
