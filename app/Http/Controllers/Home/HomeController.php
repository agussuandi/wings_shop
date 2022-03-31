<?php
 
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use Auth;
use Exception;

use App\Models\MProducts\MProducts;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $products = MProducts::paginate(10);
            
            return view('front.home.index', [
                'products' => $products
            ]);    
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }
}