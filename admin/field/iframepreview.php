<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Framework.
 *
 * @since  2.5
 */
class JFormFieldiframepreview extends JFormField
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'iframePreview';
	protected function getInput()
	{
				
			$messageHtml = '';

            $map_url = "http://starazure.com/updates/themes/starazure_offers.xml";
     
            if (($response_xml_data = file_get_contents($map_url))===false){
                $messageHtml = "Error fetching update XML from StarAzure server. Please check your connection.\n";
            } 

            else 
            {
               libxml_use_internal_errors(true);
               $offers = simplexml_load_string($response_xml_data);
               if (!$offers) {
                   echo "Error loading update XML from StarAzure server. Please check your connection.\n";
                   foreach(libxml_get_errors() as $error) {
                       $messageHtml = $error->message;
                   }
               } 

            }

            $messageHtml_1 =  '<div id="custom-style-preview" class="hero-unit jumbotron"> <h2>Customizer is only available in PRO version</h2> <p><a href="http://www.starazure.com/joomla-templates" target="_blank" class="btn btn-primary btn-large btn-spcl" role="button">Get Pro Version</a></span> </p> ';

		    $messageHtml_2 =  $offers->message.'</p>';


            $mainHtml = $messageHtml_1 . '<h2><div style="padding:20px" class="alert alert-info alert-auto"><div class="alert-message">'.$offers->coupons->themes->offer . '<span class="alert alert-warning">'. $offers->coupons->themes->code .'</span> and get '.$offers->coupons->themes->name.'. You pay <span class="alert alert-danger"><span class="striket">' .$offers->coupons->themes->price . '</span><span class="text-second"> '.$offers->coupons->themes->discounted.'</span></div></div></h2>'. $messageHtml_2 .

             '</div>';

                return  $mainHtml;

	}

	/**
	 * Method to get the field label markup for a spacer.
	 * Use the label text or name from the XML element as the spacer or
	 * Use a hr="true" to automatically generate plain hr markup
	 *
	 * @return  string  The field label markup.
	 *
	 * @since   11.1
	 */
	protected function getLabel()
	{
		return '';
	}

	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$doc = JFactory::getDocument();
		// add custom-style-style
		$custom_style_file = dirname(dirname(__DIR__)) . '/css/custom-styles.tpl.css';
		$custom_style_tpl = is_file($custom_style_file) ? file_get_contents($custom_style_file) : '';
		$script = 'var custom_style_tpl = ' . json_encode($custom_style_tpl);
		$script .= ', site_root_url = "' . JUri::root() . '";';
		$doc->addScriptDeclaration ($script);
		return parent::setup($element, $value, $group);
	}

}
