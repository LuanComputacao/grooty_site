<?php

namespace App\models;

use Kernel\mvcs\Model as Model;

class AssistantModel extends Model
{
    private $name;

    public function __construct()
    {
        $this->setName("Charles Grooty");
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}