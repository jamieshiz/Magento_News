<?php
 
class Irishtitan_News_Helper_Data extends Mage_Core_Helper_Abstract
{
    function getCategory() {
        $options = array(
            'articles' => 'Articles',
            'events' => 'Events',
            'videos' => 'Videos',
        );
        return $options;
    }
}
