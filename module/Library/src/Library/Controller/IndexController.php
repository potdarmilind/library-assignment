<?php

namespace Library\Controller;

use Zend\View\Model\ViewModel;

class IndexController extends \Zend\Mvc\Controller\AbstractActionController
{
    protected $bookTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
             'books' => $this->getBookTable()->fetchAll(),
         ));
        
    }
    
    public function issueAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        try
        {
            $book = $this->getBookTable()->getBook($id);
        }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('library', array(
                 'action' => 'index'
             ));
         }
         $book->issued = 1;
         
         $this->getBookTable()->updateBook($book);
         return $this->redirect()->toRoute('library', array(
                 'action' => 'index'
             ));
        
    }
    
    public function returnAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        try
        {
            $book = $this->getBookTable()->getBook($id);
        }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('library', array(
                 'action' => 'index'
             ));
         }
         $book->issued = 0;
         
         $this->getBookTable()->updateBook($book);
         return $this->redirect()->toRoute('library', array(
                 'action' => 'index'
             ));
    }
    
     public function getBookTable()
     {
         if (!$this->bookTable) {
             $sm = $this->getServiceLocator();
             $this->bookTable = $sm->get('Library\Model\BookTable');
         }
         return $this->bookTable;
     }
}
