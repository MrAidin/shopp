@extends('Admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">تعیین ویژگی {{$category->name}}</h3>
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
                    <form action="{{route('categories.saveSetting',$category->id)}}" method="Post">
                        @csrf

                        <div class="form-group">
                            <label for="category_parent">تعیین ویژگی های {{$category->name}}</label>
                            <select class="form-control" name="attributeGroups[]" id="" multiple>
                                @foreach($attributeGroups as $attributeGroup)
                                    <option value="{{$attributeGroup->id}}"
                                            @if (in_array($attributeGroup->id, $category->attributeGroups->pluck('id')->toArray())) selected @endif>{{$attributeGroup->title}}</option>
                                @endforeach
                            </select>
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
