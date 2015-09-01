@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">{{$input->title_id}}</h2>
		</div>
	</div>
	@if($errors->first())
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 bg-danger text-center text-danger">
			<strong class="">{{$errors->first()}}</strong>
		</div>
	</div>
	<hr/>
	@endif
	
	{{ Form::open(array('route' => 'admin.general.submit','class' => 'form-horizontal')) }}
	<input type="hidden" name="_action" id="_action" value="{{$formProcess or 'addProcess'}}"/>
	<input type="hidden" name="id" value="{{$input['id'] or ''}}"/>
	<div class="form-group">
		<label for="content_id" class="col-sm-2 control-label">Bahasa Indonesia</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control wysiwyg" id="content_id" name="content_id" placeholder="Konten Bahasa Indonesia">{{$input['value_id'] or ''}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="content_en" class="col-sm-2 control-label">English</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control wysiwyg" id="content_en" name="content_en" placeholder="English Content">{{$input['value_en'] or ''}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-2">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
		<div class="col-sm-6">
			<a href="{{URL::route('admin.general')}}"><button type="button" class="btn btn-default">Back</button></a>
		</div>
	</div>
	{{Form::close()}}
@stop
@section('styles')
<link rel="stylesheet" href="{{assets_url('admin/css/vendors/summernote.css')}}">
@stop

@section('scripts')
<script type="text/javascript" src="{{assets_url('admin/js/vendors/summernote.js')}}"></script>
<script type="text/javascript">
	$('.wysiwyg').summernote({
       height: 200,
       styleWithSpan: false,
       onImageUpload: function(files, editor, welEditable) {
         sendFile(files[0], editor, welEditable);
       },
       toolbar: [
         ['style', ['bold', 'italic', 'underline', 'clear']],
         ['font', ['strikethrough']],
         ['fontsize', ['fontsize']],
         ['color', ['color']],
         ['para', ['ul', 'ol', 'paragraph']],
         ['height', ['height']],
         ['table', ['table']],
         ['insert', ['link', 'picture', 'video']],
         ['code', ['codeview', 'undo', 'redo', 'help']]
       ]
     });
     
     function sendFile(file, editor, welEditable) {
       data = new FormData();
       data.append('file', file);
       $.ajax({
         data:  data,
         type: "POST",
         url: "{{ URL::route('admin.product.create-image-ajax') }}",
         cache: false,
         contentType: false,
         processData: false,
         success: function(url) {
           editor.insertImage(welEditable, url);
           // window.alert(url);
         }
       });
	};
</script>

@stop