<?php
 
namespace App\Http\Controllers\Checkout;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Crypt;
use Exception;

use App\Models\TrxHPenjualan\TrxHPenjualan;
use App\Models\TrxDPenjualan\TrxDPenjualan;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            if (!Auth::check())
            {
                return redirect('/login')->with('error', 'Login first before checkout!');
            }
            $carts = session()->get('cart');
            if (sizeof($carts) < 1)
            {
                return redirect()->back()->with('error', 'Cart empty, please choose product first!');
            }

            DB::beginTransaction();
            $trxHPenjualan = new TrxHPenjualan;
            $trxHPenjualan->code        = self::generateCode();
            $trxHPenjualan->total       = $request->total;
            $trxHPenjualan->trans_date  = date('Y-m-d');
            $trxHPenjualan->created_by  = Auth::user()->id;
            $trxHPenjualan->created_at  = date('Y-m-d H:i:s');
            $trxHPenjualan->save();
            
            foreach ($carts as $keyCart => $cart)
            {
                $trxDPenjualan              = new TrxDPenjualan;
                $trxDPenjualan->trx_h_id    = $trxHPenjualan->id;
                $trxDPenjualan->product_id  = $cart['id'];
                $trxDPenjualan->qty         = $cart['quantity'];
                $trxDPenjualan->price       = $cart['price'];
                $trxDPenjualan->sub_total   = (int)$cart['price'] * (int)$cart['quantity'];
                $trxDPenjualan->created_by  = Auth::user()->id;
                $trxDPenjualan->created_at  = date('Y-m-d H:i:s');
                $trxDPenjualan->save();
            }
            DB::commit();

            session()->put('cart', []);
            return redirect()->back()->with('error', 'Success checkout!');
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed checkout!');
        }
    }

    private static function generateCode()
    {
        $currentCode =TrxHPenjualan::selectRaw('MAX(SUBSTRING(code, 4, 5)) as noreg')
            ->whereRaw('substring(code, -2) = '.date('y'))
            ->orderBy('id', 'DESC')
        ->first();

        if($currentCode && $currentCode != null)
        {
            $maxIdValid = (int)$currentCode->noreg;
            $urutan = $maxIdValid + 1;
        }
        else
        {
            $urutan = 1;
        }

        return $newNoReg = 'TRX' . str_pad($urutan, 5, 0, STR_PAD_LEFT) . '.' . date('y');
    }
}