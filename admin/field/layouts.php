<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.html.html');
jimport('joomla.form.formfield');


class JFormFieldLayouts extends JFormField{

    protected $type = 'Layouts';

    protected function getInput(){

        $html = '';

    
        ($this->value == 'content-sidebara-sidebarb') ? $colLeft = ' active': $colLeft = '';
        ($this->value == 'sidebara-content-sidebarb') ? $colMiddle = ' active': $colMiddle = '';
        ($this->value == 'sidebara-sidebarb-content') ? $colRight = ' active': $colRight = '';

        $html .= "<div id='layout-selector'>";
            $html .= "<span class='content-sidebara-sidebarb".$colLeft."'>Three Column Left</span>";
            $html .= "<span class='sidebara-content-sidebarb".$colMiddle."'>Three Column Middle</span>";
            $html .= "<span class='sidebara-sidebarb-content".$colRight."'>Three Column Right</span>";
        $html .= "</div>";

        $html .= "<input type='hidden' name='".$this->name."' id='".$this->id."' value='".$this->value."' />";

        return $html;

    }


}