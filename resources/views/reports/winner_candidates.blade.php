<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Official Results</title>
 <h1><center><img src=".{{session('school')->school_logo}}" width="80" height="80"></center></h1>
{{-- @foreach($school as $info) --}}
	<h3 style="line-height: 1;"><center>{{session('school')->school_id}} - {{session('school')->school_name}}<br>{{ session('school')->division->division_name }}<br>{{ session('school')->region->region_name }}</center></h3>
	{{-- <h3 style="line-height: 1;"><center>{{session('school')->school_id}} - {{session('school')->school_name}}<br>{{ $info->division_name}}<br>{{ $info->region_name}}</center></h3> --}}
	<h1><center>Official Results </center></h1>
{{-- @endforeach --}}
 <br><br>
</head>
<body>

@foreach($data as $position => $candidates)
	<div class='card-header'>
		<h3>{{ $position }}</h3>
	</div>
	<table>
		@foreach($candidates as $candidate_id => $data)
			<tr>
				@if($data['photo'])
					<td><img src =".{{ $data['photo'] }}" width="75px"></td>
				@else
					<td><center><img src='./template/icon.png' width='75px'></center></td>
				@endif
				<td>{{ ucfirst($data['first_name']).' '.ucfirst($data['middle_name']).' '.ucfirst($data['last_name']) }}<br>{{ $data['party'] }}
					<br>Votes: {{ $data['vote_count'] }}</td>
			</tr>
			<br>
			<tr>
				<td></td>
			</tr>
		@endforeach
	</table>
@endforeach	
</body>	
</body>
</html>