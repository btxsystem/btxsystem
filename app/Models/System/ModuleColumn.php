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
 * Model Modules Column
 *
 * Model to manage modules column list
 *
 * @category Model
 * @package  App
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class ModuleColumn extends Model
{
    protected $table = 'modules_column';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name', 'column_name', 'column_field', 'parent_name', 'parent_field'
    ];

    /**
     * Get the module record associated with the column
     *
     * @return object
     */
    public function module()
    {
        return $this->belongsTo('\App\Models\System\Module', 'module_name', 'module_name');
    }
}
