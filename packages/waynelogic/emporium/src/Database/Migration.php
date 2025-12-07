<?php namespace Waynelogic\Emporium\Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
abstract class Migration extends BaseMigration
{
    /**
     * Migration table prefix.
     */
    protected string $prefix = '';

    /**
     * Create a new instance of the migration.
     */
    public function __construct()
    {
        $this->prefix = 'emp_';
    }
}
