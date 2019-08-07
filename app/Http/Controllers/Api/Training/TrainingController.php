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

namespace App\Http\Controllers\Api\Training;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\BaseController;
use App\User;

/**
 * Module Barang
 * @category Controller
 * @author  asma cirebon 081214190007 
 */

class TrainingController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Training.Management.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Training\Training';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [

       'location'           => 'required',
       'start_training'     => 'required',
       'price'              => 'required',
       'capacity'           => 'required',
       'note'               => 'nullable',
       'open'               => 'required'
    ];

    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [

        
       'location'           => 'required',
       'start_training'     => 'required',
       'price'              => 'required',
       'capacity'           => 'required',
       'note'               => 'nullable',
       'open'               => 'required' 
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
            
            'name' => 'location',
            'operator' => 'like'
        ],
        [ 
            'name' => 'capacity',
            'operator' => 'like'
        ],
        [ 
            'name' => 'open',
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