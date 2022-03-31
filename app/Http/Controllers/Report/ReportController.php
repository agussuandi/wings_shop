<?php
 
namespace App\Http\Controllers\Report;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Crypt;
use Exception;

use App\Models\TrxHPenjualan\TrxHPenjualan;
use App\Models\TrxDPenjualan\TrxDPenjualan;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $reports = TrxHPenjualan::paginate(10);
            return view('front.report.index', [
                'reports' => $reports
            ]);    
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }
}