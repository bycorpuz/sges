@extends('layouts.app')

@section('headers')
    <script type='text/javascript' src='/js/comelec/voter/index.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Voter List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{!! session('error') !!}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{!! session('success') !!}</font></center><br>
                    @endif
                    <form action='{{ route('voter_list') }}' method="post" autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <td><input type='text' class='form-control' name='search' placeholder='LRN / Last Name / First Name / Middle Name' value={{ $search }}></td>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="search_grade">
                                        <option value=''>--- Grade Level ---</option>
                                        @foreach($grades as $grade_info)
                                            <option value="{{ $grade_info->id }}" @if($search_grade == $grade_info->id) selected @endif>{{ $grade_info->grade }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type='submit' class='form-control btn btn-success' value='Search'></td>
                            </tr>
                        </table>
                    </form>
                    <table class='table'>
                        <tr>
                            <td colspan=2>
                                <button onclick="open_modal('add_voter_modal');" class="btn btn-success">Add Voter</button>
                                &nbsp;&nbsp;
                                <button onclick="open_modal('upload_voter_modal');" class="btn btn-success">Upload Voters</button>
                                <a class="btn btn-primary" href="{{ route('pdf') }}" target="_blank">Voter List PDF</a>
                                <a class="btn btn-secondary" href="{{ route('submitted') }}" target="_blank">List of Students Who Have Submitted Votes</a>
                                <a class="btn btn-warning" href="{{ route('not_submitted') }}" target="_blank">List of Students Who Have Not Submitted Votes</a>
                            </td>
                        </tr>
                    </table>
                    <table class='table'>
                        <thead>
                            <th><center>LRN</center></th>
                            <th><center>Last Name</center></th>
                            <th><center>First Name</center></th>
                            <th><center>Middle Name</center></th>
                            <th><center>Grade Level</center></th>
                            <th><center>Section</center></th>
                            <th><center>Password</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        <tbody>
                            @if(count($voters) < 1)
                                <tr>
                                    <td colspan='6'><center>Nothing to show</center></td>
                                </tr>
                            @else
                                @foreach($voters as $voter)
                                    <tr>
                                        <td><center>{{ $voter->lrn }}</center></td>
                                        <td><center>{{ ucfirst($voter->last_name) }}</center></td>
                                        <td><center>{{ ucfirst($voter->first_name) }}</center></td>
                                        <td><center>{{ ucfirst($voter->middle_name) }}</center></td>
                                        <td><center>{{ ucfirst($voter->grade) }}</center></td>
                                        <td><center>{{ ucfirst($voter->section) }}</center></td>
                                        <td><center>{{ $user_repo->generateVoterPasswordByPasswordAndSalt($voter->password, $voter->password_salt) }}</center></td>
                                        <td>
                                            <center>
                                                <button onclick="open_modal('edit_voter_modal', {{ $voter->id }});" class="btn btn-success">Edit</button>
                                                {{-- <a href='{{ route('voter_list', ['id' => $voter->id]) }}' class='btn btn-success'>Edit</a> --}}
                                                <a href='{{ route('voter_delete', ['id' => $voter->id]) }}' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this voter?');">Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $voters->links() }}
                    @include('comelec.voter.modal.add')
                    @include('comelec.voter.modal.edit')
                    @include('comelec.voter.modal.upload')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection