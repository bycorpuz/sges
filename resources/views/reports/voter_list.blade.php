<h1>LIST OF VOTERS</h1><br>
<table border="1">	
    <tr>
        <th width={{ $widths['full_name'] }}><b>Full Name</b></th>
        <th width={{ $widths['grade'] }}><b>Grade</b></th>
        <th width={{ $widths['section'] }}><b>Section</b></th>
        <th width={{ $widths['signature'] }}><b>Signature</b></th>
        <th width={{ $widths['thumb_mark'] }}><b>Thumb Mark</b></th>
        <th width={{ $widths['username'] }}><b>Username (LRN)</b></th>
        <th width={{ $widths['password'] }}><b>Password</b></th>
    </tr>
    @foreach($user_list as $user)
        <tr>
            <td>{{ $user['full_name'] }}</td>
            <td align="center">{{ $user['grade'] }}</td>
            <td align="center">{{ $user['section'] }}</td>
            <td></td>
            <td height="100"></td>
            <td align="center">{{ $user['username'] }}</td>
            <td align="center">{{ $user['password'] }}</td>
        </tr>
    @endforeach
</table>