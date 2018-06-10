<?php
namespace Library;

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
                     $resultSetPrototype->setArrayObjectPrototype(new Album());
                     return new TableGateway('book', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
    'router' => array(
         'routes' => array(
             'library' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/library[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Library\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
  'controllers' => array(
        'invokables' => array(
            'Library\Controller\Index' => Controller\IndexController::class
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);

