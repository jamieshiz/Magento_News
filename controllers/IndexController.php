<?php

class Irishtitan_News_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        //$this->getLayout()->getBlock('head')->setTitle('RAVE News');
        $newsByCategory = array();
        $featured = 0;
        $time = mktime();
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        // Look up news & events
        $result=$write->query("SELECT * from rave_news where ((category LIKE '%events%' && start_date > 1404246580) OR (category != 'events')) AND status = 1 order by start_date desc;");
        while ($row = $result->fetch() ) {
            // Build array grouped by category
            if (strpos($row['category'],'videos') !== false) {
                $newsByCategory['videos'][$row['start_date']] = $row;
            }

            if (strpos($row['category'],'articles') !== false) {
                $newsByCategory['articles'][$row['start_date']] = $row;
            }

            if (strpos($row['category'],'events') !== false) {
                $newsByCategory['articles'][$row['start_date']] = $row;
            }

            // Build array of all news
            $allnews[$row['start_date']] = $row;
            // Set Featured Content
            if(!($featured) && $row['featured'] == 1) {
                $featured = $row;
            }
        }

        // Sort Events with Upcoming First
        ksort($newsByCategory['events']);

        $this->loadLayout();
        // Set Breadcrumbs
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home', array('label'=>Mage::helper('cms')->__('Home'),
            'title'=>Mage::helper('cms')->__('Home Page'), 'link'=>Mage::getBaseUrl()));
        $breadcrumbs->addCrumb('news', array('label'=>'News', 'title'=>'News'));
        // Set Data for News Pages
        $block = $this->getLayout()->getBlock('news');
        $block->setData('bycategory', $newsByCategory);
        $block->setData('allnews', $allnews);
        // Set Featured Article
        $block = $this->getLayout()->getBlock('featured');
        $block->setData('featured', $featured);
        $this->renderLayout();

    }
}
