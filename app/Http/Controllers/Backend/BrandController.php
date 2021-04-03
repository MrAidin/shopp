<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        $brands = Brand::paginate(10);
        return view('Admin.brands.index', compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.brands.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:brands',
            'description' => 'required'
        ], [
            'title.required' => 'عنوان برند را وارد کنید.',
            'title.unique' => 'این برند قبلا ثبت شده است.',
            'description.required' => 'توضیحات برند را وارد کنید.'
        ]);
        if ($validator->fails()) {
            return redirect('administrator/brands')->withErrors($validator)->withInput();
        } else {
            $brand = new Brand();
            $brand->title = $request->input('title');
            $brand->description = $request->input('description');
            $brand->photo_id = $request->input('photo_id');
            $brand->save();
            Session::flash('success', "برند با موفقیت ذخیره شد.");
            return redirect('administrator/brands');
        }
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

        $brand = Brand::with('photo')->whereId($id)->first();
        return view('Admin.brands.edit', compact(['brand']));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:brands,title,'.$id,
            'description' => 'required'
        ], [
            'title.required' => 'عنوان برند را وارد کنید.',
            'title.unique' => 'این برند قبلا ثبت شده است.',
            'description.required' => 'توضیحات برند را وارد کنید.'
        ]);
        if ($validator->fails()) {
            return redirect('administrator/brands')->withErrors($validator)->withInput();
        } else {
            $brand = Brand::FindorFail($id);
            $brand->title = $request->input('title');
            $brand->description = $request->input('description');
            $brand->photo_id = $request->input('photo_id');
            $brand->save();
            Session::flash('success', "برند  " . $brand->title . " با موفقیت ویرایش شد.");
            return redirect('administrator/brands');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $brand = Brand::FindorFail($id);
        $brand->delete();
        Session::flash('success', "برند  " . $brand->title . " با موفقیت حذف شد.");
        return redirect('administrator/brands');
    }
}
