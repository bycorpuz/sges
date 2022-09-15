@extends('layouts.app')

@section('headers')
    <script type='text/javascript' src='/js/admin/index.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
					Guidelines in Using the Election System. </br>
					{{-- Download a copy <a href="https://depedph-my.sharepoint.com/:b:/r/personal/icts_sdd_deped_gov_ph/Documents/Information%20Systems/Election%20System/User%20Guide/Election%20System%20-%20Administrator%20Guide.pdf?csf=1&e=C6XiDo" target="_blank"><font color="#FF00CC"> here. </font></a> --}}
					Download a copy <a href="https://drive.google.com/drive/folders/1DU2VnKLtIFMzA81dFv_YPWVpOk_oyzp9?usp=sharing" target="_blank"><font color="#FF00CC"> here. </font></a>
                </div>
                <div class='card-body'>
					<strong> Updating School Info </strong>
					<ol>
						<li>Click “School Info” and select “Update School Info.”</li>
						<li>Ensure the following information are correct:</li>
						<table>
						  <tr>
							<td>a. School ID</td>
							<td>&nbsp;- This is the 6-digit ID of the school.</td>
						  </tr>
						  <tr>
							<td>b. School Name</td>
							<td>&nbsp;- This is the complete name of the school.</td>
						  </tr>
						  <tr>
							<td>c. School Year</td>
							<td>&nbsp;- Indicate the current school year.</td>
						  </tr>
						  <tr>
							<td>d. Classification</td>
							<td>&nbsp;- Select if Elementary or Secondary school.</td>
						  </tr>
						  <tr>
							<td>e. Region</td>
							<td>&nbsp;- Indicates the region where the school is.</td>
						  </tr>
						  <tr>
							<td>f. Division</td>
							<td>&nbsp;- Indicates the division where the school is.</td>
						  </tr>
						  <tr>
							<td>g. School Logo</td>
							<td>&nbsp;- This is the image of the official school logo.</td>
						  </tr>
						</table>
						<li>Update the school profile by clicking “Update Profile.”</li>
					</ol>
					</br>
					<strong> Managing the COMELEC Account </strong>
					&emsp; </br>
					<h6> Creating a COMELEC account </h6>
					
						<ol>
							<li>To add a COMELEC account, click “Comelec Account” and select “Comelec Account List.”</li>
							<li>In the Create COMELEC account, click “Add User” and ensure that the following information are correct:</li>
							<table>
								<tr>
									<td>a. Username</td>
									<td>&nbsp;- This is the username of the COMELEC account.</td>
								</tr>
								<tr>
									<td>b.	Password</td>
									<td>&nbsp;- The password for the account should be at least 8 characters.</td>
								</tr>
								<tr>
									<td>c.	First Name</td>
									<td>&nbsp;- This is the first name of the COMELEC focal person.</td>
								</tr>
								<tr>
									<td>d.	Last Name</td>
									<td>&nbsp;- This is the last name of the COMELEC focal person.</td>
								</tr>
								<tr>
									<td>e.	Middle Name</td>
									<td>&nbsp;- This is the middle name of the COMELEC focal person.</td>
								</tr>
							</table>
							<li>Save the COMELEC account by clicking “Create Account.”</li>
						</ol>
						
						<h6> Editing a COMELEC account</h6>
						<ol>
							<li>To edit an existing COMELEC account, click “Edit” beside the specific account.</li>
							<li>Update the information and click “Update Account.”</li>					
						</ol>
						
						<h6> Resetting the Password of the COMELEC Account</h6>
						<ol>
							<li>To reset the password of a COMELEC account, click “Reset Password” beside the specific account.</li>
							<li>Upon clicking the reset button, a prompt will appear confirming the resetting of the password. Note that the new password will be the username of the account.</li>					
						</ol>
						
						<h6> Deleting the COMELEC Account</h6>
						<ol>
							<li>To delete a COMELEC account, click “Delete” beside the specific account</li>
							<li>A prompt will appear confirming the deleting of a COMELEC account</li>					
						</ol>
						
						<strong> Resetting the System </strong>
						</br>
						The administrator can reset the entire system which deletes the database of the system, including the party lists, candidates and voters.
						
						<ol>
							<li>To reset the system, click “System” and select “Reset”.</li>
							<li>A prompt will appear if the administrator is sure to reset the entire system.</li>	
							<li>The administrator will have to enter the password and the system will be reset.</li>
						</ol>
				
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    @include('admin.profile.modal.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection