<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 18/12/18
 * Time: 02:26
 */

namespace Kernel\interfaces;


interface IControllerManager
{
    public function getController(): IController;

    public function callGetOrPost();
}