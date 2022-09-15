<div id="edit_candidate_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('edit_candidate_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Edit Candidate
            </div>
            <div class='card-body'>
                <form method="post" action={{ route('candidate_update') }} autocomplete='off' enctype="multipart/form-data">
                    @csrf
                    <table class='table'>
                        <input type='hidden' name='id' id='id'>
                        <tr>
                            <th><center><span class="required">*</span>Last Name</center></th>
                            <td><input type='text' class='form-control' name='last_name' id='edit_modal_last_name' required></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>First Name</center></th>
                            <td><input type='text' class='form-control' name='first_name' id='edit_modal_first_name' required></td>
                        </tr>
                        <tr>
                            <th><center>Middle Name</center></th>
                            <td><input type='text' class='form-control' name='middle_name' id='edit_modal_middle_name'></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Party</center></th>
                            <td>
                                <select class="selectpicker form-control" data-live-search="true" name="party" id='edit_modal_party' required>
                                    <option>--- Select ---</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Position</center></th>
                            <td>
                                <select class="selectpicker form-control" data-live-search="true" name="position" id='edit_modal_position' required>
                                    <option>--- Select ---</option>
                                </select>
                            </td>
                        </tr>
                        <tr id='edit_modal_grade'>
                            <th><center><span class="required">*</span>Grade Level</center></th>
                            <td>
                                <select class="selectpicker form-control" data-live-search="true" name="grade" id='edit_modal_select_grade'>
                                    <option>--- Select ---</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><center>Image</center></th>
                            <td>
                                <input type="file" name="photo" accept="image/png, image/jpeg">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2><center><input type='submit' value='Edit Candidate' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>