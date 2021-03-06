<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_latestactionssite
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\LatestActionsSite\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\Component\Actionlogs\Administrator\Helper\ActionlogsHelper;
use Joomla\Component\Actionlogs\Administrator\Model\ActionlogsModel;
use Joomla\Registry\Registry;

/**
 * Helper for mod_latestactionssite
 *
 * @since  3.9.0
 */
abstract class LatestActionsSiteHelper
{
	/**
	 * Get a list of articles.
	 *
	 * @param   Registry  &$params  The module parameters.
	 *
	 * @return  mixed  An array of action logs, or false on error.
	 *
	 * @since   3.9.1
	 *
	 * @throws  Exception
	 */
	public static function getList(&$params)
	{
		/** @var ActionlogsModel $model */
		$model = new ActionlogsModel(['ignore_request' => true]);

		// Set the Start and Limit
		$model->setState('list.start', 0);
		$model->setState('list.limit', $params->get('count', 5));
		$model->setState('list.ordering', 'a.id');
		$model->setState('list.direction', 'DESC');

		$rows = $model->getItems();

		// Load all actionlog plugins language files
		ActionlogsHelper::loadActionLogPluginsLanguage();

		foreach ($rows as $row)
		{
			$row->message = ActionlogsHelper::getHumanReadableLogMessage($row);
		}

		return $rows;
	}

	/**
	 * Get the alternate title for the module
	 *
	 * @param   Registry  $params  The module parameters.
	 *
	 * @return  string    The alternate title for the module.
	 *
	 * @since   3.9.1
	 */
	public static function getTitle($params)
	{
		return Text::plural('MOD_LATESTACTIONSSITE_TITLE', $params->get('count', 5));
	}
}
