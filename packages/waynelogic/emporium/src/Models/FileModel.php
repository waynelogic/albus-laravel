<?php

namespace Waynelogic\Emporium\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FileModel extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    public string $tablePrefix = 'emp_';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable($this->tablePrefix . $this->getTable());
    }
}
