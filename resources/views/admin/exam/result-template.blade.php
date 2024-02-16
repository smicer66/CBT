<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{--{!! HTML::style('css/questionstemplate.css') !!}--}}
<table>
	<tbody>
	<tr>
		<td class="first">&nbsp;</td>
		<td colspan="3"><h1>{{$examination->title}} result sheet</h1></td>
	</tr>
    <tr>
        <td class="first">&nbsp;</td>
        <td colspan="1">Maximum Score</td>
        <td><h1>{{$examination->maximum_score}} Marks</h1></td>
    </tr>
	<tr class="info">
		<td class="first">&nbsp;</td>
		<td colspan="1">Institution</td>
		<td>{!! env('INSTITUTION_NAME') !!}</td>
	</tr>
	<tr class="info">
		<td class="first">&nbsp;</td>
		<td colspan="1">Course</td>
		<td>{!! $course->title!!}</td>
	</tr>

	<tr>
		<td  class="first" colspan="3" bgcolor="red">&nbsp;</td>
	</tr>
	<tr>
		<td class="first">&nbsp;</td>
	</tr>
	<tr>
		<td class="first">&nbsp;</td>
	</tr>

	<tr class="header">
		<td class="first"><b>s/n</b></td>
		<td><b>Identity Number</b></td>
		<td><b>First Name</b></td>
		<td><b>Last Name</b></td>
		<td><b>Score</b></td>
	</tr>
	<?php $i = 1; ?>

	@foreach($candidates as $candidate)
        <?php
        $usr = DB::table('users')->where('id', '=', $candidate->user_id)->first();
        //dd($usr);
        ?>

		<tr>
			<td class="first">{{$i}}</td>
			<td>{{$usr->identity_no}}</td>
			<td>{{$usr->first_name}}</td>
			<td>{{$usr->last_name}}</td>
			<td>
				@if($candidate->result)
					{{$candidate->result}}
				@else
					No result
				@endif
			</td>
            @if($candidate->user->user_department)
                <td>{{$candidate->user->user_department->name}}</td>
            @else
                <td>&nbsp;</td>
            @endif
{{--           {{ dd($candidate->user->user_department) }}--}}
            @if($candidate->user->user_department)
                @if($candidate->user->user_department->has('faculty'))
                    <td>{{$candidate->user->user_department->faculty->name}}</td>
                @else
                    <td>&nbsp;</td>
                @endif
            @endif
		</tr>

		<?php $i++; ?>
	@endforeach
	</tbody>
</table>
</html>