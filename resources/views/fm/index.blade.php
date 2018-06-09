@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <iframe src="{{url('/fileman/index.html?integration=ckeditor&CKEditor=description&CKEditorFuncNum=1&langCode=en')}}"
 width="100%" height="720px" frameborder="0">
    </div>
</div>

</iframe>
@endsection