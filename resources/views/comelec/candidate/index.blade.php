@extends('layouts.app')

@section('headers')
    <script type='text/javascript' src='/js/comelec/candidate/index.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Candidate List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form action='{{ route('candidate_list') }}' method="post" autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <td><input type='text' class=' form-control' name='search' placeholder='Last Name / First Name' value={{ $search }}></td>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="search_grade">
                                        <option value=''>--- Grade Level ---</option>
                                        @foreach($grades as $grade_info)
                                            <option value="{{ $grade_info->id }}" @if($grade === $grade_info->id) selected @endif>{{ $grade_info->grade }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="search_position">
                                    <option value=''>--- Position ---</option>
                                        @foreach($positions as $position_info)
                                            <option value="{{ $position_info->id }}" @if($position == $position_info->id) selected @endif>{{ $position_info->position_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="search_party">
                                        <option value=''>--- Party ---</option>
                                        @foreach($party_list as $party_info)
                                            <option value="{{ $party_info->id }}" @if($party == $party_info->id) selected @endif>{{ $party_info->party_name }}</option>
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
                                <button onclick="open_modal('add_candidate_modal');" class="btn btn-success">Add Candidate</button>
                                <a class="btn btn-primary" href="{{ route('elected_officers') }}" target="_blank">Candidate List PDF</a>
                            </td>
                        </tr>
                    </table>
                    <table class='table'>
                        <thead>
                            <th><center>Party</center></th>
                            <th><center>Position</center></th>
                            <th><center>Last Name</center></th>
                            <th><center>First Name</center></th>
                            <th><center>Middle Name</center></th>
                            {{-- <th><center>Grade Level</center></th> --}}
                            <th><center>Photo</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        <tbody>
                            @if(count($candidates) < 1)
                                <tr>
                                    <td colspan='6'><center>Nothing to show</center></td>
                                </tr>
                            @else
                                @foreach($candidates as $candidate)
                                    <tr>
                                        <td><center>{{ $candidate->party_name }}</center></td>
                                        <td><center>
                                            {{-- @if($candidate->position_name == 'Representative') --}}
                                            @if($candidate->ref_grade_level_id)
                                                {{ ucfirst($candidate->grade) }}
                                            @endif
                                            {{ $candidate->position_name }}</center></td>
                                        <td><center>{{ ucfirst($candidate->last_name) }}</center></td>
                                        <td><center>{{ ucfirst($candidate->first_name) }}</center></td>
                                        <td><center>{{ ucfirst($candidate->middle_name) }}</center></td>
                                        {{-- <td><center>@if($candidate->grade){{ ucfirst($candidate->grade) }}@endif</center></td> --}}
                                        <td>
                                            <center>
                                            @if($candidate->photo)
                                                <a href='{{ route('login') }}{{$candidate->photo}}' target="_blank"><img src='{{$candidate->photo}}' width='75px'>
                                            @endif
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <button onclick="open_modal('edit_candidate_modal', {{ $candidate->id }});" class="btn btn-success">Edit</button>
                                                {{-- <a href='{{ route('candidate_list', ['id' => $candidate->id]) }}' class='btn btn-success'>Edit</a> --}}
                                                <a href='{{ route('candidate_delete', ['id' => $candidate->id]) }}' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this candidate?');">Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $candidates->links() }}
                    @include('comelec.candidate.modal.add')
                    @include('comelec.candidate.modal.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
