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


    public function checkIfExist($name)
    {
        $query = $this->getDb()->prepare('SELECT * FROM `count` WHERE name = :name');
        $query->bindValue('name', $name, PDO::PARAM_STR);
        $query->execute();

        // Si il y a une entrée avec ce nom, c'est qu'il existe
        if ($query->rowCount() > 0)
        {
            return true;
        }
        
        // Sinon c'est qu'il n'existe pas
        return false;
    }


   
    /**
     * addAccount
     *
     * @param  mixed $account
     *
     * @return void
     */
    public function addAccount($account)
    {

        $query = $this->_db->prepare('INSERT INTO `count`(name, balance) VALUES (:name, 80)');
        $query->bindValue('name', $account->getName(), PDO::PARAM_STR);
    
        $query->execute();
    }


    /**
     * delete
     *
     * @param  mixed $account
     *
     * @return void
     */
    public function delete($account)
    {
        $query = $this->getDb()->prepare('DELETE FROM `count` WHERE id = :id');
        $query->bindValue('id', $account, PDO::PARAM_INT);

        $query->execute();

        
    }


    /**
     * transfer
     *
     * @param  mixed $balance
     * @param  mixed $id
     *
     * @return void
     */
    public function transfer($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `count` SET balance = balance - :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);

        $query->execute();
    }


    /**
     * criditTransfare
     *
     * @param  mixed $balance
     * @param  mixed $id
     *
     * @return void
     */
    public function criditTransfare($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `count` SET balance = balance + :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);

        $query->execute();
    }


    
    
    /**
     * depot
     *
     * @param  mixed $balance
     * @param  mixed $id
     *
     * @return void
     */
    public function depot($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `count` SET balance = balance + :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);
        
        $query->execute();
    }
    
    
    /**
     * retrait
     *
     * @param  mixed $balance
     * @param  mixed $id
     *
     * @return void
     */
    public function retrait($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `count` SET balance = balance - :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);

        $query->execute();
    }



}
