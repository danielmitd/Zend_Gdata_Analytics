<?php
/**
 * @see Zend_Gdata_Entry
 */
require_once 'Zend/Gdata/Entry.php';

/**
 * @see Zend_Gdata_Analytics_Extension_Dimension
 */
require_once 'Zend/Gdata/Analytics/Extension/Dimension.php';

/**
 * @see Zend_Gdata_Analytics_Extension_Metric
 */
require_once 'Zend/Gdata/Analytics/Extension/Metric.php';

/**
 * @see Zend_Gdata_Analytics_Extension_Property
 */
require_once 'Zend/Gdata/Analytics/Extension/Property.php';

/**
 * @see Zend_Gdata_Analytics_Extension_TableId
 */
require_once 'Zend/Gdata/Analytics/Extension/TableId.php';

/**
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Analytics
 */
class Zend_Gdata_Analytics_AccountEntry extends Zend_Gdata_Entry
{
	protected $_accountId;
	protected $_accountName;
	protected $_profileId;
	protected $_webPropertyId;
	protected $_currency;
	protected $_timezone;
	protected $_tableId;

	/**
	 * @see Zend_Gdata_Entry::__construct()
	 */
	public function __construct($element = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Analytics::$namespaces);
        parent::__construct($element);
    }

    /**
     * @param DOMElement $child
     * @return void
     */
    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName){
        	case $this->lookupNamespace('ga') . ':' . 'property';
	            $property = new Zend_Gdata_Analytics_Extension_Property();
	            $property->transferFromDOM($child);
	            $this->{$property->getName()} = $property;
            break;
        	case $this->lookupNamespace('ga') . ':' . 'tableId';
	            $tableId = new Zend_Gdata_Analytics_Extension_TableId();
	            $tableId->transferFromDOM($child);
	            $this->_tableId = $tableId;
            break;
        	default:
            	parent::takeChildFromDOM($child);
            break;
        }
    }
}
