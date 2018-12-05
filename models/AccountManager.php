<?php

declare (strict_types = 1);

class AccountManager
{

    private $_db;


    /**
     * constructor
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }
    
    /**
     * Set the value of _db
     *
     * @param PDO $db
     * @return  self
     */ 
    public function setDb(PDO $db)
    {
        $this->_db = $db;
        
        return $this;
    }
    
    /**
     * Get the value of _db
     */ 
    public function getDb()
    {
        return $this->_db;

    }

    public function getAccounts(){
        $arrayOfAccounts = [];

        $query = $this->_db->query('SELECT * FROM count');
        $dataAccounts = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new Account($dataAccount);
        }

        return $arrayOfAccounts;
    }


   
    public function addAccount($account)
    {

        $query = $this->_db->prepare('INSERT INTO `count`(name, balance) VALUES (:name, :balance)');
        $query->bindValue('name', $account->getName(), PDO::PARAM_STR);
        

        $query->execute();

    }


    public function delete($account)
    {
        $query = $this->getDb()->prepare('DELETE FROM count WHERE id = :id');
        $query->bindValue('id', $account, PDO::PARAM_INT);

        $query->execute();
    }



}
