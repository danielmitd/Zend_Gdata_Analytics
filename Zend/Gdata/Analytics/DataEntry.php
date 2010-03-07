<?php
class Zend_Gdata_Analytics_DataEntry extends Zend_Gdata_Entry {

	protected $_dimensions = array();
	protected $_metrics = array();

    public function __construct($element = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Analytics::$namespaces);
        parent::__construct($element);
    }

	/**
     * @param DOMElement $child
     */
    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName){
        	case $this->lookupNamespace('ga') . ':' . 'dimension';
	            $dimension = new Zend_Gdata_Analytics_Extension_Dimension();
	            $dimension->transferFromDOM($child);
	            $this->_dimensions[$dimension->getName()] = $dimension;
            break;
        	case $this->lookupNamespace('ga') . ':' . 'metric';
	            $metric = new Zend_Gdata_Analytics_Extension_Metric();
	            $metric->transferFromDOM($child);
	            $this->_metrics[$metric->getName()] = $metric;
            break;
        	default:
            	parent::takeChildFromDOM($child);
            break;
        }
    }

	/**
	 * @return string
	 */
	public function getDimension($dimension){
		return $this->_dimensions[$dimension];
	}
	/**
	 * @return string
	 */
	public function getMetric($metric){
		return $this->_metrics[$metric];
	}
	
	public function getValue($name){
		if(array_key_exists($name, $this->_metrics)){
			return $this->_metrics[$name];
		}
		return $this->_dimensions[$name];
	}
}
?>