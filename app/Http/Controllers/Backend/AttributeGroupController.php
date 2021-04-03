<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = AttributeGroup::paginate(10);
        return view('Admin.attributes.index', compact(['attributes']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.attributes.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $attributegroup = new AttributeGroup();
        $attributegroup->title = $request->input('title');
        $attributegroup->type = $request->input('type');
        $attributegroup->save();
        Session::flash('attributes', 'ویژگی جدید با موفقیت اضافه شد.');
        return redirect('administrator/attributes-group');
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
        $attribute = AttributeGroup::findOrFail($id);
        return view('Admin.attributes.edit', compact(['attribute']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributegroup =AttributeGroup::findOrFail($id);
        $attributegroup->title = $request->input('title');
        $attributegroup->type = $request->input('type');
        $attributegroup->save();
        Session::flash('attributes', 'ویژگی '.$attributegroup->title.' با موفقیت ویرایش شد.');
        return redirect('administrator/attributes-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $attributegroup =AttributeGroup::findOrFail($id);
        $attributegroup->delete();
        Session::flash('attributes', 'ویژگی مورد نظر حذف شد');
        return redirect('administrator/attributes-group');


    }
}
