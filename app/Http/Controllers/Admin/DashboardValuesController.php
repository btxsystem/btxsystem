<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employeer;
use App\Downline;
use App\Customer\Customer;
use Illuminate\Support\Facades\DB;

class DashboardValuesController extends Controller
{
    public function data(){
        $active = DB::table('employeers')->select('id')
                            ->where('status',1)->get();
        $non_active = DB::table('employeers')->select('id')
                            ->where('status',0)->get();
        $sales = DB::table('transaction_member')->select('id')
                            ->where('status',1)->where('transaction_ref','<>',null)->get();
        $bonus = DB::table('history_bitrex_cash')->select('id')
                            ->where('info',1)->sum('nominal');
        $datas['active'] = count($active);
        $datas['non_active'] = count($non_active);
        $datas['sales'] = count($sales);
        $datas['bonus'] = $bonus;
        return response()->json($datas, 200);
    }

    public function analyzer()
    {
       $datas = Employeer::with('allChildren')->get();
       foreach($datas as $data){
            $dataArray = [];
            foreach($data->allChildren as $key => $children){
                foreach($children->allChildren as $subchildren){
                    foreach($subchildren->allChildren as $sub1children){
                        foreach($sub1children->allChildren as $sub2children){
                            foreach($sub2children->allChildren as $sub3children){
                                foreach($sub3children->allChildren as $sub4children){
                                    foreach($sub4children->allChildren as $sub5children){
                                        foreach($sub5children->allChildren as $sub6children){
                                            foreach($sub6children->allChildren as $sub7children){
                                                foreach($sub7children->allChildren as $sub8children){
                                                    foreach($sub8children->allChildren as $sub9children){
                                                        foreach($sub9children->allChildren as $sub10children){
                                                            foreach($sub10children->allChildren as $sub11children){
                                                                foreach($sub11children->allChildren as $sub12children){
                                                                    foreach($sub12children->allChildren as $sub13children){
                                                                        foreach($sub13children->allChildren as $sub14children){
                                                                            foreach($sub14children->allChildren as $sub15children){
                                                                                foreach($sub15children->allChildren as $sub16children){
                                                                                    foreach($sub16children->allChildren as $sub17children){
                                                                                        foreach($sub17children->allChildren as $sub18children){
                                                                                            foreach($sub18children->allChildren as $sub19children){
                                                                                                foreach($sub19children->allChildren as $sub20children){
                                                                                                    foreach($sub20children->allChildren as $sub21children){
                                                                                                        foreach($sub21children->allChildren as $sub22children){
                                                                                                            foreach($sub22children->allChildren as $sub23children){
                                                                                                                foreach($sub23children->allChildren as $sub24children){
                                                                                                                    foreach($sub24children->allChildren as $sub25children){
                                                                                                                        foreach($sub25children->allChildren as $sub26children){
                                                                                                                            foreach($sub26children->allChildren as $sub27children){
                                                                                                                                foreach($sub27children->allChildren as $sub28children){
                                                                                                                                    foreach($sub28children->allChildren as $sub29children){
                                                                                                                                        foreach($sub29children->allChildren as $sub30children){
                                                                                                                                            foreach($sub30children->allChildren as $sub31children){
                                                                                                                                                foreach($sub31children->allChildren as $sub32children){
                                                                                                                                                    foreach($sub32children->allChildren as $sub33children){
                                                                                                                                                        $sub33insert = $sub33children->id .',';
                                                                                                                                        
                                                                                                                                                        \array_push($dataArray, $sub33insert);
                                                                                                                                                    }
                                                                                                                                                    $sub32insert = $sub32children->id .',';
                                                                                                                                    
                                                                                                                                                    \array_push($dataArray, $sub32insert);
                                                                                                                                                }
                                                                                                                                                $sub31insert = $sub31children->id .',';
                                                                                                                                
                                                                                                                                                \array_push($dataArray, $sub31insert);
                                                                                                                                            }
                                                                                                                                            $sub30insert = $sub30children->id .',';
                                                                                                                            
                                                                                                                                            \array_push($dataArray, $sub30insert);
                                                                                                                                        }
                                                                                                                                        $sub29insert = $sub29children->id .',';
                                                                                                                        
                                                                                                                                        \array_push($dataArray, $sub29insert);
                                                                                                                                    }
                                                                                                                                    $sub28insert = $sub28children->id .',';
                                                                                                                    
                                                                                                                                    \array_push($dataArray, $sub28insert);
                                                                                                                                }
                                                                                                                                $sub27insert = $sub27children->id .',';
                                                                                                                
                                                                                                                                \array_push($dataArray, $sub27insert);
                                                                                                                            }
                                                                                                                            $sub26insert = $sub26children->id .',';
                                                                                                            
                                                                                                                            \array_push($dataArray, $sub26insert);
                                                                                                                        }
                                                                                                                        $sub25insert = $sub25children->id .',';
                                                                                                        
                                                                                                                        \array_push($dataArray, $sub25insert);
                                                                                                                    }
                                                                                                                    $sub24insert = $sub24children->id .',';
                                                                                                    
                                                                                                                    \array_push($dataArray, $sub24insert);
                                                                                                                }
                                                                                                                $sub23insert = $sub23children->id .',';
                                                                                                
                                                                                                                \array_push($dataArray, $sub23insert);
                                                                                                            }
                                                                                                            $sub22insert = $sub22children->id .',';
                                                                                            
                                                                                                            \array_push($dataArray, $sub22insert);
                                                                                                        }
                                                                                                        $sub21insert = $sub21children->id .',';
                                                                                        
                                                                                                        \array_push($dataArray, $sub21insert);
                                                                                                    }
                                                                                                    $sub20insert = $sub20children->id .',';
                                                                                    
                                                                                                    \array_push($dataArray, $sub20insert);
                                                                                                }
                                                                                                $sub19insert = $sub19children->id .',';
                                                                                
                                                                                                \array_push($dataArray, $sub19insert);
                                                                                            }
                                                                                            $sub18insert = $sub18children->id .',';
                                                                            
                                                                                            \array_push($dataArray, $sub18insert);
                                                                                        }
                                                                                        $sub17insert = $sub17children->id .',';
                                                                        
                                                                                        \array_push($dataArray, $sub17insert);
                                                                                    }
                                                                                    $sub16insert = $sub16children->id .',';
                                                                    
                                                                                    \array_push($dataArray, $sub16insert);
                                                                                }
                                                                                $sub15insert = $sub15children->id .',';
                                                                
                                                                                \array_push($dataArray, $sub15insert);
                                                                            }
                                                                            $sub14insert = $sub14children->id .',';
                                                            
                                                                            \array_push($dataArray, $sub14insert);
                                                                        }
                                                                        $sub13insert = $sub13children->id .',';
                                                        
                                                                        \array_push($dataArray, $sub13insert);
                                                                    }
                                                                    $sub12insert = $sub12children->id .',';
                                                    
                                                                    \array_push($dataArray, $sub12insert);
                                                                }
                                                                $sub11insert = $sub11children->id .',';
                                                
                                                                \array_push($dataArray, $sub11insert);
                                                            }
                                                            $sub10insert = $sub10children->id .',';
                                            
                                                            \array_push($dataArray, $sub10insert);
                                                        }
                                                        $sub9insert = $sub9children->id .',';
                                        
                                                        \array_push($dataArray, $sub9insert);
                                                    }
                                                    $sub8insert = $sub8children->id .',';
                                    
                                                    \array_push($dataArray, $sub8insert);
                                                }
                                                $sub7insert = $sub7children->id .',';
                                
                                                \array_push($dataArray, $sub7insert);
                                            }
                                            $sub6insert = $sub6children->id .',';
                            
                                            \array_push($dataArray, $sub6insert);
                                        }
                                        $sub5insert = $sub5children->id .',';
                        
                                        \array_push($dataArray, $sub5insert);
                                    }
                                    $sub4insert = $sub4children->id .',';
                    
                                    \array_push($dataArray, $sub4insert);
                                }
                                $sub3insert = $sub3children->id .',';
                
                                \array_push($dataArray, $sub3insert);
                            }
                            $sub2insert = $sub2children->id .',';
            
                            \array_push($dataArray, $sub2insert);
                        }

                        $sub1insert = $sub1children->id .',';
        
                        \array_push($dataArray, $sub1insert);
                    }
                    $subinsert = $subchildren->id .',';

                    \array_push($dataArray, $subinsert);
                }

                $insert = $children->id .',';

                \array_push($dataArray, $insert);
            }        

            $this->updateDownline($data->id, implode(" ", $dataArray));

        }

        return 'Done !!';
    }



    public function updateDownline($parent_id, $idArray)
    {
        DB::table('downlines')
            ->updateOrInsert(
                ['member_id' => $parent_id],
                ['downline' => $idArray]
        );
    }

    public function getDownlines()
    {
        $data = Downline::select('downline')->find(3);

        // return $data;

        $arrayId = explode(",",$data->downline);

        // return $arrayId;

        $test = Employeer::whereIn('id', $arrayId)->orderBy('id','desc')->paginate(5);

        return $test;
    }

}
