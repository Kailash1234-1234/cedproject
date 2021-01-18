<?php

namespace Ced\Slider\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{

    const ALT_FIELD = 'title';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    /**
     * @param ContextInterface              $context
     * @param UiComponentFactory            $uiComponentFactory
     * @param StoreManagerInterface         $storeManager
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param array                         $components
     * @param array                         $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        \Magento\Catalog\Helper\Image $imageHelper,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->imageHelper = $imageHelper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        // die('hii');
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            //echo $fieldName;
            foreach ($dataSource['data']['items'] as &$item) {
                $url = '';
              
                if (isset($item[$fieldName])) {
                    if ($item[$fieldName] != '') {
                        // die(__FILE__);
                        $url = $this->storeManager->getStore()->getBaseUrl(
                           
                        ) . "pub/media/wysiwyg/" . $item[$fieldName];
                    } else {
                        $url = $this->imageHelper->getDefaultPlaceholderUrl('small_image');
                    }
                } else {
                    $url = $this->imageHelper->getDefaultPlaceholderUrl('small_image');
                }
        //         echo "<pre>";
        // print_r($url);
        // die(__FILE__);
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                $item[$fieldName . '_orig_src'] = $url;
            }
        }
        // echo "<pre>";
        // print_r($dataSource);
        // die(__FILE__);
        return $dataSource;
    }

    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}