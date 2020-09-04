<?php

namespace App\Http\Controllers\Ebook\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\Ebook;
use App\Employeer;
use App\Models\NonMember;
use App\Models\TransactionNonMember;
use App\Models\TransactionMember;

class EbookController extends Controller
{
  public function all(Request $request)
  {
    $ebooks = Ebook::where('parent_id', 0)
      ->select('id', 'price', 'pv', 'bv', 'price_markup', 'description', 'title', 'price_discount', 'minimum_product', 'started_at', 'ended_at', 'maximum_product', 'register_promotion', 'allow_merge_discount')
      ->orderBy('position', 'ASC')
      ->get();
  
    return response()->json([
      'success' => true,
      'message' => '',
      'data' => $ebooks
    ]);
  }
}
