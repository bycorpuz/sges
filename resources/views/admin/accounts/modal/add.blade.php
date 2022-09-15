<div id="add_user_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('add_user_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Create Comelec Account
            </div>
            <div class='card-body'>
                <form method='POST' action={{ route('user_comelec_add') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <tr>
                            <td><span class="required">*</span>Username</td>
                            <td><input type='text' name='username' class='form-control' minlength='6' required></td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span>Password</td>
                            <td><input type='password' name='password' class='form-control' minlength='8' required></td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span>Last Name</td>
                            <td><input type='text' name='last_name' class='form-control' required></td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span>First Name</td>
                            <td><input type='text' name='first_name' class='form-control' required></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><input type='text' name='middle_name' class='form-control'></td>
                        </tr>
                        <tr>
                            <td colspan='2'><center><input type='submit' value='Create Account' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>