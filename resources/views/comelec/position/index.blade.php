@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Position List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <table class='table'>
                        <thead>
                            <th><center>Party Name</center></th>
                            <th><center>Party Description</center></th>
                            <th><center>Select Limit</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        <tbody>
                            @if(count($positions) < 1)
                                <tr>
                                    <td colspan='3'><center>Nothing to show</center></td>
                                </tr>
                            @else
                                @foreach($positions as $position)
                                    <tr>
                                        <td><center>{{ ucfirst($position->position_name) }}</center></td>
                                        <td><center>{{ $position->position_description }}</center></td>
                                        <td><center>{{ $position->position_select_limit }}</center></td>
                                        <td>
                                            <center>
                                                <a href='{{ route('position_list', ['id' => $position->id]) }}' class='btn btn-success'>Edit</a>
                                                <a href='{{ route('position_delete', ['id' => $position->id]) }}' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this position? It will also delete the candidates under this position.');">Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $positions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection