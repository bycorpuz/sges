@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Upload Voter List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
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
</div>
@endsection