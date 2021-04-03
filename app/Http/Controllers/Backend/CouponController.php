<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('Admin.coupons.index', compact(['coupons']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.coupons.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->status = $request->status;
        $coupon->save();
        Session::flash('success', 'کد تخفیف با موفقیت ذخیره شد.');
        return redirect('/administrator/coupons');


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
        $coupon = Coupon::findOrFail($id);
        return view('Admin.coupons.edit', compact(['coupon']));
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
        $coupon = Coupon::findOrFail($id);
        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->status = $request->status;
        $coupon->save();
        Session::flash('success', 'کد تخفیف '. $coupon->title .' موفقیت ویرایش شد.');
        return redirect('/administrator/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        Session::flash('success', 'کد تخفیف '. $coupon->title .' موفقیت حذف شد.');
        return redirect('/administrator/coupons');
    }
}
