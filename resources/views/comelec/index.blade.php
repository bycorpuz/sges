@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Welcome
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @endif
                    <center><img src="..{{session('school')->school_logo}}" width="150" height="150"></center><br>
					<center><a class="btn btn-primary" href="{{ route('elected_officers') }}" target="_blank">Candidate List </a><br><br>
					<a class="btn btn-primary" href="{{ route('pdf') }}" target="_blank">Voter List </a><br><br>
					<a class="btn btn-primary" href="{{ route('submitted') }}" target="_blank">List of Students Who Have Submitted Votes</a><br><br>
					<a class="btn btn-primary" href="{{ route('not_submitted') }}" target="_blank">List of Students Who Have Not Submitted Votes</a><br><br>
					<a class="btn btn-primary" href="{{ route('counts') }}" target="_blank">List of Elected Officers </a><br><br>
					<a class="btn btn-primary" href="{{ route('winners') }}" target="_blank">Official Results </a><br></center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection