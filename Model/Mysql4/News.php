<?php

class  Irishtitan_News_Model_Mysql4_News extends Mage_Core_Model_Mysql4_Abstract
{
        public function _construct()
        {
                $this->_init('news/news', 'id');
        }
}
