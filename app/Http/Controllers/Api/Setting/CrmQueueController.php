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
 * Module to Crm Queue
 *
 * Table : crm_queue
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class CrmQueueController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.Antrian.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\CrmQueue';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
      
          
        'customer_id'   =>  'required',
        'department_id' =>  'required',
        'counter_id'    =>  'required',
        'queue_dt'      =>  'required',
        'prefix_no'     =>  'required',
        'queue_no'      =>  'required',
        'process_start' =>  'required',
        'process_end'   =>  'required',
        'process_time'  =>  'required',
        'process_by'    =>  'required',
        'display'       =>  'required',
        'keterangan_id' =>  'required',
        'register_from' =>  'required',
        'status'        =>  'required'
       
    ];


    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'customer_id'   =>  'required',
        'department_id' =>  'required',
        'counter_id'    =>  'required',
        'queue_dt'      =>  'required',
        'prefix_no'     =>  'required',
        'queue_no'      =>  'required',
        'process_start' =>  'required',
        'process_end'   =>  'required',
        'process_time'  =>  'required',
        'process_by'    =>  'required',
        'display'       =>  'required',
        'keterangan_id' =>  'required',
        'register_from' =>  'required',
        'status'        =>  'required'
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
            'name' => 'customer_id',
            'operator' => 'like'
            
        ],
        [
            'name' => 'department_id',
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
