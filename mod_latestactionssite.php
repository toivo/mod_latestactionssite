<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_latestactionssite
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

// minimum Joomla version
$minimum	= '3.9';
$version	= new JVersion;
$short		= $version->getShortVersion();
$main	 	= substr($short, 0, 1);
$cmsversion	= JText::_('MOD_LATESTACTIONSSITE_SITE_VERSION') . $short;

if (!$version->isCompatible($minimum))
{
	$warn	= JText::_('MOD_LATESTACTIONSSITE_MINIMUM_VERSION') . $minimum . '.';
	$app->enqueueMessage($name . ': ' . $warn . ' ' . $cmsversion, 'warning');	
	return;
}

// include dependencies J3
if ($main == 3)
{
	JLoader::register('LatestActionsSiteHelper', __DIR__ . '/helper.php');

	$list = LatestActionsSiteHelper::getList($params);

	if ($params->get('automatic_title', 0))
	{
		$module->title = LatestActionsSiteHelper::getTitle($params);
	}

	require ModuleHelper::getLayoutPath('mod_latestactionssite', $params->get('layout', 'default'));
}

// include dependencies J4
use Joomla\Module\LatestActionsSite\Site\Helper\LatestActionsSiteHelper;

if ($main == 4)
{
	$list = LatestActionsSiteHelper::getList($params);
	
	if ($params->get('automatic_title', 0))
	{
		$module->title = LatestActionsSiteHelper::getTitle($params);
	}

	require ModuleHelper::getLayoutPath('mod_latestactionssite', $params->get('layout', 'default'));
}