<div id="add_voter_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('add_voter_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Add Voter
            </div>
            <div class='card-body'>
                <form method='post' action={{ route('voter_add') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <tr>
                            <th><center><span class="required">*</span>LRN</center></th>
                            <td><input type='number' class='form-control' name='lrn' required></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Last Name</center></th>
                            <td><input type='text' class='form-control' name='last_name' required></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>First Name</center></th>
                            <td><input type='text' class='form-control' name='first_name' required></td>
                        </tr>
                        <tr>
                            <th><center>Middle Name</center></th>
                            <td><input type='text' class='form-control' name='middle_name'></td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Grade Level</center></th>
                            <td>
                                <select class='form-control' name='grade' required>
                                    <option value=''>--- Grade ---</option>
                                    @foreach($grades as $grade)
                                        <option value='{{ $grade->id }}'>{{ $grade->grade }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><center><span class="required">*</span>Section</center></th>
                            <td><input type='text' class='form-control' name='section' required></td>
                        </tr>
                        <tr>
                            <td colspan=2><center><input type='submit' value='Add Voter' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>