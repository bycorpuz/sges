@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Create Party list
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
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
</div>
@endsection