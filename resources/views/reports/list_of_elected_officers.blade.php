<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>List of Elected Officers</title>
	<h1><center><img src=".{{session('school')->school_logo}}" width="80" height="80"></center></h1>
{{-- @foreach($school as $info) --}}
	<h3 style="line-height: 1;"><center>{{session('school')->school_id}} - {{session('school')->school_name}}<br>{{ session('school')->division->division_name }}<br>{{ session('school')->region->region_name }}</center></h3>
	<h1><center>List of Elected Officers</center></h1>
{{-- @endforeach --}}
 <br><br>
</head>
<body>
<div class='card'>
	@foreach($official_result as $position => $candidate_info)
		<div class='card-header'>
			<h3>{{ $position }}</h3>
		</div>
		<table class='table'>
			<tr>
				@if($candidate_info)
					@if($candidate_info['photo'])
						<td><img src =".{{ $candidate_info['photo'] }}" width="75px"></td>
					@else
					<td><center><img src='./template/icon.png' width='75px'></center></td>
					@endif
					<td>
						{{ ucfirst($candidate_info['first_name']).' '.ucfirst($candidate_info['middle_name']).' '.ucfirst($candidate_info['last_name']) }} 	<br>{{ $candidate_info['party'] }}
						<br>
					</td>
				@else
				{{-- <td><center><img src='./template/icon.png' width='75px'></center></td>
				<td>
					Abstain
				</td> --}}
				<td></td>
				<td></td>
				@endif
			</tr>
		</table><br>
	@endforeach
</div>
</body>	
</body>
</html>