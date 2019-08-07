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
 * Module to perusahaan pengiriman
 *
 * Table : perusahaan_pengiriman
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class PerusahaanPengirimanController extends BaseController
{
    /**
     * Module base permission.
     *
     * @var string
     **/
    protected $permission = "Setting.PerusahaanPengiriman.";

    /**
     * Module eloquent model
     *
     * @var object
     **/
    protected $model = 'App\Models\Settings\PerusahaanPengiriman';

    /**
     * Module create validation rule
     *
     * @var array
     **/
    protected $createRule = [
        'code' =>  'required|unique:perusahaan_pengiriman|max:50',
        'name' =>  'required|max:150',
        'alamat' =>  'required|max:150', 
        'perusahaan_id' =>  'required|max:150', 
        'cabang_id' =>  'required|max:150'
       
    ];


    /**
     * Module update validation rule
     *
     * @var array
     **/
    protected $updateRule = [
        'code' =>  'required',
        'name' =>  'required',
        'alamat' =>  'required', 
        'perusahaan_id' =>  'required', 
        'cabang_id' =>  'required'
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
    protected $relationRule = ['pengirimanCabang','PengirimanPerusahaan'];
   
    /**
     * Module index validation rule
     *
     * @var array
     **/
    protected $filterRule = [
        [
            'name' => 'code',
            'operator' => '='
        ],
        [
            'name' => 'name',
            'operator' => 'like'
        ],
        [
            'name' => 'perusahaan_id',
            'operator' => '='
        ],
        [
            'name' => 'cabang_id',
            'operator' => '='
        ]
    ];

    /**
     * Module index order rule
     *
     * @var array
     **/
    protected $orderRule = [
        'name' => 'code',
        'operator' => 'asc'
    ];
   
      

   

}
