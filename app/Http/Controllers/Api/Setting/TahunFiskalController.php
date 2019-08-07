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
 * Module Tahun Fiskal
 *
 * Module to manage Tahun Fiskal
 *
 * Table : fiscal_years
 *
 * @category Controller
 * @package  App\Http\Controllers\Api\Keuangan
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class TahunFiskalController extends BaseController

{

    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.TahunFiskal.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\TahunFiskal';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'date_begin'  => 'required',
        'date_end'  => 'required',
        'closed'  => 'required|max:150',
    ];



    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'date_begin'  => 'required',
        'date_end'  => 'required',
        'closed'  => 'required|max:150',
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
    protected $relationRule = [];

    /**
     * Module index validation rule
     *
     * @var array
     **/

    protected $filterRule = [
        [
            'name' => 'closed',
            'operator' => 'like'
        ],
        [
            'name' => 'id',
            'operator' => '='
        ]
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'date_begin',
        'operator' => 'asc'
    ];

    /**
     * Function before create data
     *
     * @param array $input
     * @return array
     */
    public function beforeCreate($input)
	{

        $date_begin = date('Y-m-d', strtotime($input['date_begin']));
        $input['date_begin']       =   $date_begin;

        $date_begin = date('Y-m-d', strtotime($input['date_end']));
        $input['date_end']       =   $date_begin;

        return $input;
    }

    /**
     * Function before uodate data
     *
     * @param array $input
     * @return array
     */    
    public function beforeUpdate($input)
	{

        $date_begin = date('Y-m-d', strtotime($input['date_begin']));
        $input['date_begin']       =   $date_begin;

        $date_begin = date('Y-m-d', strtotime($input['date_end']));
        $input['date_end']       =   $date_begin;

        return $input;
    }

}



