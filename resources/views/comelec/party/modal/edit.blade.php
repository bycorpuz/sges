<div id="edit_party_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('edit_party_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Update Party List
            </div>
            <div class='card-body'>
                <form method="post" action={{ route('party_update') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <input type='hidden' name='id' id='id'>
                        <tr>
                            <th><center>Party Name</center></th>
                            <td><input type='text' class='form-control' name='party_name' id='party_name' required></td>
                        </tr>
                        <tr>
                            <th><center>Party Description</center></th>
                            <td><input type='text' class='form-control' name='description' id='description'></td>
                        </tr>
                        <tr>
                            <td colspan=2><center><input type='submit' value='Update Party List' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>