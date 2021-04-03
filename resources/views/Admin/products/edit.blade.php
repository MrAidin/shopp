@extends('Admin.layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
@endsection
@section('content')
    <div class="card" id="app">
        <div class="card-header border-transparent">
            <h3 class="card-title pull-right">ویرایش محصول {{$product->title}}</h3>
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
                    <form action="{{route('products.update',$product->id)}}" method="Post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="title">نام محصول</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{$product->title}}" placeholder="نام محصول را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="slug">نام مستعار</label>
                            <input type="text" name="slug" class="form-control"
                                   value="{{$product->slug}}" placeholder="نام مستعار محصول را وارد کنید">
                        </div>
                        <attribute-component :brands="{{$brands}}" :product="{{$product}}"></attribute-component>
                        <div class="form-group">
                            <label>وضعیت</label>
                            <div>
                                <input type="radio" name="status" class="ml-1" value="0"
                                       @if($product->status == 0) checked @endif><span class="ml-1">منتشرنشده</span>
                                <input type="radio" name="status" class="ml-1" value="1"
                                       @if($product->status == 1) checked @endif><span
                                    class="ml-1">منتشر شده</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>قیمت</label>
                            <input type="number" name="price" class="form-control"
                                   value="{{$product->price}}" placeholder="قیمت محصول را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label>قیمت ویژه</label>
                            <input type="number" name="discount_price" class="form-control"
                                   value="{{$product->discount_price}}" placeholder="قیمت ویژه محصول را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea id="textareaDescription" type="text" name="description"
                                      class="form-control ckeditor"
                                      placeholder="توضیحات برند را وارد کنید">{{$product->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>گالری تصاویر</label>
                            <input type="hidden" name="photo_id[]" id="product-photo">
                            <div id="photo" class="dropzone"></div>
                            <div class="row">
                                @foreach($product->photos as $photo)
                                    <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                        <img src="{{$photo->path}}" width="150px" class="img-rounded shadow"
                                             alt="{{$photo->id}}">
                                        <button type="button" class="btn btn-danger"
                                                onclick="removeImages({{$photo->id}})">حذف
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="form-group">
                            <label>عنوان سئو</label>
                            <input type="text" name="meta_title" class="form-control"
                                   value="{{$product->meta_title}}" placeholder="عنوان سئو را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label>توضیحات سئو</label>
                            <textarea type="text" name="meta_desc" class="form-control"
                                      placeholder="توضیحات سئو را وارد کنید">{{$product->meta_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>کلمات کلیدی سئو</label>
                            <textarea type="text" name="meta_keywords" class="form-control"
                                      placeholder="کلمات کلیدی سئو را وارد کنید">{{$product->meta_keywords}}</textarea>
                        </div>

                        <div>
                            <input type="submit" onclick="productGallery()" class="btn btn-success pull-left"
                                   value="ذخیره">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
@endsection

@section('head-scripts')
    <script src="{{asset('js/admin-app.js')}}"></script>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
        var photosGallery = [];
        var photos = [].concat({{$product->photos->pluck('id')}})
        var drop = new Dropzone('#photo', {
            addRemoveLinks: true,
            url: "{{route('photos.upload')}}",
            sending: function (file, xhr, formData) {
                formData.append("_token", "{{csrf_token()}}")
            },
            success: function (file, response) {
                photosGallery.push(response.photo_id)
            }
        });
        productGallery = function () {
            document.getElementById("product-photo").value = photosGallery.concat(photos)
        }
        CKEDITOR.replace('textareaDescription', {
            customConfig: ' config.js',
            toolbar: 'simple',
            language: 'fa'
        })
        removeImages = function (id) {
            var index = photos.indexOf(id)
            photos.splice(index, 1);
            document.getElementById('updated_photo_' + id).remove();
        }
    </script>
@endsection

