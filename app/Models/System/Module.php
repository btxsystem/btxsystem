<?php
/**
 * Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */
namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Modules
 *
 * Model to manage modules list
 *
 * @category Model
 * @package  App
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class Module extends Model
{
    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name', 'table_name'
    ];

    /**
     * Get the column record associated with the module
     *
     * @return object
     */
    public function column()
    {
        return $this->hasMany('\App\Models\System\ModuleColumn', 'module_name', 'module_name');
    }
}
