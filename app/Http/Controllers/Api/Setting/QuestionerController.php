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
use App\User;
use App\Pool;
use App\Models\Perusahaan\Perusahaan;
use App\Models\Perusahaan\Cabang;
use App\Models\Pembelian\Supplier;
use App\Models\Pembelian\ReceiveOrders;
use App\Models\Pembelian\GrnDetails;
use App\Models\Inventory\Locations;
use App\Models\Inventory\ProductUnits;
use App\Models\Inventory\Barang;
use Illuminate\Support\Facades\DB;
/**
 * Module Questioner
 *
 * Module to manage Questioner
 *
 * Table : questioner
 *
 * @category Controller
 * @package  App\Http\Controllers\Api\Pembelian
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class QuestionerController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.Questioner.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\Questioner';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'name'                => 'nullable',
        'status'              => 'nullable',
        'date_questation'     => 'required'
    ];

    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'name'                => 'nullable',
        'status'              => 'nullable',
        'date_questation'     => 'required'
    ];

 
    /**
     * Module index relation rule
     *
     * @var array
     **/
    protected $relationRule = [];

    // protected $relationRule = ['perusahaan','supplier'];

    protected $detailRelation = "questionerDetail";
    /**
     * Module index validation rule
     *
     * @var array
     **/
    protected $filterRule = [
        [
            'name' => 'id',
            'operator' => 'like'
        ],
        [
            'name' => 'status',
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
        'operator' => 'desc'
    ];


    /**
     * Fucntion before create data
     *
     * @param array $input
     * @return array
     */
    public function beforeCreate($input)
    {
        $input['date_questation'] = date('Y-m-d',strtotime($input['date_questation']));   

        return $input;
    }
}
