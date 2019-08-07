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
 * Module to Hr Departments
 *
 * Table : hr_departments
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class HrDepartmentsController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.HRD.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\HrDepartments';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
      
        'code'            =>  'required',                  
        'name'            =>  'required',                  
        'allow_queue'     =>  'required',
        'total_employees' =>  'required',                       
        'status'          =>  'required'               
       
    ];


    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'code'            =>  'required',                  
        'name'            =>  'required',                  
        'allow_queue'     =>  'required',
        'total_employees' =>  'required',                       
        'status'          =>  'required' 
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
            'name' => 'name',
            'operator' => 'like'
            
        ],
        [
            'name' => 'code',
            'operator' => 'like'
            
        ]
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'id',
        'operator' => 'asc'
    ];
 
}
