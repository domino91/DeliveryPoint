<?php

class Domino91_DeliveryPoint_Adminhtml_DpointController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->_initAction()
            ->renderLayout();
    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('deliverypoint/dpoint')
            ->_title($this->__('Sales'))->_title($this->__('Baz'))
            ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
            ->_addBreadcrumb($this->__('Baz'), $this->__('Baz'));

        return $this;
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('deliverypoint/dpoint')->load($id);

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This baz no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getCity() : $this->__('New Baz'));

        $data = Mage::getSingleton('adminhtml/session')->getDeliveryPointData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('delivery_point_data', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Baz') : $this->__('New Baz'),
                $id ? $this->__('Edit Baz') : $this->__('New Baz'))
            ->_addContent($this->getLayout()->createBlock('deliverypoint/adminhtml_dpoint_edit')->setData('action',
                $this->getUrl('*/*/save')))
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('deliverypoint/dpoint');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Delivery Point has been saved.'));
                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('An error occurred while saving this Delivery Point.')
                );
            }

            Mage::getSingleton('adminhtml/session')->setDeliveryPoint($postData);
            $this->_redirectReferer();
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $deliveryModel = Mage::getModel('deliverypoint/dpoint');
                $deliveryModel->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess('successfully deleted');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function messageAction()
    {
        $data = Mage::getModel('deliverypoint/dpoint')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    public function massDeleteAction()
    {
        $deliveryIds = $this->getRequest()->getParam('dpoint');

        if (!is_array($deliveryIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select a Delivery Point'));
        } else {
            try {
                $model = Mage::getSingleton('deliverypoint/dpoint');
                foreach ($deliveryIds as $deliveryId) {
                    $model->load($deliveryId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Total of %d record(s) were deleted.',
                    count($deliveryIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('deliverypoint/dpoint');
    }
}