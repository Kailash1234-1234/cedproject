<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created By : Rohan Hapani
 */
namespace Ced\Emp\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $_adminSession;

    /**
     * @var \Rh\Blog\Model\BlogFactory
     */
    protected $emppostFactory;

    /**
     * @param Action\Context                      $context
     * @param \Magento\Backend\Model\Auth\Session $adminSession
     * @param \Rh\Blog\Model\BlogFactory          $blogFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Ced\Emp\Model\EmppostFactory $emppostFactory
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->emppostFactory = $emppostFactory;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue();
       //print_r($postObj);
        // die;
        $name = $postObj["emp_name"];
        $date = date("Y-m-d");
        $username = $this->_adminSession->getUser()->getFirstname();
        if ($username == $name) {
            $username = $this->_adminSession->getUser()->getFirstname();
        } else {
            $username = $name;
        }

        $userDetail = ["emp_name" => $username, "created_at" => $date];
        $data = array_merge($postObj, $userDetail);
     // print_r($data);
    //   die;
              $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->emppostFactory->create();
            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('emp/*/edit', ['entity_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}