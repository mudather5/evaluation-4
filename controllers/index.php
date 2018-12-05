<?php

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

$acountManager = new AccountManager(Database::DB());


if (isset($_POST['new']))
{
    $data_account = array(
        'name' => $_POST['name'],
        'balance' => 80
    );

    $account = new Account($data_account);

    $acountManager->addAccount($account);
    
}


$getAccounts = $acountManager->getAccounts();


if(!empty($_POST['delete']))
{

    $id = (int) $_POST['delete'];

    $account = $acountManager->delete($id);

}

$getAccounts = $acountManager->getAccounts();



include "../views/indexView.php";
