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

namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\BaseController;

/**
 * Module Settings
 *
 * Module to manage setting
 *
 * Table : settings
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class SettingController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "System.Setting.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\System\Setting';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'cabang_id' => 'nullable|max:50',
        'perusahaan_id' => 'nullable|max:50',
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
        'perusahaan_id' => 'nullable|max:50',
        'setting_key' => ['nullable', 'max:100'],
        'setting_value' => 'required|max:50',
        'setting_description' => 'nullable|max:150'
    ];
    protected $relationRule = ['perusahaan', 'cabang'];

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
            'name' => 'perusahaan_id',
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
