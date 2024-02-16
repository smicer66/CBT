@extends('back.template')

@section('head')

	{!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') !!}

@stop

@section('main')

	<!-- Entête de page -->
	@include('back.partials.entete', ['title' => trans('back/announcement.dashboard'), 'icone' => 'pencil', 'fil' => link_to('announcement', 'Announcements') . ' / ' . trans('back/announcement.creation')])

	<div class="col-sm-12">
		@yield('form')



		<div class="form-group checkbox pull-right">
			<label>
				{!! Form::checkbox('is_published') !!}
				{{ trans('back/blog.published') }}
			</label>
		</div>

		{!! Form::control('text', 0, 'title', $errors, trans('back/blog.title')) !!}

		{!! Form::control('textarea', 0, 'content', $errors, trans('back/blog.content')) !!}

		<div class="form-group">
			<label for="post_type" class="control-label">Announcement or Event ?:</label>
			<select class="form-control" name="post_type" id="post_type">
				<option value="announcement" selected>Announcement</option>
				<option value="event">Event</option>
			</select>

		</div>

		<div class="form-group">
			<label for="main_image_out">Choose and upload an image for this Announcement/Event</label>
			<input type="file" id="main_image_out" name="main_image_out" required="">

			<p class="help-block">Image files only. Max. size is 1m.</p>
		</div>

		<div id="add_slideshow" class="form-group">
			<label for="slideshow" class="control-label">Add to current slideshow ?</label>
			<select class="form-control" name="add_to_slideshow" id="add_to_slideshow">
				<option value="0" selected>No</option>
				<option value="1">Yes</option>
			</select>

		</div>

		<div id="add_slides">


		</div>

		{!! Form::control('text', 0, 'tags', $errors, trans('back/blog.tags'), isset($tags)? implode(',', $tags) : '') !!}



		{!! Form::submit(trans('front/form.send')) !!}
		{!! Form::close() !!}

	</div>

@stop

@section('scripts')
	{!! HTML::script('ckeditor/ckeditor.js') !!}
	<script>
		var config = {
			codeSnippet_theme: 'Monokai',
			language: '{{ config('app.locale') }}',
			height: 100,
			filebrowserBrowseUrl: '{!! url($url) !!}',
			toolbarGroups: [
				{name: 'clipboard', groups: ['clipboard', 'undo']},
				{name: 'editing', groups: ['find', 'selection', 'spellchecker']},
				{name: 'links'},
				{name: 'insert'},
				{name: 'forms'},
				{name: 'tools'},
				{name: 'document', groups: ['mode', 'document', 'doctools']},
				{name: 'others'},
				//'/',
				{name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
				{name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
				{name: 'styles'},
				{name: 'colors'}
			]
		};

		//        CKEDITOR.replace( 'summary', config);

		config['height'] = 400;

		CKEDITOR.replace('content', config);

		$("#title").keyup(function () {
			var str = sansAccent($(this).val());
			str = str.replace(/[^a-zA-Z0-9\s]/g, "");
			str = str.toLowerCase();
			str = str.replace(/\s/g, '-');
			$("#permalien").val(str);
		});

		$(document).ready(function () {
//            $("div#add_slides").html("");
			var slideHTML = "";
			slideHTML += "<div class=\"form-group\"><label for=\"main_image\">Select main image<\/label><input type=\"file\" id=\"main_image\" name=\"main_image\"><p class=\"help-block\">Image files only. Max. size is 1m.<\/p><\/div><div class=\"form-group\"><label for=\"thumbnail_image\">Select thumbnail<\/label><input type=\"file\" id=\"thumbnail_image\" name=\"thumbnail_image\"><p class=\"help-block\">Image files only. Max. size is 1m.<\/p><\/div>";
			$("#add_slideshow").change(function () {
				if ($(this).find("option:selected").val() === "1") {
					$("div#add_slides").html(slideHTML);
				} else {
					$("div#add_slides").html("");
				}
				$('input[type=file]').fileValidator({
					onInvalid: function (type, file) {
						alert("Please select a file of the right size and type");
						$(this).val(null);
					},
					type: 'image',
					maxSize: '1m'
				});
			});
		});

	</script>

@stop