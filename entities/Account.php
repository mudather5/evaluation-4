<?php

declare(strict_types = 1);

class Account
{
    protected $id,
              $name,
              $balance;

    public function __construct(array $array){

                    $this->hydrate($array);

    }

    public function hydrate(array $array)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
                
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function getId(){

        return $this->id;

    }

    public function getName(){

       return $this->name;
    }

    public function geBalance(){

        return $this->balance;
    }

    public function setId(int $id){

        $this->id = $id;
    }

    public function setName(string $name){

        $this->name = $name;
    }

    public function setBalance(int $balance){

        $this->balance = $balance;
    }

}

?>
