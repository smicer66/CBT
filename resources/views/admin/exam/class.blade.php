<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{--{!! HTML::style('css/questionstemplate.css') !!}--}}
<table>
	<tbody>
		<tr>
			<td style="width: 10px;">&nbsp;</td>
			<td colspan="3"><h1>{{$examination->title}} Class Template</h1></td>
		</tr>
		<tr class="info">
			<td style="width: 10px;">&nbsp;</td>
			<td colspan="1">Institution</td>
			<td>{!! env('APP_NAME') !!}</td>
		</tr>
		<tr class="info">
			<td style="width: 10px;">&nbsp;</td>
			<td colspan="1">Course</td>
			<td>{!! $examination->course->code !!}</td>
		</tr>
		<tr class="info">
			<td style="width: 10px;">&nbsp;</td>
			<td>Department Offering course</td>
			<td>{!! $examination->course->department->name !!}</td>
		</tr>
		<tr>
			<td colspan="3" bgcolor="red">Please do not rename this file</td>
		</tr>
		<tr>
			<td style="width: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 10px;">&nbsp;</td>
		</tr>

		<tr>
			<td><b>s/n</b></td>
			<td><b>Identity Number</b></td>
			<td><b>First Name</b></td>
			<td><b>Last Name</b></td>
			<td><b>Level</b></td>
			<td><b>Authentication Code</b></td>
		</tr>
	</tbody>
</table>
</html>