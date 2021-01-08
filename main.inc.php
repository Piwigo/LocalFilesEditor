<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based photo gallery                                    |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2014 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery team    http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+

/*
Plugin Name: LocalFiles Editor
Version: auto
Description: Edit local files from administration panel
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=144
Author: Piwigo team
Author URI: http://piwigo.org
Has Settings: webmaster
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
define('LOCALEDIT_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');

add_event_handler('loc_end_themes_installed', 'localfiles_css_link');
function localfiles_css_link()
{
  global $template;

  load_language('plugin.lang', LOCALEDIT_PATH);

  $template->set_prefilter('themes', 'localfiles_css_link_prefilter');
}

function localfiles_css_link_prefilter($content, &$smarty)
{
  $search = '{if $theme.DEACTIVABLE}';
  $replacement = '{if $theme.STATE eq "active"}<a href="admin.php?page=plugin-LocalFilesEditor-css&amp;theme={$theme.ID}" class="dropdown-option icon-brush">{\'Customize CSS\'|translate}</a>{/if}'.$search;

  return str_replace($search, $replacement, $content);
}
?>
