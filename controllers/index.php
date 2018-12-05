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

$db = Database::DB();

$acountManager = new AccountManager($db);


if (isset($_POST['new']))
{
    if($acountManager->checkIfExist($_POST['name']) === true)

        {
            $message = "Le compt existe déjà !";

        }

        else
        {


            $data_account = array(
                'name' => $_POST['name'],
                'balance' => 80
            );
        
            $account = new Account($data_account);
        
            $acountManager->addAccount($account);
        }


    
}


$getAccounts = $acountManager->getAccounts();


if(isset($_POST['delete']))
{

    $id = (int) $_POST['id'];

    $account = $acountManager->delete($id);

}

$getAccounts = $acountManager->getAccounts();



include "../views/indexView.php";
