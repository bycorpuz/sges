<div id="update_admin_profile" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('update_admin_profile')" 
                class="w3-button w3-display-topright">&times;</span>
                Update Admin Profile
            </div>
            <div class='card-body'>
                <form method='POST' action={{ route('update_profile') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <tr>
                            <td>Username</td>
                            <td><input type='text' name='username' class='form-control' minlength='6' value='{{ session('user')->username }}' required></td>
                        </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type='password' name='password' class='form-control' minlength='8'></td>
                            </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input type='text' name='last_name' class='form-control' value='{{ session('profile')->last_name }}' required></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><input type='text' name='first_name' class='form-control' value='{{ session('profile')->first_name }}' required></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><input type='text' name='middle_name' class='form-control' value='{{ session('profile')->middle_name }}'></td>
                        </tr>
                        <tr>
                            <td colspan='2'><center><input type='submit' value='Update Profile' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>