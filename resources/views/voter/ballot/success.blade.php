@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Ballot Info
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <center><font color='green'>Thank you! Your vote has been successfully recorded.</font></center><br><br>
                    <table class='table'>
                        <tr>
                            <th><center>Position</center></th>
                            <th><center>Candidate</center></th>
                        </tr>
                        @foreach($ballot as $position => $candidate)
                            <tr>
                                <td><center>{{ $position }}</center></td>
                                <td><center>@if($candidate){{ $candidate->first_name }} {{ $candidate->middle_name }} {{ $candidate->last_name }} @else Abstain @endif</center></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan='2'>
                                <center><a class='btn btn-success' href='{{ route('logout') }}'>Finish</a></center>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection