<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\BlockForm\Block\Adminhtml\Grid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

    /**
     * @var \Rh\Blog\Model\Status
     */
    protected $_status;

    /**
     * @var \Rh\Blog\Model\EmpFactory
     */
    protected $_emppostFactory;

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
        array $data = []
    ) {
        $this->_emppostFactory = $emppostFactory;
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
        $this->setId('gridGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('grid_record');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_emppostFactory->create()->getCollection();
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
            'entity_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'emp_name',
            [
                'header' => __('Employee Name'),
                'index' => 'emp_name',
            ]
        );

        $this->addColumn(
            'emp_email',
            [
                'header' => __('Employee Email'),
                'index' => 'emp_email',
            ]
        );
        $this->addColumn(
            'emp_mobile',
            [
                'header' => __('Employee Mobile'),
                'index' => 'emp_mobile',
            ]
        );
        // $this->addColumn(
        //     'emp_code',
        //     [
        //         'header' => __('Employee Code'),
        //         'index' => 'emp_code',
        //     ]
        // );

        // $this->addColumn(
        //     'status',
        //     [
        //         'header' => __('Status'),
        //         'index' => 'status',
        //         'type' => 'options',
        //         'options' => $this->_status->getOptionArray(),
        //     ]
        // );
       
        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'index' => 'created_at',
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
                            'base' => 'blockform/*/edit',
                        ],
                        'field' => 'entity_id',
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
                            'base' => 'blockform/*/delete',
                        ],
                        'field' => 'entity_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        // print_r($block);
        // die;
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('blockform/*/massDelete'),
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
        return $this->getUrl('blockform/*/grid', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('blockform/*/edit', ['entity_id' => $row->getId()]);
    }
}