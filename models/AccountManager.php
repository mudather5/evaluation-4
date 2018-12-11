<?php

declare (strict_types = 1);

class AccountManager
{

    private $_db;




    /**
     * __construct
     *
     * @param  mixed $db
     *
     * @return method construct to initialise the object's properties
     */
    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }
    
    /**
     * Set the value of _db
     *
     * @param PDO $db
     * 
     * @return function setter, allows us to “set” the value of  db

     */ 
    public function setDb(PDO $db)
    {
        $this->_db = $db;
        
        return $this;
    }
    
    /**
     * Get the value of _db
     * function getter allows us to control access to db
     */ 
    public function getDb()
    {
        return $this->_db;

    }

    /**
     * getAccounts
     *
     * @return method getAccounts
     * 
     * Get all acounts
     *  

     */
    
    public function getAccounts(){

        //We declare an empty array
        $arrayOfAccounts = [];

        $query = $this->_db->query('SELECT * FROM accounts');
        $dataAccounts = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($dataAccounts as $dataAccount) {
            $arrayOfAccounts[] = new Account($dataAccount);
        }

        return $arrayOfAccounts;
    }


    /**
     * checkIfExist the name exists or no
     *
     * @param  string $name
     *
     */
    public function checkIfExist($name)
    {
        $query = $this->getDb()->prepare('SELECT * FROM `accounts` WHERE name = :name');
        $query->bindValue('name', $name, PDO::PARAM_STR);
        $query->execute();

        // If there is an entry with this name, it means that there is

        if ($query->rowCount() > 0)
        {
            return true;
        }
        
        // if no  it means that there is not
        return false;
    }


   
    
    /**
     * addAccount
     *
     * @param  mixed $account
     *
     * @return function addAccount for adding new accunt
     */
    public function addAccount($account)
    {

        $query = $this->_db->prepare('INSERT INTO `accounts`(name, balance) VALUES (:name, 80)');
        $query->bindValue('name', $account->getName(), PDO::PARAM_STR);
    
        $query->execute();
    }

    /**
     * delete
     *
     * @param  mixed $account
     *
     * @return function for deleting the account from the data base 
     */
    public function delete($account)
    {
        $query = $this->getDb()->prepare('DELETE FROM `accounts` WHERE id = :id');
        $query->bindValue('id', $account, PDO::PARAM_INT);

        $query->execute();

        
    }


    /**
     * transfer
     *
     * @param  mixed $balance
     * @param  mixed $id
     *
     * @return method for transfraing the balance
     */
    public function transfer($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `accounts` SET balance = balance - :balance WHERE id = :id');
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
     * @return method for resiving the balance which has been transfared in the method tranfare 
     */
    public function criditTransfare($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `accounts` SET balance = balance + :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);

        $query->execute();
    }


    
    
    /**
     * deposit
     *
     * @param  int $balance
     * @param  int $id
     *
     * @return method deposit in order to deposit money
     */
    public function deposit($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `accounts` SET balance = balance + :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);
        
        $query->execute();
    }
    
    
    /**
     * withdraw
     *
     * @param  int $balance
     * @param  int $id
     *
     * @return method withdraw in order to withdraw the balance(money) 
     */
    public function withdraw($balance, $id)
    {
        $query = $this->getDb()->prepare('UPDATE `accounts` SET balance = balance - :balance WHERE id = :id');
        $query->bindValue('balance', $balance, PDO::PARAM_INT);
        $query->bindValue('id', $id, PDO::PARAM_INT);

        $query->execute();
    }



}
