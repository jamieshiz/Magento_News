<?php
class Namespace_News_EventsController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $id = $this->getRequest()->getParam('id');
        //Load Event by Id
        $content = Mage::getModel('news/news')->load($id);
        $content['details'] = NULL;

        //Format Details
        if($content['location']){
            $content['details'] .= '<p class="details">' . $content['location'] . '</p>';
        }
        if($content['address']){
            $content['details'] .= '<p class="details">' . $content['address'] . '</p>';
        }
        if($content['time']){
            $content['details'] .= '<p class="details">' . $content['time'] . '</p>';
        }

        // Check if Video
        if(strpos($content->video, 'vimeo')) {
            /* Vimeo Embed Code */
            $vid = substr($content->video, strrpos($content->video, '/')+1);
            $content['embed'] = '<iframe src="//player.vimeo.com/video/'.$vid.'" width="300" height="169" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        } else {
            /* Youtube Embed Code */
            /*$vid = substr($content->video, strrpos($content->video, 'v=')+2);*/
            $content['embed'] = '<iframe width="300" height="169" src="//www.youtube.com/embed/'.$content->video.'" frameborder="0" allowfullscreen></iframe>';
        }

        $this->loadLayout();
        // Set Breadcrumbs
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home', array('label'=>Mage::helper('cms')->__('Home'),
            'title'=>Mage::helper('cms')->__('Home Page'), 'link'=>Mage::getBaseUrl()));
        $breadcrumbs->addCrumb('news', array('label'=>Mage::helper('cms')->__('News'),
            'title'=>Mage::helper('cms')->__('News'), 'link'=>Mage::getBaseUrl() . 'news'));
        $breadcrumbs->addCrumb('event', array('label'=>$content->title, 'title'=>$content->title));
        $block = $this->getLayout()->getBlock('event');
        $block->setData('content', $content);
        $this->renderLayout();
    }
}
