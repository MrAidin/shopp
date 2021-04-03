<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\exactly;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate('10');
        return view('Admin.products.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
//        $categories = Category::with('childrenRecursive')->where('parent_id',null)->get();
        return view('Admin.products.create', compact(['brands',]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateSKU()
    {
        $number = mt_rand(1000, 999999);
        if ($this->checkSKU($number)) {
            return $this->generateSKU();
        }
        return (string)$number;
    }



    public function checkSKU($number)
    {
        return Product::where('sku', $number)->exists();
    }
    function makeSlug($string){
        $string= strtolower($string);
        $string =str_replace(['؟','?'],'',$string);
        return preg_replace('/\s+/u','-',trim($string));
    }


    public function store(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->sku = $this->generateSKU();
        $product->slug = $this->makeSlug($request->slug);
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->brand_id = $request->brand;
        $product->user_id = 1;
        $product->save();
        $attributes = explode(',',$request->input('attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);
        $product->categories()->sync($request->categories);
        $product->attributeValues()->sync($attributes);
        $product->photos()->sync($photos);
        Session::flash('success', "کالا ذخیره شد.");
        return redirect('administrator/products');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::all();
        $product = Product::with(['attributeValues','brand','categories','photos'])->whereId($id)->first();
        return view('Admin.products.edit', compact(['brands','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->sku = $this->generateSKU();
        $product->slug = $this->makeSlug($request->slug);
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->brand_id = $request->brand;
        $product->user_id = 1;
        $product->meta_desc =  $request->meta_desc;
        $product->meta_title =  $request->meta_title;
        $product->meta_keywords =  $request->meta_keywords;
        $product->save();
        $attributes = explode(',',$request->input('attributes')[0]);
        $photos = explode(',',$request->input('photo_id')[0]);
        $product->categories()->sync($request->categories);
        $product->attributeValues()->sync($attributes);
        $product->photos()->sync($photos);
        Session::flash('success',   '   کالا ' . $product->title. ' با موفقیت ویرایش شد. ');
        return redirect('administrator/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Session::flash('success',   '   کالا ' . $product->title. ' با موفقیت حذف شد. ');
        return redirect('administrator/products');


    }
}
