<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>List of Voters</title>
 <h1>LIST OF VOTERS</h1>
</head>
<body>
	<table class="table table-bordered" border="1">	
		<tr>
			<th width="150">Full Name</th>
			<th width="80">Grade</th>
			<th width="80">Section</th>
			<th width="100">Signature</th>
			<th width="100">Thumb Mark</th>
			<th width="100">Username(LRN)</th>
			<th width="150">Password</th>
		</tr>
		@foreach($data as $datas)
			<tr>
				<td>{{ $datas->first_name.' '.$datas->middle_name.' '.$datas->last_name }}</td>
				<td  align="center">{{ $datas->grade }}</td>
				<td  align="center">{{ $datas->section }}</td>
				<td></td>
				<td height="100"></td>
				<td  align="center">{{ $datas->lrn }}</td>
				<td  align="center">
				@php
					$password = $datas->password;
					$password_salt = $datas->password_salt;
					$positions = "";
					$voter_password = "";
					$used = array();

					foreach(str_split($password_salt) as $salt) {
						$ascii = ord($salt);
						if(strlen($ascii) == 1) {
							$sum = $ascii;
						}
						else {
							while(strlen($ascii) > 1) {
								$sum = 0;
								foreach(str_split($ascii) as $ascii_char) {
									$sum += $ascii_char;
								}
								$ascii = $sum;
							}
						}

						while(in_array($sum, $used)) {
							$sum += 1;
							if($sum > 9) {
								$sum = 0;
							}
						}
						array_push($used, $sum);
						$positions .= $sum;
					}

					foreach(str_split($positions) as $position) {
						$voter_password .= substr($password, $position, 1);
					}

					echo $voter_password;
				@endphp
				</td>
			</tr>
		@endforeach
	</table>
</body>	
</body>
</html>