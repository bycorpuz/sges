@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Add Position
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method="post" action={{ route('position_add') }} autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <th><center>Position Name</center></th>
                                <td><input type='text' class='form-control' name='position_name' required></td>
                            </tr>
                            <tr>
                                <th><center>Position Description</center></th>
                                <td><input type='text' class='form-control' name='position_description'></td>
                            </tr>
                            <tr>
                                <th><center>Position Selection Limit</center></th>
                                <td><input type='number' min="1" max="255" class='form-control' name='position_select_limit' required></td>
                            </tr>
                            <tr>
                                <td colspan=2><center><input type='submit' value='Register Position' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection