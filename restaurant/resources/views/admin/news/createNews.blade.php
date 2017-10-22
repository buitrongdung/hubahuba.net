@extends('admin.layouts.master1')
@section('content')

<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Viết bài
	        	</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                @include ('block.error')
				<form  method="POST" action="{{route('admin.post.storeNews')}}" enctype="multipart/form-data" class="form-horizontal" novalidate>
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<fieldset>
						<div class="form-group">
							<label class="col-sm-3 control-label">Loại tin</label>
							<div class="col-sm-4">
								<select name="type_id" class="form-control">
									<option value="0">Bài viết</option>
									<option value="1">Khuyến mãi</option>
									<option value="2">Giới thiệu</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Hình ảnh</label>
							<div class="col-sm-5">
								<input type="file" name="image" value="{{old('image')}}" >
							</div>
						</div>
						<div class="form-group" style="margin-top: -15px">
							<label class="col-sm-3 control-label" >Tiêu để</label>
							<div class="col-sm-9">
								<textarea type="text" name="title" value="{{old('title')}}" class="form-control" required>
									</textarea>
							</div>
						</div>
						<div class="form-group" style="margin-top: -15px">
							<label class="col-sm-3 control-label">Tóm tắt</label>
						</div>
							<div style="width: 175%;margin-bottom: 17px">
								<textarea  type="text" name="summary" value="{{old('summary')}}"  ></textarea>
								<script type="text/javascript">
                                    var editor = CKEDITOR.replace('summary',{
                                        language : 'vi',
                                        filebrowserImageBrowseUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
								</script>
							</div>
						
						<div class="form-group" style="margin-top: -15px">
							<label class="col-sm-3 control-label">Nội dung</label>
						</div>	
						<div style="width: 175%;margin-bottom: 17px">
							<textarea id="content" name="content" value="{{old('content')}}" required></textarea>
							<script type="text/javascript">
                                var editor = CKEDITOR.replace('content',{
                                    language : 'vi',
                                    filebrowserImageBrowseUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/ckfinder.html?Type=Images',
                                    filebrowserFlashBrowseUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/ckfinder.html?Type=Flash',
                                    filebrowserImageUploadUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                    filebrowserFlashUploadUrl : '../../../../qt64-admin/templates/js/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                });
							</script>
						</div>
						<div class="form-group" style="margin-top: -15px">
							<label class="col-sm-3 control-label" >Thẻ tag</label>
							<div class="col-sm-9">
								<textarea type="text" name="tag" value="{{old('tag')}}" class="form-control" >
									</textarea>
							</div>
						</div>
						<div class="col-sm-3 form-group" style="margin-left: 128px;width: 161px">
							<button type="submit" value="Addpost" name="Addpost" class="btn btn-primary" ><strong>Thêm</strong></button>
							<button type="reset" value="Reset" name="reset" class="btn">Reset</button>
						</div>
					</fieldset>
				</form>
				</div>
            </div>
        </div>
    </div>

{{--<script src="{!! url('admin/tinymce/jquery-1.11.1.min.js') !!}"></script>--}}
{{--<script src="{!! url('admin/tinymce/tinymce.min.js') !!}"></script>--}}
{{--<script src="{!! url('vendor/unisharp/laravel-ckeditor/ckeditor.js') !!}"></script>--}}
{{--<script src="{!! url('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') !!}"></script>--}}

{{--<script src="{!! url('vendor/laravel-filemanager/js/lfm.js') !!}"></script>--}}
{{--<script>--}}
  {{--var editor_config = {--}}
    {{--path_absolute : "{{url('/')}}/",--}}
    {{--selector: "textarea.tinymce",--}}
    {{--theme: "modern",--}}
		{{--skin: "lightgray",--}}
		{{--statubar: true,--}}
    {{--plugins: [--}}
      {{--"advlist autolink lists link image charmap print preview hr anchor pagebreak",--}}
      {{--"searchreplace wordcount visualblocks visualchars code fullscreen",--}}
      {{--"insertdatetime media nonbreaking save table contextmenu directionality",--}}
      {{--"emoticons template paste textcolor colorpicker textpattern"--}}
    {{--],--}}
    {{--toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print preview media fullpage | forecolor backcolor emoticons",--}}

    {{--relative_urls: true,--}}
	{{--remove_script_host : true,--}}
	{{--document_base_url : 'http://hubahuba.lvh.me/',--}}
    {{--file_browser_callback : function(field_name, url, type, win) {--}}
      {{--var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;--}}
      {{--var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;--}}

      {{--var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;--}}
      {{--if (type == 'image') {--}}
        {{--cmsURL = cmsURL + "&type=Images";--}}
      {{--} else {--}}
        {{--cmsURL = cmsURL + "&type=Files";--}}
      {{--}--}}

      {{--tinyMCE.activeEditor.windowManager.open({--}}
        {{--file : cmsURL,--}}
        {{--title : 'Filemanager',--}}
        {{--width : x * 0.8,--}}
        {{--height : y * 0.8,--}}
        {{--resizable : "yes",--}}
        {{--close_previous : "no"--}}
      {{--});--}}
    {{--}--}}
  {{--};--}}

  {{--tinymce.init(editor_config);--}}
{{--</script>--}}
@stop