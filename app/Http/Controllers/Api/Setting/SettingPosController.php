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

namespace App\Http\Controllers\Api\Setting;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\BaseController;

/**
 * Module Kpi
 *
 * Module to manage Kpi
 *
 * Table : settings
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class SettingPosController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.KPI.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\System\SettingPos';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'cabang_id' => 'nullable|max:50',
        'setting_key' => 'nullable|max:100',
        'setting_value' => 'required|max:50',
        'setting_description' => 'nullable|max:150'
    ];

    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'cabang_id' => 'nullable|max:50',
        'setting_key' => ['nullable', 'max:100'],
        'setting_value' => 'required|max:50',
        'setting_description' => 'nullable|max:150'
    ];
    protected $relationRule = ['cabang'];

    /**
     * Module index validation rule
     *
     * @var array
     **/
    protected $filterRule = [
        [
            'name' => 'cabang_id',
            'operator' => '='
        ],
       
        [
            'name' => 'setting_description',
            'operator' => 'like'
        ]
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'setting_key',
        'operator' => 'asc'
    ];
}
