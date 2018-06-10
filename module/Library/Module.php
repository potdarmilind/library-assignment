<?php

namespace Library;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
 
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
         return array(
             'factories' => array(
                 'Library\Model\BookTable' =>  function($sm) {
                     $tableGateway = $sm->get('BookTableGateway');
                     $table = new Model\BookTable($tableGateway);
                     return $table;
                 },
                 'BookTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Model\Book());
                     return new TableGateway('book', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
}
