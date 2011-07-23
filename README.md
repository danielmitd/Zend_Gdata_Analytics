# Zend_Gdata_Analytics

An additonal Zend_GData component to query data from Analytics.

## Example

    $client = Zend_Gdata_ClientLogin::getHttpClient($email, $password, Zend_Gdata_Analytics::AUTH_SERVICE_NAME);
    $service = new Zend_Gdata_Analytics($client);

    $query = $service->newDataQuery()
      ->setProfileId($yourID)
      ->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_VISITS) 
      ->addDimension(Zend_Gdata_Analytics_DataQuery::DIMENSION_KEYWORD) 
      ->addSort(Zend_Gdata_Analytics_DataQuery::METRIC_VISITS, true)
      ->setStartDate('2006-01-01') 
      ->setEndDate('2011-07-13')
      ->setMaxResults(10000); 

    $result = $service->getDataFeed($query); 

    foreach($result as $row){
      /** … **/
    }