<?php

class Namespace_News_Block_Adminhtml_News_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('news_form', array('legend'=>Mage::helper('news')->__('Item information')));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('news')->__('Status'),
            'required'  => true,
            'name'      => 'status',
            'values' => array('0' => 'Disabled', '1' => 'Enabled'),
        ));

        $fieldset->addField('featured', 'select', array(
            'label'     => Mage::helper('news')->__('Featured'),
            'name'      => 'featured',
            'values' => array('0' => 'No', '1' => 'Yes'),
        ));

        $fieldset->addField('image', 'image', array(
            'name'      => 'image',
            'label'     => Mage::helper('news')->__('Image'),
            'title'     => Mage::helper('news')->__('Image'),
            'required'  => false,
        ));

        $fieldset->addField('video', 'text', array(
            'name'      => 'video',
            'label'     => Mage::helper('news')->__('Video Link'),
            'title'     => Mage::helper('news')->__('Video Link'),
            'required'  => false,
        ));

        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('news')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));

        $fieldset->addField('category', 'multiselect', array(
            'label'     => Mage::helper('news')->__('Category'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'category',
            'values' => array(
                            '-1'    => array( 'label' => 'Please Select..', 'value' => '-1'),
                            '1'     => array( 'label' => 'Articles', 'value' => 'articles'),
                            '2'     => array( 'label' => 'Events', 'value' => 'events'),
                            '3'     => array( 'label' => 'Videos', 'value' => 'videos'),
            ),
        ));

        $fieldset->addField('start_date', 'date', array(
            'label'     => Mage::helper('news')->__('Start Date'),
            'required'  => true,
            'name'      => 'start_date',
            'format' => 'MM-DD-YYYY',
            'image'  => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'/adminhtml/default/default/images/grid-cal.gif',
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
        ));


        $fieldset->addField('end_date', 'date', array(
            'label'     => Mage::helper('news')->__('End Date'),
            'name'      => 'end_date',
            'format' => 'MM-DD-YYYY',
            'image'  => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'/adminhtml/default/default/images/grid-cal.gif',
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
        ));

        $fieldset->addField('time', 'text', array(
            'label'     => Mage::helper('news')->__('Time'),
            'required'  => false,
            'name'      => 'time',
        ));

        $fieldset->addField('location', 'text', array(
            'label'     => Mage::helper('news')->__('Location'),
            'required'  => false,
            'name'      => 'location',
        ));

        $fieldset->addField('address', 'text', array(
            'label'     => Mage::helper('news')->__('Address'),
            'required'  => false,
            'name'      => 'address',
        ));

        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
        $wysiwygConfig->setData('files_browser_window_url', Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'));

        $fieldset->addField('description', 'editor', array(
            'label'     => Mage::helper('news')->__('Event Description'),
            'required'  => false,
            'name'      => 'description',
            'style' => 'width:700px; height:300px;', 
            'wysiwyg'   => true,
            'config' => $wysiwygConfig
        ));

        if ( Mage::getSingleton('adminhtml/session')->getNewsData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getNewsData());
            Mage::getSingleton('adminhtml/session')->setNewsData(null);
        } elseif ( Mage::registry('news_data') ) {
            $form->setValues(Mage::registry('news_data')->getData());
        }
        return parent::_prepareForm();
    }
}
