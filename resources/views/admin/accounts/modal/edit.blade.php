<div id="edit_user_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('edit_user_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Update Comelec Account
            </div>
            <div class='card-body'>
                <form method='POST' action={{ route('user_comelec_update') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <input type='hidden' name='id' id='id'>
                        <tr>
                            <td>Username</td>
                            <td><input type='text' name='username' id='username' class='form-control' minlength='6' required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type='password' name='password' id='password' class='form-control' minlength='8'></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input type='text' name='last_name' id='last_name' class='form-control' required></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><input type='text' name='first_name' id='first_name' class='form-control' required></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><input type='text' name='middle_name' id='middle_name' class='form-control'></td>
                        </tr>
                        <tr>
                            <td colspan='2'><center><input type='submit' value='Update Account' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>