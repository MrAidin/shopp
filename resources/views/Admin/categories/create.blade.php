@extends('Admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">ایجاد دسته بندی جدید</h3>
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
                    <form action="{{route('categories.store')}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label for="name">عنوان</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="عنوان دسته بندی را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="category_parent">دسته والد</label>
                            <select class="form-control" name="category_parent" id="">
                                <option value="">بدون والد</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}"> {{$category->name}}</option>
                                    @if (count($category->childrenRecursive) > 0)
                                       @include('Admin.partials.category',['categories'=>$category->childrenRecursive,'level'=>1])
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">عنوان سئو</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="عنوان سئو را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">توضیحات سئو</label>
                            <textarea  type="text" name="meta_desc" class="form-control" placeholder="توضیحات سئو را وارد کنید"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">کلمات کلیدی سئو</label>
                            <textarea type="text" name="meta_keywords" class="form-control" placeholder="کلمات کلیدی سئو را وارد کنید"></textarea>
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
