<?php
namespace Ced\Customer\Block\Adminhtml\Customeredit\Edit;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;
/**
 * Customer account form block
 */
class Tabs extends Generic implements TabInterface
{
     /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Ced\Customer\Model\Status $status,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\App\Request\Http $request,

        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_customerFactory=$customerFactory;
        $this->request=$request; 
        $this->_status = $status;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Demo Tab');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Demo Tab');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
       if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return $this->getUrl('index/*/edit', ['_current' => true]);
    }

    /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }
    public function initForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }
        /**@var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('myform_');
         
        //$model = $this->_customerFactory->create();
        // foreach($model as $data){
        //      print_r($data);
        // }
       // echo $model->getId();

       

         $id = $this->request->getParam('id');

        $model = $this->_customerFactory->create();
       
        $modelData = $model->load($id);

        
        // print_r($this->_status->getBackendTypeArray());
       // die;
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Fields Information')]);
        $fieldset->addField(
            'active',
            'select',
            [
                'name' => 'active',
                'label' => __('Required (Yes/No)'),
                'title' => __('Required (Yes/No)'),
                'data-form-part' => $this->getData('target_form'),
                'options'=> $this->_status->getOptionArray(),
                'required' => true,

            ]
        );
        $fieldset->addField(
            'year_of_creadit_card',
            'select',
            [
                'name' => 'year_of_creadit_card',
                'label' => __('Cradit'),
                'title' => __('Attribute Code'),
                'data-form-part' => $this->getData('target_form'),
                'values'=> $this->_status->getBackendTypeArray(),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'favorite_color',
            'multiselect',
            [
                'name' => 'favorite_color',
                'label' => __('Favorite Color'),
                'title' => __('Attribute Code'),
                'data-form-part' => $this->getData('target_form'),
                'values'=> $this->_status->getColorArray(),
                'required' => true
            ]
        );
            $fieldset->addField(
                'area_of_interest',
                'multiselect',
                [
                    'name' => 'area_of_interest',
                    'data-form-part' => $this->getData('target_form'),
                    'label' => __('Area of Interest'),
                    'title' => __('Demo Field in Customer Section'),
                    'values'=> $this->_status->getInterestAreaArray(),
                   
                ]
            );
        // $fieldset->addField(
        //     'area_of_interest',
        //     'checkboxes', 
        //         ['label' => 'check',
        //         'data-form-part' => $this->getData('target_form'),
        //         'name' => 'area_of_interest',
        //         'values' => array(
        //         array('value'=>'1', 'label'=>'1'),
        //         array('value'=>'2', 'label'=>'2'),
        //         array('value'=>'3', 'label'=>'3'),
        //         array('value'=>'4', 'label'=>'4'),
        //         array('value'=>'5', 'label'=>'5'),
        //         ),]
        // );
        $form->addValues($modelData->getData());
       // $form->addValues($model->getData());
        $this->setForm($form);
        return $this;
    }
    /**
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm();
            return parent::_toHtml();
        } else {
            return '';
        }
    }
    /**
     * Prepare the layout.
     *
     * @return $this
     */
// You can call other Block also by using this function if you want to add phtml file.
//    public function getFormHtml() 
//     {
//         $html = parent::getFormHtml();
//         $html .= $this->getLayout()->createBlock(
//             'Ced\Customer\Block\Adminhtml\Customeredit\Edit\Tab\EdditionalBlock'
//         )->toHtml();
//         return $html;
//     }
}