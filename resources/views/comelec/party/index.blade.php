@extends('layouts.app')

@section('headers')
    <script type='text/javascript' src='/js/comelec/party/index.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Party List
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form action='{{ route('party_list') }}' method="post" autocomplete='off'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <td><input type='text' class='form-control' name='s' placeholder='Party Name'></td>
                                <td><input type='submit' class='form-control btn btn-success' value='Search'></td>
                            </tr>
                        </table>
                    </form>
                    <table class='table'>
                        <tr>
                            <td colspan=2>
                                <button onclick="open_modal('add_party_modal');" class="btn btn-success">Add Party</button>
                            </td>
                        </tr>
                    </table>
                    <table class='table'>
                        <thead>
                            <th><center>Party Name</center></th>
                            <th><center>Party Description</center></th>
                            <th><center>Action</center></th>
                        </thead>
                        <tbody>
                            @if(count($party_list) < 1)
                                <tr>
                                    <td colspan='3'><center>Nothing to show</center></td>
                                </tr>
                            @else
                                @foreach($party_list as $party)
                                    <tr>
                                        <td><center>{{ $party->party_name }}</center></td>
                                        <td><center>{{ $party->description }}</center></td>
                                        <td>
                                            <center>
                                                <button onclick="open_modal('edit_party_modal', {{ $party->id }});" class="btn btn-success">Edit</button>
                                                {{-- <a href='{{ route('party_list', ['id' => $party->id]) }}' class='btn btn-success'>Edit</a> --}}
                                                <a href='{{ route('party_delete', ['id' => $party->id]) }}' class='btn btn-danger' onclick="return confirm('Are you sure you want to delete this party? It will also delete the candidates under this party.');">Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $party_list->links() }}
                    @include('comelec.party.modal.add')
                    @include('comelec.party.modal.edit')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection