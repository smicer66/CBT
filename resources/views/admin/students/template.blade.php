<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

{!! HTML::style('/css/questionstemplate.css') !!}
<table>
	<tr>
		<td style="width: 10px;">&nbsp;</td>
		<td colspan="3"><h1>Master Users Upload Template</h1></td>
	</tr>
    <tr class="info header">
        <td style="width: 300px; background-color:#663333"><b>1212Identity Number</b></td>
        <td><b>First Name</b></td>
        <td><b>Last Name</b></td>
        <td><b>Examination Code</b></td>
        <td><b>Department</b></td>
        <td><b>Lev1el</b></td>
    </tr>
	<tbody>
    @for($i = 0; $i <= 10; $i++)
        <tr>
			<td class="text" style="width: 10px;">&nbsp;</td>
			<td class="text">&nbsp;</td>
			<td class="text">&nbsp;  </td>
			<td class="text">&nbsp; </td>
			<td class="text">&nbsp;</td>
		</tr>
    @endfor
    </tbody>
</table>
</html>