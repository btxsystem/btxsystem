
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employeer;

class MembershipController extends Controller
{
    public function index(){
        $child = Employeer::nested()->renderAsJson();
        dd($child);
    } 

    public function tree(){
    	return view('admin.tree.index');
    }
}
