@foreach($categories as $sub_category)
    <tr>
        <td class="text-center"><a href="#">{{$sub_category->id}}</a></td>
        <td class="text-center">{{str_repeat('----',$level)}}{{$sub_category->name}}</td>
        <td class="text-center">
            <a href="{{route('categories.edit',$sub_category->id)}}" class="btn btn-warning">ویرایش</a>
            <div class="d-inline-block">
                <form method="post" action="{{route('categories.destroy',$sub_category->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
            <a href="{{route('categories.indexSetting',$sub_category->id)}}" class="btn btn-primary">تنظیمات</a>
        </td>

    </tr>
    @if (count($sub_category->childrenRecursive) > 0)
        @include('Admin.partials.category_list',['categories'=>$sub_category->childrenRecursive,'level' => $level+1])
    @endif
@endforeach
