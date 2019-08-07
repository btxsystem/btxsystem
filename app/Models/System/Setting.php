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
namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Setting
 *
 * Model to manage setting
 *
 * @category Model
 * @package  App
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class Setting extends Model
{
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cabang_id',
        'perusahaan_id',
        'setting_key', 'setting_value', 'setting_description'
    ];
    public function cabang()
    {
        return $this->belongsTo('App\Models\Perusahaan\Cabang', 'cabang_id', 'id');
    }
    public function perusahaan()
    {
        return $this->belongsTo('App\Models\Perusahaan\Perusahaan', 'perusahaan_id', 'id');
    }
}
