<?php
/**
 * SMS Console API
 *
 * PHP version 7.1
 *
 * @category Modules
 * @package  App
 * @author   Asma <rijalmohamad.rijal@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebonsoftware
 */

/**
 * Module Permission
 *
 * Module to manage system permissions
 *
 * Table : permissions
 *
 * @category Controller
 * @package  App\Http\Controllers\Api
 * @author   Asma <rijalmohamad.rijal@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     cirebonsoftware
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionsController extends Controller
{
    /**
     * Return all permissions
     * <System>.<Module>.<Action>
     *
     * @return json
     */
    public function index()
    {
        $model = new Permission; 

        $records = $model::orderBy('name','asc')->get();

        $list = array();

        $data = array();

        foreach ($records as $row) {
            $rowArr = explode(".", $row->name);

            $list[ $rowArr[0] ][ $rowArr[1] ][ $rowArr[2] ] = $row->id;
        }

        $data = array();

        foreach ($list as $system => $row1) {

            $modules = array();

            foreach ($row1 as $module => $row2) {

                $actions = array();

                foreach ($row2 as $action => $permissionId) {
                    $actions[] = array(
                        'name' => $action,
                        'permissionId'  => $permissionId
                    );
                }

                $modules[] = array(
                    'name' => $module,
                    'actions' => $actions
                );
            }

            $data[] = array(
                'name' => $system,
                'modules' => $modules
            );
        }

        return response()->json(['data' => $data], 200);
    }

    /**
     * Return specific permissions
     *
     * @return json
     */
    public function show(Permissions $model)
    {
        return $model;
    }

    /**
     * Create a new permissions
     *
     * @return json
     */
    public function create(Request $request)
    {
        $model = new Permissions;
        $result = $model::create($request->all());

        return response()->json($result, 201);
    }

    /**
     * Update permissions
     *
     * @return json
     */
    public function update(Request $request, Permissions $model)
    {
        $model->update($request->all());

        return response()->json($model, 200);
    }

    /**
     * Delele permissions
     *
     * @return json
     */
    public function delete(Permissions $model)
    {
        $model->delete();

        return response()->json(null, 204);
    }
}
