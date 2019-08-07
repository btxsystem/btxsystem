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

namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\System\Module;
use App\Models\System\ModuleColumn;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use PHPExcel_Cell;
use PHPExcel_Cell_DataType;
use PHPExcel_Cell_IValueBinder;
use PHPExcel_Cell_DefaultValueBinder;

use Validator;

class MyValueBinder extends PHPExcel_Cell_DefaultValueBinder implements PHPExcel_Cell_IValueBinder
{
    public function bindValue(PHPExcel_Cell $cell, $value = null)
    {
        if (is_numeric($value))
        {
            $cell->setValueExplicit($value, PHPExcel_Cell_DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}

/**
 * Module Modules
 *
 * Module to manage module list
 *
 * Table : modules
 *
 * @category Controller
 * @package  App\Http\Controllers
 * @author   cirebon software
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebon software
 */

class ImportController extends Controller
{
    private $permission = "System.Import.";

    /**
     * Return all table
     *
     * @param Request $request Request Object
     *
     * @return json
     */
    public function getTable(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'View');

        $list = Module::all();

        return $list;
    }

    /**
     * Return table column
     *
     * @param Request $request Request Object
     *
     * @return json
     */
    public function getColumn(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'View');

        $moduleName = $request->get('module_name', false);

        $list = ModuleColumn::where('module_name', $moduleName)->get();

        return $list;
    }

    /**
     * Create a new Agama
     *
     * @return json
     */
    public function store(Request $request)
    {
        $request->user()->hasPermission($this->permission . 'Create');

        $validator = Validator::make($request->all(), [
            'file_csv' => 'required',
            'module_name' => 'required|max:150',
            'column' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $fileCSV = $request->get('file_csv', false);
        $column = $request->get('column', false);
        $moduleName = $request->get('module_name', false);

        $module = Module::where('module_name', $moduleName)->first();
        $moduleColumn = ModuleColumn::where('module_name', $moduleName)->get();

        foreach ($moduleColumn as $col) {
            $colSetting[ $col->column_field ] = $col;
        }

        // Read CSV
        $file = '/storage/app/' . $fileCSV;

        $data = [];
        $errors = [];
        $line = 1;

        $myValueBinder = new MyValueBinder;

        Excel::setValueBinder($myValueBinder)->load($file)->each(function (Collection $csvLine) use ($column, $module, $colSetting, &$data, &$errors, $line, $request) {

            try {
                $tmpData = array();
                $primary['key'] = '';
                $primary['value'] = '';

                foreach ($column as $csvCol => $dbCol) {

                    if (empty($dbCol)) continue;
                    $val = $csvLine->get($csvCol);

                    if (empty($val)) continue;

                    $setting = $colSetting[ $dbCol ];

                    if ($setting->column_primary) {
                        $primary['key'] = $setting->column_field;
                        $primary['value'] = $csvLine->get($csvCol);
                    }

                    if ($setting->column_encrypt) {
                        $val = bcrypt($val);
                    }

                    if (!empty($setting->parent_table) &&
                        !empty($setting->parent_field) &&
                        !empty($setting->parent_relation_field) ) {

                        try {

                            $res = DB::table($setting->parent_table)
                                        ->select('id', $setting->parent_field)
                                        ->where($setting->parent_relation_field, '=', $val . '')
                                        ->first();

                            $fieldID = $dbCol . '_id';
                            $fieldTxt = $dbCol . '_txt';

                            if ($res) {
                                $tmpData[ $fieldID ] = $res->id;
                                $tmpData[ $fieldTxt ] = $res->{$setting->parent_field};
                            }
                            // $tmpData[ $dbCol ] = $res->{$setting->parent_field};
                        } catch (Exception $e) {
                            $errors[] = "CSV Line {$line} : Gagal di Import";
                        }
                    } else {
                        $tmpData[ $dbCol ] = $val;
                    }

                    $tmpData['created_at'] = date('Y-m-d H:i:s');
                    $tmpData['created_by'] = $request->user()->username;
                }

                //$data[] = $tmpData;
                if (!empty($primary['key']) && !empty($primary['value'])) {
                    $check = DB::table($module->table_name)->where($primary['key'], '=', $primary['value'])->count();

                    if ($check) {
                        DB::table($module->table_name)->where($primary['key'], '' . $primary['value'])->update($tmpData);
                    } else {
                        DB::table($module->table_name)->insert($tmpData);
                    }
                } else {
                    DB::table($module->table_name)->insert($tmpData);
                }

                $line++;
            } catch (Exception $e) {
                $errors[] = $e;
            }
        });

        /*if (count($data) > 0) {
            DB::table($module->table_name)->insert($data);
        } else {
            $errors[] = "Data dalam CSV tidak terbaca, mohon periksa file CSV tersebut";
        }*/

        $status = 200;

        if (count($errors) > 0) {
            $status = 400;
        }

        return response()->json(["status" => $status, "data" => $data, "message" => implode("<br />", $errors)], 201);
    }

    /**
     * Upload CSV file
     *
     * @param Request $request
     *
     * @return json
     */
    public function upload(Request $request)
    {
        $filePath = $request->file('file')->store('csv');

        // Read CSV
        $file = '/storage/app/' . $filePath;

        $reader = Excel::load($file)->get();
        $headerRow = $reader->first()->keys()->toArray();

        return response()->json(['location' => $filePath, 'header' => $headerRow], 200);
    }

}
