<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 16/12/18
 * Time: 13:28
 */

namespace Services;


use App\models\AssistantModel;

class FaqService
{
    public $assistant;

    public function getAssistantName()
    {
        $this->assistant =  new AssistantModel();
        return $this->assistant->getName();
    }


}