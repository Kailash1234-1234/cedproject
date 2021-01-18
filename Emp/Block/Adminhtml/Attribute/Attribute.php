<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Block\Adminhtml\Attribute;
use Magento\Eav\Block\Adminhtml\Attribute\Grid\AbstractGrid;

class Attribute extends \Magento\Backend\Block\Widget\Grid\Extended
{

    /**
     * @var \Rh\Blog\Model\Status
     */
    protected $_status;

    /**
     * @var \Rh\Blog\Model\EmpFactory
     */
    protected $_emppostFactory;

    protected $_setsFactory;
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data            $backendHelper
     * @param \Rh\Blog\Model\BlogFactory              $blogFactory
     * @param \Rh\Blog\Model\Status                   $status
     * @param \Magento\Framework\Module\Manager       $moduleManager
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Ced\Emp\Model\EmppostFactory $emppostFactory,
        \Ced\Emp\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Eav\Model\Attribute $eavAttribute,
        \Magento\Eav\Model\Entity $entity,
         array $data = []
    ) {
        $this->_emppostFactory = $emppostFactory;
        $this->_eavAttribute =$eavAttribute;
        $this->_entity =$entity;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('attributeAttribute');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('attribute_record');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {   
        $collection = $this->_eavAttribute->getCollection();
        $collection->addFieldToFilter('entity_type_id', $this->_entity->setType('emp')->getTypeId());
        $collection->addFieldToFilter(
            'entity_type_id',
            $this->_entity->setType('emp')->getTypeId()
        );
       // print_r($collection->getData());
        // die;
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }
   
    /**
     * @return $this
     */
    protected function _prepareColumns()
    {

        $this->addColumn(
            'attribute_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'attribute_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'entity_type_id',
            [
                'header' => __('Attribute Id'),
                'type' => 'number',
                'index' => 'entity_type_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'attribute_code',
            [
                'header' => __('Attribute Code'),
                'index' => 'attribute_code',
            ]
        );
        $this->addColumn(
            'backend_type',
            [
                'header' => __('Backend Type'),
                'index' => 'backend_type',
            ]
        );
        $this->addColumn(
            'frontend_input',
            [
                'header' => __('Frontend Input'),
                'index' => 'frontend_input',
            ]
        );
       
        $this->addColumn(
            'is_required',
            [
                'header' => __('Is  Required'),
                'index' => 'is_required',
            ]
        );
        $this->addColumn(
            'is_user_defined',
            [
                'header' => __('Userdefiend Value'),
                'index' => 'is_user_defined',
            ]
        );
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => 'emp/*/edit',
                        ],
                        'field' => 'attribute_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $this->addColumn(
            'delete',
            [
                'header' => __('Delete'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Delete'),
                        'url' => [
                            'base' => 'emp/*/delete',
                        ],
                        'field' => 'attribute_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $block = $this->getLayout()->getBlock('attribute.bottom.links');
        // print_r($block);
        // die;
        if ($block) {
            $this->setChild('attribute.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('attribute_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('emp/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );

        // $statuses = $this->_status->toOptionArray();

        // array_unshift($statuses, ['label' => '', 'value' => '']);

        // $this->getMassactionBlock()->addItem(
        //     'status',
        //     [
        //         'label' => __('Change status'),
        //         'url' => $this->getUrl('emp/*/massStatus', ['_current' => true]),
        //         'additional' => [
        //             'visibility' => [
        //                 'name' => 'status',
        //                 'type' => 'select',
        //                 'class' => 'required-entry',
        //                 'label' => __('Status'),
        //                 'values' => $statuses,
        //             ],
        //         ],
        //     ]
        // );
        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('emp/*/attribute', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('emp/*/attribute', ['attribute_id' => $row->getId()]);
    }
}