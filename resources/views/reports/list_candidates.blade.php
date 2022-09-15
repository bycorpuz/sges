<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <title>List of Candidates</title>
 <h1><center><img src=".{{session('school')->school_logo}}" width="80" height="80"></center></h1>
@foreach($school as $info)
	 <h3 style="line-height: 1;"><center>{{session('school')->school_id}} - {{session('school')->school_name}}<br>{{ $info->division_name}}<br>{{ $info->region_name}}</center></h3>
	 <h1><center>List of Candidates</center></h1>
@endforeach
 <br><br>
</head>
<body>
<div class='card'>
	@foreach($detail as $datas)
		<div class='card-header'>
			<h3>{{ $datas->position_name }}</h3>
		</div>
			<table class='table'>
			@foreach($data->where('ref_position_id','=',$datas->ref_position_id) as $info)
				<tr>
				@if($info->photo)
					<td><img src =".{{ $info->photo }}" width="75px"></td>
				@else
					<td><center><img src='./template/icon.png' width='75px'></center></td>
				@endif
					<td>{{ $info->first_name.' '.$info->middle_name.' '.$info->last_name }} 	<br>{{ $info->party_name }}
					<br>
					@foreach($grade->where('id','=',$info->ref_grade_level_id) as $infos)
					{{ $infos->grade}}
					@endforeach
					</td>
				</tr>
			@endforeach
			</table><br>	
	@endforeach
</div>
</body>	
</body>
</html>