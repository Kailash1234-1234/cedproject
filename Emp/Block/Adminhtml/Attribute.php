<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Block\Adminhtml;

/**
 * Backend grid container block
 */
class Attribute extends \Magento\Backend\Block\Widget\Container
{

    /**
     * @var string
     */
    protected $_template = 'attributeview.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareLayout()
    {

        $addButtonProps = [
            'id' => 'add_new_attribute',
            'label' => __('Add New Attribute'),
            'class' => 'add',
            'button_class' => '',
            'class_name' => 'Magento\Backend\Block\Widget\Button\SplitButton',
            'options' => $this->_getAddButtonOptions(),
        ];

        $this->buttonList->add('add_new', $addButtonProps);
        $this->setChild('attribute', $this->getLayout()->createBlock('Ced\Emp\Block\Adminhtml\Attribute\Attribute', 'attribute.view.attribute'));
        return parent::_prepareLayout();
    }

    /**
     * @return array
     */
    protected function _getAddButtonOptions()
    {

        $splitButtonOptions[] = [
            'label' => __('Add New Attribute'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')",
        ];
        return $splitButtonOptions;
    }

    /**
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl('emp/*/new');
    }

    /**
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('attribute');
    }
}