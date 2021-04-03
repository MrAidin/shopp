@extends('Admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">ویرایش ویژگی  {{$attribute->title}}</h3>
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
                    <form action="{{route('attributes-group.update',$attribute->id)}}" method="Post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" name="title" value="{{$attribute->title}}" class="form-control"
                                   placeholder="عنوان گروه بندی ویژگی را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="type">نوع</label>
                            <select name="type" id="" class="form-control">
                                <option value="select" @if($attribute->type=='select') selected @endif>لیست تکی</option>
                                <option value="multiple" @if($attribute->type=='multiple') selected @endif>لیست چندتایی</option>
                            </select>
                        </div>


                        <div>
                            <input type="submit" class="btn btn-warning pull-left" value="ویرایش">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
@endsection
