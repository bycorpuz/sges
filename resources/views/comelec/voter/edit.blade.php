@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Edit Voter
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method='post' action={{ route('vote_update', ['id' => $voter->id]) }} autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <th><center>LRN</center></th>
                                <td><input type='number' class='form-control' name='lrn' value='{{ $voter->profile->lrn }}' required></td>
                            </tr>
                            <tr>
                                <th><center>Last Name</center></th>
                                <td><input type='text' class='form-control' name='last_name' value='{{ $voter->profile->last_name }}' required></td>
                            </tr>
                            <tr>
                                <th><center>First Name</center></th>
                                <td><input type='text' class='form-control' name='first_name' value='{{ $voter->profile->first_name }}' required></td>
                            </tr>
                            <tr>
                                <th><center>Middle Name</center></th>
                                <td><input type='text' class='form-control' name='middle_name' value='{{ $voter->profile->middle_name }}'></td>
                            </tr>
                            <tr>
                                <th><center>Grade Level</center></th>
                                <td>
                                    <select class='form-control' name='grade' required>
                                        <option value=''>--- Select ---</option>
                                        @foreach($grades as $grade)
                                            <option value='{{ $grade->id }}' @if($grade->id == $voter->profile->grade->id) selected @endif>{{ $grade->grade }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Section</center></th>
                                <td><input type='text' class='form-control' name='section' value='{{ $voter->profile->section }}' required></td>
                            </tr>
                            <tr>
                                <td colspan=2><center><input type='submit' value='Update Voter' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection