@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-6'>
            <div class='card'>
                <div class='card-header'>
                    Login
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method='POST' action={{ route('login') }} autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <td>Username</td>
                                <td><input type='text' name='username' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type='password' name='password' class='form-control' required></td>
                            </tr>
                            <tr>
                                <td colspan='2'><center><input type='submit' value='Login' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection