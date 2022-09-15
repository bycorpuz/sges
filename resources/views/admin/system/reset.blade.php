@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    DELETE information and reset the system.
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @endif
                        <form action='{{ route('system_reset') }}' method='post'>
                            @csrf
                            <table class='table'>
                                <tr>
                                    <td>Please enter your password to continue:</td>
                                    <td><input type='password' class='form-control' name='password'></td>
                                    <td colspan='2'><center><input type='submit' class='btn btn-success' value='Continue'><center></td>
                                </tr>
                            </table>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection