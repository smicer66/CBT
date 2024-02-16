{!! Form::model($question, ['method' => 'PATCH', 'action' => ['QuestionsController@update', $question->id]]) !!}

<div class="modal-body">
	<em>Edit Question</em>
	<div class="form-hoizontal">

			<!-- Title Form Input field -->
			<div class="form-group">
				<div class="col-md-12">

					{!! Form::label('title', 'Title:') !!}
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>
			</div>

			@foreach($question->options as $key => $option)
				<div class="form-group">
					<div class="col-md-12">
						{!! Form::label('option', 'Option ' . (1 + $key), ['class' => 'control-label']) !!}
						{!! Form::text('options[' . $option->id . ']', $option->title, ['class' => 'form-control']) !!}
						<label>
							{!! Form::checkbox('correct_answers[' . $option->id . '][]', $option->id, $option->correct_answer) !!}
							Correct
						</label>
					</div>
				</div>
			@endforeach


	</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" id="dismiss">Cancel</button>
	<button type="submit" class="btn btn-primary" data-slug="">Update</button>
</div>
{!! Form::close() !!}