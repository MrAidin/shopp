@extends('Admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">ایجاد مقدار ویژگی جدید</h3>
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
                    <form action="{{route('attributes-value.store')}}" method="Post">
                        @csrf
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="title">عنوان</label>--}}
                        {{--                            <input type="text" name="title" class="form-control"--}}
                        {{--                                   placeholder="مقدار ویژگی را وارد کنید">--}}
                        {{--                        </div>--}}
                        <div class="form-group">
                            <label for="attribute_group">انتخاب ویژگی</label>
                            <select name="attribute_group" id="" class="form-control">
                                <option value="" disabled>انتخاب کنید</option>

                                @foreach($attributesGroup as $attribute)
                                    <option value="{{$attribute->id}}">{{$attribute->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" name="title" class="form-control"
                                   placeholder="مقدار ویژگی را وارد کنید ...">
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
