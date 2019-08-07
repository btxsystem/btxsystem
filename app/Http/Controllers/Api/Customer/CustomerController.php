<?php
/**
 * Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   CS <info@cirebon-software.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://cirebon-software.com
 */

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\BaseController;
use App\User;

/**
 * Module Barang
 * @category Controller
 * @author  asma cirebon 081214190007 
 */

class CustomerController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Customer.Customer.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Customer\Customer';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [

       'first_name'     => 'required',
       'last_name'      => 'required',
       'username'       => 'required',
       'email'          => 'required',
       'password'       => 'required'
    ];

    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [

        
       'first_name'     => 'required',
       'last_name'      => 'required',
       'username'       => 'required',
       'email'          => 'required',
       'password'       => 'required'  
    ];

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
            
            'name' => 'first_name',
            'operator' => 'like'
        ],
        [ 
            'name' => 'last_name',
            'operator' => '='
        ],
        [ 
            'name' => 'username',
            'operator' => 'like'
        ],
		[ 
            'name' => 'email',
            'operator' => 'like'
        ],
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'id',
        'operator' => 'desc'
    ];


    public function customSearch($request, $query)
    {
        // $input = $request->all();

        // if (isset($input['status'])) {

        //     $query->where('status', $input['status']);
        // }

        return $query;

    }



    public function beforeCreate($input) 
    {

     
        return $input;
    }

    public function beforeUpdate($input) 
    {


        return $input;
    }

}