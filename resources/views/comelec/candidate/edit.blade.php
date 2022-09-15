@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Edit Candidate
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method="post" action={{ route('candidate_update', ['id' => $candidate->id]) }} autocomplete='off' enctype="multipart/form-data">
                        @csrf
                        <table class='table'>
                            <tr>
                                <th><center>Last Name</center></th>
                                <td><input type='text' class='form-control' name='last_name' required value='{{ $candidate->last_name }}'></td>
                            </tr>
                            <tr>
                                <th><center>First Name</center></th>
                                <td><input type='text' class='form-control' name='first_name' required value='{{ $candidate->first_name }}'></td>
                            </tr>
                            <tr>
                                <th><center>Middle Name</center></th>
                                <td><input type='text' class='form-control' name='middle_name' value='{{ $candidate->middle_name }}'></td>
                            </tr>
                            <tr>
                                <th><center>Party</center></th>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="party">
                                        <option>--- Select ---</option>
                                        @foreach($party_list as $party)
                                            <option value="{{ $party->id }}" @if($party->id == $candidate->party->id) selected @endif>{{ $party->party_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Position</center></th>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="position">
                                        <option>--- Select ---</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}" @if($position->id == $candidate->position->id) selected @endif>{{ $position->position_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Position</center></th>
                                <td>
                                    <select class="selectpicker form-control" data-live-search="true" name="grade">
                                        <option>--- Select ---</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" @if($grade->id == $candidate->grade->id) selected @endif>{{ $grade->grade }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th rowspan='2'><center>Image</center></th>
                                <td>
                                    @if($candidate->photo)
                                        <a href='{{$candidate->photo}}' target="_blank"><img src='{{$candidate->photo}}' width='75px'>
                                    @else
                                        No Photo Uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="photo" accept="image/png, image/jpeg">
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2><center><input type='submit' value='Register Candidate' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection