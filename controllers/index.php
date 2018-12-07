<?php

/**
 * chargerClasse
 *
 * @param  mixed $classname
 *
 * get the datas from the files
 */
function chargerClasse($classname)
{
    if(file_exists('../models/'. $classname.'.php'))
    {
        require '../models/'. $classname.'.php';
    }
    else 
    {
        require '../entities/' . $classname . '.php';
    }
}

spl_autoload_register('chargerClasse');

$db = Database::DB();

$acountManager = new AccountManager($db);

//getting in the form to have name and the balance from the form 
if (isset($_POST['new']))
{
    //check the name of the account for making one account 
    if($acountManager->checkIfExist($_POST['name']) === true)

        {
            $message = "Le compt existe déjà !";

        }

        else
        {

            if($_POST['name'] !== 'Compte Courant'){
            $data_account = array(
                'name' => $_POST['name'],
                'balance' => 0
            );

        } 
        else 
        {
            $data_account = array(
                'name' => $_POST['name'],
                'balance' => 80
            );        }
            $account = new Account($data_account);// create a new object
        
            $acountManager->addAccount($account);// get the addaccount method form AccountManager.php and adde it in the data base
        }


    
}


$getAccounts = $acountManager->getAccounts();

//condition for deleting an account 
if(isset($_POST['delete']))
{

    $id = (int) $_POST['id'];

    $account = $acountManager->delete($id);// access to method delete in AccountManage.php

}

$getAccounts = $acountManager->getAccounts();


//condition for ckecking the input (transfer) in the form for transfering money
if(isset($_POST['transfer']))
{

    $balance = (int) $_POST['balance'];

   $acountManager->transfer($balance, $_POST['idDebit']);//access to method transfer in AccountManage.php
   $acountManager->criditTransfare($balance, $_POST['idPayment']);//access to method criditTransfare in AccountManage.php

}

$getAccounts = $acountManager->getAccounts();

//check if input (payment) existed in the form 
if(isset($_POST['payment']))
{


    $balance = (int) $_POST['balance'];

   $acountManager->deposit($balance, $_POST['id']);//access to method deposit in AccountManage.php 

}

$getAccounts = $acountManager->getAccounts();

//check if input (debit) existed in the form 

if(isset($_POST['debit']))
{

    $balance = (int) $_POST['balance'];

   $acountManager->withdraw($balance, $_POST['id']);//get the method withdraw from AccountManager.php



}

$getAccounts = $acountManager->getAccounts();










include "../views/indexView.php";
