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
     * Get the value of _db
     */ 
    public function getDb()
    {
        return $this->_db;
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

    public function getAccounts(){
        $arrayOfAcounts = [];

        $query = $this->getDB()->query('SELECT * FROM count');
        $dataAcounts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dataAcounts as $dataAcount) {
            
    }


}
