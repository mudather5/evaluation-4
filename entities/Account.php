<?php

declare(strict_types = 1);

class Account
{
    protected $id,
              $name,
              $balance = 80;

    /**
     * __construct
     *
     * @param  mixed $data
     *
     * method construct to initialise the object's properties
     */
    public function __construct(array $data){

                    $this->hydrate($data);

    }

    /**
     * hydrate
     *
     * @param  mixed $data
     *
     * method of hydration for "filling out" an object structure with data
     */
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

    /**
     * getId
     *
     * function getter allows us to control access to id
     */
    public function getId(){

        return $this->id;

    }

    /**
     * getName
     *
     * function getter allows us to control access to name
     */
    public function getName(){

       return $this->name;
    }

    /**
     * getBalance
     *
     * function getter allows us to control access to attribut balance
     */
    public function getBalance(){

        return $this->balance;
    }

    /**
     * setId
     *
     * @param  mixed $id
     *
     * @function setter allows us to “set” the value of  id
     */
    public function setId($id){
        $id = (int) $id;
        $this->id = $id;
    }

    /**
     * setName
     *
     * @param  mixed $name
     *
     * function setter allows us to “set” the value of  name
     */
    public function setName(string $name){

        $this->name = $name;
    }

    /**
     * setBalance
     *
     * @param  mixed $balance
     *
     * function setter allows us to “set” the value of  balance
     */
    public function setBalance($balance){

        $this->balance = $balance;
    }

}

?>
