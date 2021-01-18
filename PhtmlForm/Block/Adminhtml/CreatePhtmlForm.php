<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.codilar.com/
 */

namespace Ced\PhtmlForm\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Serialize\SerializerInterface;



class CreatePhtmlForm extends Template
{
    
   
	private $cacheId = 'IdForCachingPurposes';
 
    /**
     * @var SerializerInterface
     */
    private $serializer;
	
	protected $cacheType;
    /**
     * Cacher constructor.
     * @param Template\Context $context
     * @param SerializerInterface $serialized
     * @param array $data
     */
		protected $_countryCollectionFactory;
		public function __construct(
            \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
            \Magento\Framework\Data\Form\FormKey $formKey,
			\Magento\Framework\View\Element\Template\Context $context,
			SerializerInterface $serializer,
			\Magento\Framework\App\CacheInterface $cache,
			
			
			\Ced\Brand\Model\ResourceModel\Brandpost\CollectionFactory $brandpostCollectionFactory,
	        array $data = []
	    ) {
	        parent::__construct($context, $data);
            $this->_countryCollectionFactory = $countryCollectionFactory;
			$this->formKey = $formKey;
			$this->brandpostCollectionFactory=$brandpostCollectionFactory;
			$this->serializer = $serializer;
			$this->_cache = $cache;
	    }
 
		public function getBrandCollection()
		{
			$collection = $this->brandpostCollectionFactory->create();
			$collection->getData();
			//$collection->setPageSize(10); // fetching only 3 products
			return $collection;
		} 

	    public function getCountryCollection()
	    {
	        $collection = $this->_countryCollectionFactory->create()->loadByStore();
	        return $collection;
		}
		
        
        public function getFormKey()
        {
             return $this->formKey->getFormKey();
        }

	    /**
	     * Retrieve list of top destinations countries
	     *
	     * @return array
	     */
	    protected function getTopDestinations()
	    {
	        $destinations = (string)$this->_scopeConfig->getValue(
	            'general/country/destinations',
	            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
	        );
	        return !empty($destinations) ? explode(',', $destinations) : [];
	    }
 
	    /**
	     * Retrieve list of countries in array option
	     *
	     * @return array
	     */
	    public function getCountries()
	    {
	        return $options = $this->getCountryCollection()
	                ->setForegroundCountries($this->getTopDestinations())
                        ->toOptionArray();
	    }
    public function getText1() {
        return "Add Brand Detailes Here ... !!!";
	}
	

    public function getCache(){
		$cachekey=\Ced\PhtmlForm\Model\Cache\Type::CACHE_KEY;
		$cache=$this->_cache->load($cachekey);
		return unserialize($cache);
    }	
}
