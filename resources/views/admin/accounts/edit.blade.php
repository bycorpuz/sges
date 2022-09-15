@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Update Comelec Account
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method='POST' action={{ route('user_comelec_update', ['id' => $user->id]) }} autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <td>Username</td>
                                <td><input type='text' name='username' class='form-control' value={{ $user->username }} minlength='6' required></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type='password' name='password' class='form-control' minlength='8'></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td><input type='text' name='last_name' class='form-control' value={{ $user->profile->last_name }} required></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td><input type='text' name='first_name' class='form-control' value={{ $user->profile->first_name }} required></td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td><input type='text' name='middle_name' class='form-control' value={{ $user->profile->middle_name }}></td>
                            </tr>
                            <tr>
                                <td colspan='2'><center><input type='submit' value='Create' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection