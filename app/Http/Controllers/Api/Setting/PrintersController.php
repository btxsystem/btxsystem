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
 * Module to printers
 *
 * Table : printers
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class PrintersController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.Printers.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\Printers';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'name'            =>  'required',
        'description'     =>  'required',
        'printer_address' =>  'required',
        'printer_port'    =>  'required',
        'printer_queue'   =>  'required',
        'printer_timeout' =>  'required',
        'status'          =>  'required'
      
       
    ];


    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'name'            =>  'required',
        'description'     =>  'required',
        'printer_address' =>  'required',
        'printer_port'    =>  'required',
        'printer_queue'   =>  'required',
        'printer_timeout' =>  'required',
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
