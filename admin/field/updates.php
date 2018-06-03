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


class JFormFieldUpdates extends JFormField{

    protected $type = 'Updates';

    protected function getInput(){


        $currentDir = dirname(dirname(__DIR__));
        $templatename = substr($currentDir, strrpos($currentDir, 'starazure_') + 10);

        $messageHtml = '';

            $map_url = "http://starazure.com/updates/themes/starazure_update.xml";
            $local_url = JURI::root()."templates/starazure_".$templatename."/templateDetails.xml";
            $previewimage = JURI::root()."templates/starazure_".$templatename."/template_preview.png";

            if (($response_xml_data = file_get_contents($map_url))===false){
                $messageHtml = "Error fetching update XML from StarAzure server. Please check your connection.\n";
            } 

            else 
            {
               libxml_use_internal_errors(true);
               $updates = simplexml_load_string($response_xml_data);
               if (!$updates) {
                   echo "Error loading update XML from StarAzure server. Please check your connection.\n";
                   foreach(libxml_get_errors() as $error) {
                       $messageHtml = $error->message;
                   }
               } 

               else {

                    if (($local_xml_data = file_get_contents($local_url))===false)
                    {
                        echo "Error fetching template xml from your site. Please check your connection.\n";
                     } 
                   else {
                    $extension = simplexml_load_string($local_xml_data);

                        if (floatval($extension->version) < floatval($updates->themes->$templatename->version))
                        {
                    
                            $messageHtml = '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                            <h3 class="plain text-red"><span class="icon-cancel" aria-hidden="true"></span>  New version available. Your version '.$extension->version.' is outdated.</h3></div> <hr>';
                        }
                        else
                        {
                            $messageHtml = '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

  <h3 class="plain text-green"><span class="icon-save" aria-hidden="true"></span>  Oh yea! You have the latest version - '.$extension->version.'</h3></div> <hr> <h4>Please make sure this template was purchased and/or downloaded from our site to comply with our terms of service.</h4> ';
                        }
                    }

                    //return  $updates->themes->$templatename->version;

               }
            }

            $mainHtml = '<div class="star-update">
                  <h3>StarAzure - '.$templatename .' theme - update information.</h3> 
                  <span class="tpl-preview"><img width="150px" src="'. $previewimage .'" alt="StarAzure"></span>
                  <div class="tpl-info">
                    <p><strong>Important: </strong> Keep your site fast and updated by downloading the latest available versions from our site. Do not download pirated versions from the internet as it is against our terms of service. We provide free versions for you to download. The paid versions are priced very fair and will support future development of our products. We take a lot of time and effort to bring these products to you. Please support us by buying a subscription if you like our products.
                    </p>

                    <hr>'.  $messageHtml .

                   '<ul class="quick-links">
      
                      <li><span class="box-item"><h3 class="plain"><span class="text-info">Latest available version is: </span> <span class="text-green">'. $updates->themes->$templatename->version.'</span></h3></li>

                      <li><span class="box-item"><h3 class="plain"><span class="text-info">Your version is: </span> <span class="text-red">'. $extension->version.'</span></h3></li>

                      <li><span class="box-item"><a href="http://www.StarAzure.com/download" title="StarAzure" target="_blank" ref="noflow"><i class=" fa fa-download"></i>Download New Version</a></span></li>


                    </ul>
                  </div>
                </div>';

                return  $mainHtml;
            //return $messageHtml;


    }




}