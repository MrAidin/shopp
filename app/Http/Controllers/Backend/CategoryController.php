<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::with('childrenRecursive')
            ->Where('parent_id', null)
            ->paginate(10);
        return view('admin.categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('childrenRecursive')
            ->Where('parent_id', null)
            ->get();
        return view('admin.categories.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->parent_id = $request->input('category_parent');
        $category->meta_title = $request->input('meta_title');
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();
        return redirect('administrator/categories');

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = Category::with('childrenRecursive')
            ->Where('parent_id', null)
            ->paginate(10);
        $category = Category::findOrFail($id);
        return view('Admin.categories.edit', ['categories' => $categories, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $category = Category::findorFail($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('category_parent');
        $category->meta_title = $request->input('meta_title');
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();
        return redirect('administrator/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $category = Category::with('childrenRecursive')->where('id', $id)->first();
        if (count($category->childrenRecursive)) {
            Session::flash('error_category', " دسته بندی " . $category->name . " دارای زیر مجموعه است و حذف آن امکان پذیر نمی باشد. ");
            return redirect('administrator/categories');

        }
        $category->delete();
        return redirect('administrator/categories');


    }

    public function indexSetting($id)
    {
        $category = Category::findOrFail($id);
        $attributeGroups = AttributeGroup::all();
        return view('Admin.categories.index-setting', compact(['category', 'attributeGroups']));
    }

    public function saveSetting(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->attributeGroups()->sync($request->attributeGroups);
        $category->save();
        return redirect()->to('administrator/categories');

    }

    public function apiIndex()
    {
        $categories = Category::with('childrenRecursive')
            ->Where('parent_id', null)
            ->get();
        $response = [
            'categories' => $categories
        ];
        return response()->json($response, 200);
    }

    public function apiIndexAttribute(Request $request)
    {
        $categories =$request->all();
        $attributeGroup = AttributeGroup::with('attributesValue','categories')
            ->whereHas('categories',function ($q) use ($categories){
                $q->whereIn('categories.id',$categories);})->get();

        $response = [
            'attributes' => $attributeGroup
        ];
        return response()->json($response, 200);
    }
}
