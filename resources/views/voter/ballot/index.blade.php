@extends('layouts.app')

@section('headers')
    <style>
        /* Style the tab */
        .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
        background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
        background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
        }

        img.selected {
            padding:1px;
            border:1px solid #021a40;
            background-color:#FF0000;
        }

        label.selected {
            padding:5px;
            border:1px solid #021a40;
            background-color:#000000;
            color: #FFFFFF;
        }
    </style>
    <script type='text/javascript' src='/js/voter/ballot.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Ballot Form
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <div class="">
                    @foreach($ballot_list as $position => $candidates)
							@for($i = 0; $i < count($candidates); $i = $i + 20)
								@for($j = 0; $j <= 0; $j++)
									@if(($i + $j) < count($candidates))
										<a class='card-header'>{{ $candidates[$i + $j]->position->position_name}}</a>
									@endif
								@endfor
							@endfor
                        <div id='{{ $position }}' class=''>
                            <p>
                                <table class='table'>
                                    @for($i = 0; $i < count($candidates); $i = $i + 3)
                                        <tr>
                                        @for($j = 0; $j <= 2; $j++)
                                            @if(($i + $j) < count($candidates))
                                                <td><center>
                                                    <p><a href='@if($candidates[$i + $j]->photo) {{ $candidates[$i+ $j]->photo }} @else /template/no_image.png @endif' target='_blank'>
                                                        {{-- <img src='{{ $candidates[$i+ $j]->photo }}' alt="Smiley face" width="42" height="42" border="7" border-color='red'> --}}
                                                        <img src='@if($candidates[$i + $j]->photo) {{ $candidates[$i+ $j]->photo }} @else /template/no_image.png @endif' width='75px' id='p_{{ $candidates[$i + $j]->position->id }}_{{ $candidates[$i + $j]->id }}'>
                                                    </a></p></center>
                                                </td>
                                            @endif
                                            @if($i + $j + 1 == count($candidates))
                                                <td><center><img src='/template/no_image.png' width='75px'></center></td>
                                            @endif
                                        @endfor
                                        </tr>
                                        <tr>
                                        @for($j = 0; $j <= 2; $j++)
                                            @if(($i + $j) < count($candidates))
                                                <td><center>
                                                    <label class='' id='c_{{ $candidates[$i + $j]->position->id }}_{{ $candidates[$i + $j]->id }}'>
                                                    <input type='radio' id='r_{{ $candidates[$i + $j]->position->id }}_{{ $candidates[$i + $j]->id }}' value='{{ $candidates[$i + $j]->first_name }} {{ $candidates[$i + $j]->middle_name }} {{ $candidates[$i + $j]->last_name }}' name='{{ $position }}'>
                                                            <font size='4'>
                                                                {{ $candidates[$i + $j]->first_name }} {{ $candidates[$i + $j]->middle_name }} {{ $candidates[$i + $j]->last_name }}
                                                            </font>
                                                    </label>
                                                </center></td>
                                            @endif
                                            @if($i + $j + 1 == count($candidates))
                                                <td><center>
                                                    <label class='' id='c_{{ $candidates[0]->position->id }}_'>
                                                        <input type='radio' id='r_{{ $candidates[0]->position->id }}_' value='' name='{{ $position }}'>
                                                        <font size='4'>
                                                            Abstain
                                                        </font>
                                                    </label>
                                                </center></td>
                                            @endif
                                        @endfor
                                        </tr>
                                        <tr>
                                            @for($j = 0; $j <= 2; $j++)
                                                @if(($i + $j) < count($candidates))
                                                    <td><center>
                                                        <font size='4'>
                                                            {{ $candidates[$i + $j]->party->party_name }}
                                                        </font>
                                                    </center></td>
                                                @endif
                                                
                                                @if($i + $j + 1 == count($candidates))
                                                    <td></td>
                                                @endif
                                            @endfor
                                        </tr>
                                    @endfor
                                    @if(count($candidates) % 3 == 0 && count($candidates) > 0)
                                        <tr>
                                            <td></td>
                                        </tr>
                                    @endif
                                </table>
                            </p>
                        </div>
                    @endforeach
                    </div>
                    <br>
                    <button onclick="openModal();" class="btn btn-success">Submit</button>
                    <div id="vote_summary" class="w3-modal">
                        <div class="w3-modal-content">
                            <div class='card'>
                                <div class='card-header'>
                                    <span onclick="closeModal()" 
                                    class="w3-button w3-display-topright">&times;</span>
                                    Vote Summary
                                </div>
                                <form method='POST' action='{{ route('cast_vote') }}'>
                                    @csrf
                                    <div class='card-body pull-right'>
                                        <table class='table'>
                                            @foreach($positions as $position)
                                                <tr>
                                                    <td>{{ $position->position_name }}</td>
                                                    <td>
                                                        <input type='hidden' id='{{ $position->id }}_value' name='{{ $position->id }}_item'> 
                                                        <label id='{{ $position->id }}_cname'>Abstain</label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <input type='hidden' name='asd_total' value='{{ $position->id }}'> 
                                    </div>

                                    <div class='card-footer'>
                                        Are you ready to submit this vote?
                                        <br><input type="submit" class='btn btn-success' value='Cast Vote'> <a class='btn btn-danger' onclick="closeModal()" >Change Votes</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection