<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $attributesValue = AttributeValue::with('attributeGroup')->paginate(10);
        return view('Admin.attributes-value.index', compact(['attributesValue']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $attributesGroup = AttributeGroup::all();
        return view('Admin.attributes-value.create', compact(['attributesGroup']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $attributeValue = new AttributeValue();
        $attributeValue->title = $request->input('title');
        $attributeValue->attributeGroup_id = $request->input('attribute_group');
        $attributeValue->save();
        Session::flash('attributes', ' مقدار ویژگی جدید با موفقیت اضافه شد.');
        return redirect('administrator/attributes-value');
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
        $attributeValue = AttributeValue::with('attributeGroup')->whereId($id)->first();
        $attributeGroup = AttributeGroup::all();
        return view('Admin.attributes-value.edit', compact(['attributeValue', 'attributeGroup']));
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
        $attributeValue =AttributeValue::findOrFail($id);
        $attributeValue->title = $request->input('title');
        $attributeValue->attributeGroup_id = $request->input('attribute_group');
        $attributeValue->save();
        Session::flash('attributes', ' مقدار ویژگی '.$attributeValue->title.' با موفقیت ویرایش شد.');
        return redirect('administrator/attributes-value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $attributeValue =AttributeValue::findOrFail($id);
        $attributeValue->delete();
        Session::flash('attributes', ' مقدار ویژگی '. $attributeValue->title.' حذف شد');
        return redirect('administrator/attributes-value');

    }
}
