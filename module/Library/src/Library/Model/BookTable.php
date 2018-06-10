<?php

namespace Library\Model;

use Zend\Db\TableGateway\TableGateway;

class BookTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getBook($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function updateBook(Book $book)
    {
        $data = array(
            'issued' => $book->issued
        );

        $id = (int) $book->id;
        if ($this->getBook($id)) {
           $this->tableGateway->update($data, array('id' => $id));
       } else {
           throw new \Exception('Book does not exist');
       }
   }

    
    
}