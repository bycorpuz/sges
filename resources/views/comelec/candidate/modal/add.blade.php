<div id="add_candidate_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('add_candidate_modal')"
                class="w3-button w3-display-topright">&times;</span>
                Add Candidate
            </div>
            <div class='card-body'>
                <form method="post" action={{ route('candidate_add') }} autocomplete='off' enctype="multipart/form-data">
                    @csrf
                    <table class='table'>
                        <tr>
                            <th><center><span class="required">*</span>Last Name</center></th>
                            <td><input type='text' class='form-control' id='add_modal_last_name' name='last_name' required></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>First Name</center></th>
                            <td><input type='text' class='form-control' id='add_modal_first_name' name='first_name' required></td>
                        </tr>
                        <tr>
                            <th><center>Middle Name</center></th>
                            <td><input type='text' class='form-control' id='add_modal_middle_name' name='middle_name'></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Party</center></th>
                            <td>
                                <select class="selectpicker form-control" data-live-search="true" id='add_modal_party' name="party" required>
                                    <option value=''>--- Party List ---</option>
                                    @foreach($party_list as $party)
                                        <option value="{{ $party->id }}">{{ $party->party_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Position</center></th>
                            <td>
                                <select class="selectpicker form-control" data-live-search="true" id='add_modal_position' name="position" required>
                                    <option value=''>--- Position ---</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr id='add_modal_grade'>
                            <th><center><span class="required">*</span>Grade Level</center></th>
                            <td>
                                <select class="selectpicker form-control" data-live-search="true" name="grade" id='add_modal_select_grade'>
                                    <option value=''>--- Grade ---</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                                    @endforeach
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
                            <td colspan=2><center><input type='submit' value='Register Candidate' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
