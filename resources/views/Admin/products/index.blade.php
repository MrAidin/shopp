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
            <h3 class="card-title ">محصولات</h3>
            <a class="btn btn-app pull-left" href="{{route('products.create')}}">
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
                        <th class="text-center">کد محصول</th>
                        <th class="text-center">عنوان</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="text-center"><a href="#">{{$product->id}}</a></td>
                            <td class="text-center"><a href="#">{{$product->sku}}</a></td>
                            <td class="text-center">{{$product->title}}</td>
                            <td class="text-center">
                                <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">ویرایش</a>
                                <div class="d-inline-block">
                                    <form method="post" action="{{route('products.destroy',$product->id)}}">
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
                <div class="col-md-12">{{$products->links()}}</div>
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
