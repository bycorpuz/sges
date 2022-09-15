<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>List of Students Who Have Not Submitted Votes</title>
 <h1>List of Students Who Have Not Submitted Votes</h1>
</head>
<body>
	<table class="table table-bordered" border="1">
		<tr>
			<th width="150">Full Name</th>
			<th width="80">Grade</th>
			<th width="80">Section</th>
			<th width="100">Username(LRN)</th>
		</tr>
		@foreach($data as $data)
				<tr>
					<td>{{ $data->first_name.' '.$data->middle_name.' '.$data->last_name }}</td>
					<td>{{ $data->grade }}</td>
					<td>{{ $data->section }}</td>
					<td>{{ $data->lrn }}</td>
				</tr>
		@endforeach
	</table>
</body>	
</body>
</html>