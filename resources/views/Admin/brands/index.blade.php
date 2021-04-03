@extends('Admin.layouts.master')
@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            <div>{{session('success')}}</div>
        </div>
    @endif
    @include('Admin.partials.form-errors')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title "> برندها</h3>
            <a class="btn btn-app pull-left" href="{{route('brands.create')}}">
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
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td class="text-center"><a href="#">{{$brand->id}}</a></td>
                            <td class="text-center">{{$brand->title}}</td>
                            <td class="text-center">
                                <a href="{{route('brands.edit',$brand->id)}}" class="btn btn-warning">ویرایش</a>
                                <div class="d-inline-block">
                                    <form method="post" action="{{route('brands.destroy',$brand->id)}}">
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
        <div class="card-footer clearfix">
        </div>
        <!-- /.card-footer -->
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/admin-app.js')}}"></script>
@endsection
