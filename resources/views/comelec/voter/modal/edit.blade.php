<div id="edit_voter_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('edit_voter_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Edit Voter
            </div>
            <div class='card-body'>
                <form method='post' action={{ route('voter_update') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <input type='hidden' name='id' id='id'>
                        <tr>
                            <th><center>LRN</center></th>
                            <td><input type='number' class='form-control' name='lrn' id='lrn' required></td>
                        </tr>
                        <tr>
                            <th><center>Last Name</center></th>
                            <td><input type='text' class='form-control' name='last_name' id='last_name' required></td>
                        </tr>
                        <tr>
                            <th><center>First Name</center></th>
                            <td><input type='text' class='form-control' name='first_name' id='first_name' required></td>
                        </tr>
                        <tr>
                            <th><center>Middle Name</center></th>
                            <td><input type='text' class='form-control' name='middle_name' id='middle_name'></td>
                        </tr>
                        <tr>
                            <th><center>Grade Level</center></th>
                            <td>
                                <select class='form-control' name='grade' id='grade' required>
                                    <option value=''>--- Select ---</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><center>Section</center></th>
                            <td><input type='text' class='form-control' name='section' id='section' required></td>
                        </tr>
                        <tr>
                            <td colspan=2><center><input type='submit' value='Update Voter' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>