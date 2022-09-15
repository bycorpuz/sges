<div id="add_party_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('add_party_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Create Party List
            </div>
            <div class='card-body'>
                <form method="post" action={{ route('party_add') }} autocomplete='off'>
                    @csrf
                    <table class='table'>
                        <tr>
                            <th><center>Party Name</center></th>
                            <td><input type='text' class='form-control' name='party_name' required></td>
                        </tr>
                        <tr>
                            <th><center>Party Description</center></th>
                            <td><input type='text' class='form-control' name='description'></td>
                        </tr>
                        <tr>
                            <td colspan=2><center><input type='submit' value='Register Party' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>