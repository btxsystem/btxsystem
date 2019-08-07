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
 * Module keterangan
 *
 * Module to manage keterangan 
 *
 * Table : comments
 *
 * @category Controller
 * @package  App\Http\Controllers\Api\Keuangan
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class KeteranganController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.Keterangan.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\Keterangan';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'name' => 'required|max:150',
        'module_type' => 'required|max:150',
        'perusahaan_id' => 'required|max:11',
        'status' => 'required|max:1'
    ];

    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'name' => 'required|max:150',
        'module_type' => 'required|max:150',
        'perusahaan_id' => 'required|max:150',
        'status' => 'required|max:1'
    ];

    /**
     * Module eloquent relation function
     *
     * @var object
     **/
    protected $detailRelation = "";

    /**
     * Module index relation rule
     *
     * @var array
     **/
    protected $relationRule = ['perusahaan'];

    /**
     * Module index validation rule
     *
     * @var array
     **/
    protected $filterRule = [ 
        [
            'name' => 'name',
            'operator' => 'like'
        ],
        [
            'name' => 'perusahaan_id',
            'operator' => 'like'
        ]
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'name',
        'operator' => 'asc'
    ];

}

