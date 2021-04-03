@extends('Admin.layouts.master')
@section('content')

        @if(Session::has('attributes'))
            <div class="alert alert-success">
                <div>{{session('attributes')}}</div>
            </div>
        @endif
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title "> مقادیر ویژگی</h3>
            <a class="btn btn-app pull-left" href="{{route('attributes-value.create')}}">
                <i class="fa fa-plus"></i>جدید
            </a>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0" style="display: block;">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th class="text-center">شناسه</th>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">ویژگی</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributesValue as $attribute)
                        <tr>
                            <td class="text-center"><a href="#">{{$attribute->id}}</a></td>
                            <td class="text-center">{{$attribute->title}}</td>
                            <td class="text-center">{{$attribute->attributeGroup->title}}</td>
                            <td class="text-center">
                                <a href="{{route('attributes-value.edit',$attribute->id)}}" class="btn btn-warning">ویرایش</a>
                                <div class="d-inline-block">
                                    <form method="post" action="{{route('attributes-value.destroy',$attribute->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix" style="display: block;">

        </div>
        <!-- /.card-footer -->
    </div>
@endsection
