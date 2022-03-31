<?php
 
namespace App\Http\Controllers\Products;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

use DB;
use Str;
use Auth;
use Crypt;
use Image;
use Storage;
use Exception;

use App\Models\MProducts\MProducts;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $products = MProducts::paginate(10);
            
            return view('front.products.index', [
                'products' => $products
            ]);    
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function create(Request $request)
    {
        try
        {
            return view('front.products.create');
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $productCode = self::generateCode();
            $userInfo    = Auth::user();
            $imgName     = Str::slug($request->name);
            $extension   = $request->thumbnail->extension();
            $fileName    = "{$imgName}.{$extension}";
            $pathPrefix  = "public/products";
            Storage::put("{$pathPrefix}/{$fileName}", Image::make($request->file('thumbnail')->path())->resize(200, 200)->stream($extension, 100));
            $putContent  = "{$pathPrefix}/{$fileName}";

            DB::beginTransaction();
            $mProduct               = new MProducts();
            $mProduct->code         = $productCode;
            $mProduct->name         = $request->name;
            $mProduct->price        = $request->price;
            $mProduct->currency     = $request->currency;
            $mProduct->discount     = $request->discount;
            $mProduct->dimension    = $request->dimension;
            $mProduct->unit         = $request->unit;
            $mProduct->thumbnail    = str_replace('public', 'storage', $putContent);
            $mProduct->created_by   = $userInfo->id;
            $mProduct->created_at   = date('Y-m-d H:i:s');
            $mProduct->save();
            DB::commit();

            return redirect('products')->with('success', 'Success create product');

        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect('products')->with('error', 'Failed create product');
        }
    }

    public function show(Request $request, $id)
    {
        try
        {
            $product = MProducts::find(Crypt::decryptString($id));

            return view('front.products.show', [
                'product' => $product
            ]);
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function edit(Request $request, $id)
    {
        try
        {
            $product = MProducts::find(Crypt::decryptString($id));

            return view('front.products.update', [
                'product' => $product
            ]);
        }
        catch (Exception $e)
        {
            abort(500);
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $userInfo = Auth::user();
            if ($request->thumbnail && $request->thumbnail !== null)
            {
                $imgName     = Str::slug($request->name);
                $extension   = $request->thumbnail->extension();
                $fileName    = "{$imgName}.{$extension}";
                $pathPrefix  = "public/products";
                Storage::put("{$pathPrefix}/{$fileName}", Image::make($request->file('thumbnail')->path())->resize(200, 200)->stream($extension, 100));
                $putContent  = "{$pathPrefix}/{$fileName}";
            }

            DB::beginTransaction();
            $mProduct               = MProducts::find(Crypt::decryptString($id));
            $mProduct->name         = $request->name;
            $mProduct->price        = $request->price;
            $mProduct->currency     = $request->currency;
            $mProduct->discount     = $request->discount;
            $mProduct->dimension    = $request->dimension;
            $mProduct->unit         = $request->unit;
            if ($request->thumbnail && $request->thumbnail !== null)
            {
                $mProduct->thumbnail = str_replace('public', 'storage', $putContent);
            }
            $mProduct->updated_by   = $userInfo->id;
            $mProduct->updated_at   = date('Y-m-d H:i:s');
            $mProduct->save();
            DB::commit();

            return redirect('products')->with('success', 'Success update product');

        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect('products')->with('error', 'Failed update product');
        }
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();
            MProducts::find(Crypt::decryptString($id))->delete();
            DB::commit();
            
            return redirect('products')->with('success', 'Success create product');
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect('products')->with('error', 'Failed delete product');
        }
    }

    private static function generateCode()
    {
        $product = MProducts::select('code')
            ->orderBy('id', 'DESC')
        ->first();

        if ($product === null) return 10000001;

        $productCode = intval($product->code) + 1;

        return $productCode;
    }
}