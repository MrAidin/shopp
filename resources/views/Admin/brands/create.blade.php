@extends('Admin.layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">ایجاد برند جدید</h3>
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
                    <form action="{{route('brands.store')}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" name="title" class="form-control"
                                   placeholder="نام برند را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="description">توضیحات</label>
                            <textarea type="text" name="description" class="form-control"
                                      placeholder="توضیحات برند را وارد کنید"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="title">تصویر</label>
                            <input type="hidden" name="photo_id" id="brand-photo" value="">
                            <div id="photo" class="dropzone"></div>
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
@section('scripts')
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script>
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            maxFiles: 1,
            url: "{{route('photos.upload')}}",
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{csrf_token()}}")
            },
            success: function (file, response) {
                document.getElementById("brand-photo").value =response.photo_id
            }
        });
    </script>
@endsection
