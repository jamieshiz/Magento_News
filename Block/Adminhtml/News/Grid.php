<?php

class Irishtitan_News_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('newsGrid');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('news/news')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
                'header'    => Mage::helper('news')->__('ID'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'id',
        ));

        $this->addColumn('title', array(
                'header'    => Mage::helper('news')->__('Title'),
                'align'     =>'left',
                'index'     => 'title',
        ));

        $this->addColumn('location', array(
                'header'    => Mage::helper('news')->__('Location'),
                'align'     =>'left',
                'index'     => 'location',
        ));

         $this->addColumn('start_date', array(
             'header'    => Mage::helper('news')->__('Start Date'),
             'align'     =>'left',
             'index'     => 'start_date',
             'type'      => 'datetime',
             'width'             => 1,
             'type'              => 'datetime',
             'align'             => 'center',
             'default'           => $this->__('N/A'),
             'html_decorators'   => array('nobr')
        ));

        $this->addColumn('status', array(
                'header'    => Mage::helper('news')->__('Status'),
                'align'     =>'left',
                'index'     => 'status',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
       return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
