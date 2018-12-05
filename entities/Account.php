<?php

declare(strict_types = 1);

class Account
{
    protected $id,
              $name,
              $balance = 80;

    public function __construct(array $data){

                    $this->hydrate($data);

    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
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

    public function getBalance(){

        return $this->balance;
    }

    public function setId($id){
        $id = (int) $id;
        $this->id = $id;
    }

    public function setName(string $name){

        $this->name = $name;
    }

    public function setBalance($balance){

        $this->balance = $balance;
    }

}

?>
