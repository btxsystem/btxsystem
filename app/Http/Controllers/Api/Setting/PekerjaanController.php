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
 * Module Modules
 *
 * Module to pekerjaan
 *
 * Table : pekerjaan
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class PekerjaanController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.Pekerjaan.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\Pekerjaan';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'cabang_txt'=>  'required|max:150',
        'kode' =>  'required|max:50',
        'nama'=>  'required|max:150'

       
    ];


    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'cabang_txt'=>  'required|max:150',
        'kode' =>  'required|max:50',
        'nama'=>  'required|max:150'
    ];

    /**
     * Module eloquent relation function
     *
     * @var object
     **/
    //protected $detailRelation = "";

    /**
     * Module index relation rule
     *
     * @var array
     **/
    protected $relationRule = [];
   
    /**
     * Module index validation rule
     *
     * @var array
     **/
    protected $filterRule = [
        [
            'name' => 'kode',
            'operator' => '='
        ],
        [
            'name' => 'nama',
            'operator' => 'like'
        ]
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'kode',
        'operator' => 'asc'
    ];
   
      

   

}
