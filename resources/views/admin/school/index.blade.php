@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    School List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <table class='table'>
                        <thead>
                            <th><center>School Logo</center></th>
                            <th><center>School ID</center></th>
                            <th><center>School Name</center></th>
                            <th><center>Region</center></th>
                            <th><center>Division</center></th>
                            <th><center>Classification</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        <tbody>
                            @if(count($schools) < 1)
                                <tr>
                                    <td colspan='6'><center>Nothing to show</center></td>
                                </tr>
                            @else
                                @foreach($schools as $school)
                                    <tr>
                                        <td><center>
                                            @if($school->school_logo)
                                                <a href='{{ route('login') }}{{$school->school_logo}}' target="_blank"><img src='{{$school->school_logo}}' width='50px'>
                                            @endif
                                        </center></td>
                                        <td><center>{{ $school->school_id }}</center></td>
                                        <td><center>{{ $school->school_name }}</center></td>
                                        <td><center>{{ $school->region->region_name }}</center></td>
                                        <td><center>{{ $school->division->division_name }}</center></td>
                                        <td><center>{{ $school->classification->classification_name }}</center></td>
                                        <td>
                                            <center>
                                                <a href='{{ route('school_list', ['id' => $school->id]) }}' class='btn btn-success'>Edit</a>
                                                <a href='{{ route('school_delete', ['id' => $school->id]) }}' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this School?');">Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $schools->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection