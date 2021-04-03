@if (count($errors)>0)
    <div class=" alert alert-danger">
        <ul>  @foreach($errors->all() as $error)
                <div> {{$error}} </div>
            @endforeach
        </ul>
    </div>
@endif
