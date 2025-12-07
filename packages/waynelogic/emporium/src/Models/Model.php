<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public string $tablePrefix = 'emp_';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable($this->tablePrefix . $this->getTable());
    }
}
