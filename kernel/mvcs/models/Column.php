<?php
/**
 * Created by PhpStorm.
 * User: luancomputacao
 * Date: 04/02/19
 * Time: 01:35
 */

namespace Kernel\Models;

class Column
{
    public $name = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

}