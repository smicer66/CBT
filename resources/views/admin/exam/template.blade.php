<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{--{!! HTML::style('css/questionstemplate.css') !!}--}}
<table>
	<tr>
		<td style="width: 10px;">&nbsp;</td>
		<td colspan="3"><h1>{{$examination->title}} Template</h1></td>
	</tr>
	<tr class="info">
		<td style="width: 10px;">&nbsp;</td>
		<td colspan="1" style="font-weight: bold">Institution</td>
		<td>{!! env('INSTITUTION_NAME') !!}</td>
	</tr>
	<tr class="info">
		<td style="width: 10px;">&nbsp;</td>
		<td colspan="1" style="font-weight: bold">Course</td>
		<td>{!! $examination->course->title !!}</td>
	</tr>
	
	<tr class="info">
		<td style="width: 10px;">&nbsp;</td>
		<td  style="font-weight: bold">Class Taking Exam</td>
		<td>{!! $examination->class_->name." ".$examination->class_arm->arm_name." " !!}</td>
	</tr>

	<tr>
		<td>&nbsp;</td>
		<td style="width: 50px; font-weight: bold">Display questions randomly?</td>
		<td style="width: 40px">No</td>
		<td style="width: 40px; color: #ff0084;"><b>Help info: </b>Change cell C5 to 'Yes' to display questions randomly</td>
	</tr>
	<tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="color:  #ff0084;"><b>Help info: </b>Change cells under the 'Correct' column to Yes if the answer in the row is correct</td>
	</tr>
	<tr>
		<td style="width: 10px;">&nbsp;</td>
	</tr>
	<tr class="info header">
		<td style="width: 10px;"><b>S/N</b></td>
		<td><b>Questions</b></td>
        <td><b>Score</b></td>
		<td><b>Options</b></td>
		<td><b>Correct?</b></td>
	</tr>

	<tbody>
	<?php
	$i1 = 0;
	$i2 = 1;
	?>
	@for($i = 0; $i < 11; $i++)
	<?php
	$arr = ['Option 1', 'Option 2', 'Option 3', 'Option 4', 'Option 5' ];
	if($i==5)
	{
		$i1=0;
	}
	?>
		<tr>
			@if($i==0 || $i==6)
			<td class="text" style="width: 10px;">{{($i2++)}}</td>
			<td class="text">Type Your Question Here</td>
            <td class="text">5</td>
			@else
			<td class="text">&nbsp;</td>
			<td class="text">&nbsp;</td>
			<td class="text">&nbsp;</td>
			@endif
			@if($i!=5)
			<td class="text">{{$arr[$i1++]}}</td>
			<td class="text">No</td>
			@else
			<td class="text">&nbsp;</td>
			<td class="text">&nbsp;</td>
			@endif
		</tr>
	@endfor
	</tbody>
</table>
</html>