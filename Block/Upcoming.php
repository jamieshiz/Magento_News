<?php

class Irishtitan_News_Block_Upcoming extends Mage_Core_Block_Template
{
    public function _construct() {
        parent::_construct();
        //template
        $this->setTemplate('news/upcoming.phtml');
    }

    public function getNews() {
        $time = mktime();
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        // Look up upcoming adventures
        $result=$write->query("SELECT * from rave_news where start_date > $time order by start_date");
        while ($row = $result->fetch() ) {
            $images = json_decode($row['images']);
        if($images->images_one) {
            $events[$row['id']]['img'] =  $images->images_one;
        } else {
            $events[$row['id']]['img'] =  NULL;
        }   
        // Format Date
        if($row['end_date'] != NULL) {
            $newDate = date('F jS', $row['start_date']) . ' - ' . date('F dS, Y', $row['end_date']);
        } else {
            $newDate = date('F jS, Y', $row['start_date']);
        }   
        $events[$row['id']]['title'] =  $row['title'];
        $events[$row['id']]['date'] = $newDate;
        $events[$row['id']]['link'] = '/news/event/location/id/'.$row['id'];
        }
       return $events;
    }

}

