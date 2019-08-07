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

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\BaseController;
use App\User;

/**
 * Module Barang
 * @category Controller
 * @package  App\Http\Controllers\Api\Barang
 * @author   CS <info@cirebon-software.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://cirebon-software.com
 */

class RankController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Member.Member.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Member\Rank';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [

        'id_member'         => 'nullable|unique:employeers',
        'username'          => 'required|unique:employeers',
        'first_name'        => 'required',
        'last_name'         => 'required',
        'email'             => 'required|unique:employeers',
        'password'          => 'required',
        'birthdate'         => 'required',
        'npwp_number'       => 'required',
        'is_married'        => 'required',
        'gender'            => 'required',
        'status'            => 'required',
        'phone_number'      => 'required',
        'no_rec'            => 'required',
        'position'          => 'nullable',
        'parent_id'         => 'required',
        'sponsor_id'        => 'required',
        'rank_id'           => 'nullable',
        'bitrex_cash'       => 'nullable',
        'bitrex_points'     => 'nullable',
        'pv'                => 'nullable',        
    ];

    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [

        'id_member'         => 'required|unique:employeers',
        'username'          => 'required|unique:employeers',
        'first_name'        => 'required',
        'last_name'         => 'required',
        'email'             => 'required|unique:employeers',
        'password'          => 'required',
        'birthdate'         => 'required',
        'npwp_number'       => 'required',
        'is_married'        => 'required',
        'gender'            => 'required',
        'status'            => 'required',
        'phone_number'      => 'required',
        'no_rec'            => 'required',
        'position'          => 'required',
        'parent_id'         => 'required',
        'sponsor_id'        => 'required',
        'rank_id'           => 'required',
        'bitrex_cash'       => 'nullable',
        'bitrex_points'     => 'nullable',
        'pv'                => 'nullable',
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
            
            'name' => 'id_member',
            'operator' => '='
        ],
        [ 
            'name' => 'username',
            'operator' => '='
        ],
        [ 
            'name' => 'first_name',
            'operator' => 'like'
        ],
		[ 
            'name' => 'last_name',
            'operator' => 'like'
        ],
		[ 
            'name' => 'status',
            'operator' => '='
        ]
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



    public function beforeCreate($input) 
    {

        $y = date('Y');

        $input['rank_id']  = null;
        $input['id_member']  = null;
        $input['parent_id'] = null;

        $input['birthdate'] =  date('Y-m-d',strtotime($input['birthdate']));   
 
        $input['id_member'] = rand($y, 1234567890);


        return $input;
    }

}