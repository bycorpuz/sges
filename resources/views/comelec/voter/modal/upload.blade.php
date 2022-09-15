<div id="upload_voter_modal" class="w3-modal">
    <div class="w3-modal-content">
        <div class='card'>
            <div class='card-header'>
                <span onclick="close_modal('upload_voter_modal')" 
                class="w3-button w3-display-topright">&times;</span>
                Upload Voters List
            </div>
            <div class='card-body'>
                {{-- Template for the CSV uploading can be downloaded by clicking <a href='{{ route("voter_template") }}'>here</a><br> --}}
                Template for the CSV uploading can be downloaded by clicking <a href='/template/voter_list.csv'>here</a><br>
                <form method="post" action={{ route('voter_upload') }} autocomplete='off' enctype='multipart/form-data'>
                    @csrf
                    <table class='table'>
                        <tr>
                            <th><center>CSV File</center></th>
                            <td>
                                <input type="file" name="file" accept=".csv">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=3><center><input type='submit' value='Upload Voters' class='btn btn-success'></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>