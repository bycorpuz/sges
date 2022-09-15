@extends('layouts.app')

@section('headers')
    <script type='text/javascript' src='/js/admin/accounts/index.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Comelec Account List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form action='{{ route('user_comelec_list') }}' method="post" autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <td><input type='text' class='form-control' name='s' placeholder='Username / Last Name / First Name' value='{{ $search }}'></td>
                                <td><input type='submit' class='form-control btn btn-success' value='Search'></td>
                            </tr>
                        </table>
                    </form>
                    <table class='table'>
                        <tr>
                            <td colspan=2>
                                <button onclick="open_modal('add_user_modal');" class="btn btn-success">Add User</button>
                            </td>
                        </tr>
                    </table>
                    <table class='table'>
                        <thead>
                            <th><center>Username</center></th>
                            <th><center>Last Name</center></th>
                            <th><center>First Name</center></th>
                            <th><center>Middle Name</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        <tbody>
                            @if(count($users) < 1)
                                <tr>
                                    <td colspan='4'><center>Nothing to show</center></td>
                                </tr>
                            @else
                                @foreach($users as $user)
                                    <tr>
                                        <td><center>{{ $user->username }}</center></td>
                                        <td><center>{{ $user->profile->last_name }}</center></td>
                                        <td><center>{{ $user->profile->first_name }}</center></td>
                                        <td><center>{{ $user->profile->middle_name }}</center></td>
                                        <td>
                                            <center>
                                                <button onclick="open_modal('edit_user_modal', {{ $user->id }});" class="btn btn-success">Edit</button>
                                                {{-- <a href='{{ route('user_comelec_list', ['id' => $user->id]) }}' class='btn btn-success'>Edit</a> --}}
                                                <a href='{{ route('user_comelec_reset', ['id' => $user->id]) }}' class='btn btn-primary' onclick="return confirm('Are you sure you want to rest the password of this user? The password of this user will be its username.');">Reset Password</a>
                                                <a href='{{ route('user_comelec_delete', ['id' => $user->id]) }}' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $users->links() }}
                    @include('admin.accounts.modal.add')
                    @include('admin.accounts.modal.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection