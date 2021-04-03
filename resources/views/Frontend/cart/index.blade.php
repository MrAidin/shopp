@extends('Frontend.layout.master')
@section('content')
    <div class="container">
        <!-- Breadcrumb Start-->
        @if(Session::has('warning'))
            <div class="alert alert-warning">
                <div>{{session('warning')}}</div>
            </div>
        @endif


        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="cart.html">سبد خرید</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">سبد خرید</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td class="text-center">تصویر</td>
                            <td class="text-left">نام محصول</td>
                            <td class="text-left">کد محصول</td>
                            <td class="text-left">تعداد</td>
                            <td class="text-right">قیمت واحد</td>
                            <td class="text-right">کل</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $product)
                            <tr>
                                <td class="text-center" width="9%"><a href="#"><img
                                            src="{{$product['item']->photos[0]->path}}"
                                            alt="{{$product['item']->title}}" title=" {{$product['item']->title}}"
                                            class="img-thumbnail"/></a></td>
                                <td class="text-left"><a href="">{{$product['item']->title}}</a><br/>
                                <td class="text-left">{{$product['item']->sku}}</td>
                                <td class="text-left">
                                    <div class="input-group btn-block quantity">
                                        <input type="text" name="quantity" value="{{$product['qty']}}" size="1"
                                               class="form-control" disabled/>
                                        <span class="input-group-btn">
                        <a href="{{route('cart.add',['id'=>$product['item']->id])}}" data-toggle="tooltip" title="اضافه"
                           class="btn btn-success"><i
                                class="fa fa-plus"></i></a>

                        <button type="button" data-toggle="tooltip" title="حذف" class="btn btn-danger"
                                onclick="event.preventDefault();
                                    document.getElementById('remove-cart-item_{{$product['item']->id}}').submit();"><i
                                class="fa fa-minus"></i></button>

                        </span>
                                        <form id="remove-cart-item_{{$product['item']->id}}"
                                              action="{{ route('cart.remove',['id'=>$product['item']->id]) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                                <td class="text-right">{{$product['item']->discount_price ? $product['item']->discount_price : $product['item']->price}}
                                    تومان
                                </td>
                                <td class="text-right">{{$product['price']}} تومان</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h2 class="subtitle">حالا مایلید چه کاری انجام دهید؟</h2>
                <p>در صورتی که کد تخفیف در اختیار دارید میتوانید از آن در اینجا استفاده کنید.</p>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">استفاده از کوپن تخفیف</h4>
                            </div>
                            <div id="collapse-coupon" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <label class="col-sm-4 control-label" for="input-coupon">کد تخفیف خود را در اینجا
                                        وارد کنید</label>
                                    <div class="input-group">
                                        <form id="coupon-form"
                                              action="{{ route('coupon.add') }}"
                                              method="POST" class="d-none">
                                            @csrf
                                            <input type="text" name="code"
                                                   placeholder="کد تخفیف خود را در اینجا وارد کنید" id="input-coupon"
                                                   class="form-control"/>
                                            <span class="input-group-btn">
                                                <button type="submit" id="button-coupon"
                                                 data-loading-text="بارگذاری ..."
                                                        class="btn btn-primary">اعمال کد تخفیف</button>
                                             </span>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="text-right"><strong>جمع کل</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPurePrice}} تومان</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>تخفیف</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalDiscount_price}} تومان</td>
                            </tr>
                            @if (Auth::check() && Session::get('cart')->couponDiscount)
                                <tr>
                                    <td class="text-right"><strong>{{Session::get('cart')->coupon['coupon']->title}}</strong></td>
                                    <td class="text-right">{{Session::get('cart')->couponDiscount}} تومان</td>
                                </tr>

                            @endif
                            <tr>
                                <td class="text-right"><strong>قابل پرداخت</strong></td>
                                <td class="text-right">{{Session::get('cart')->totalPrice}} تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="buttons">
                    <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">ادامه خرید</a></div>
                    <div class="pull-right"><a href="checkout.html" class="btn btn-primary">تسویه حساب</a></div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
@endsection
