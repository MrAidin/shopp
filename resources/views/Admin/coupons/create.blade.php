@extends('Admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">ایجاد کد تخفیف جدید</h3>
            {{--            <a  class="btn btn-app " href="{{route('categories.create')}}">--}}
            {{--                <i class="fa fa-plus"></i>جدید--}}
            {{--            </a>--}}

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0" style="display: block;">

            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix" style="display: block;">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <form action="{{route('coupons.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">عنوان کد تخفیف</label>
                            <input type="text" name="title" class="form-control"
                                   placeholder="نام کد تخفیف را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="code">کد</label>
                            <input type="text" name="code" class="form-control"
                                   placeholder=" کد تخفیف را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="code">قیمت</label>
                            <input type="number" name="price" class="form-control"
                                   placeholder=" قیمت را وارد کنید">
                        </div>
                        <div class="form-group">

                            <label>وضعیت</label>
                            <div>
                                <input type="radio" name="status" class="ml-1" value="0" checked><span class="ml-1">منتشرنشده</span>
                                <input type="radio" name="status" class="ml-1" value="1"><span class="ml-1">منتشر شده</span>
                            </div>
                        </div>


                        <div>
                            <input type="submit" class="btn btn-success pull-left" value="ذخیره">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
@endsection
