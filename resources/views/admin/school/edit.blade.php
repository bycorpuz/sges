@extends('layouts.app')

@section('headers')
    <script type='text/javascript' src='/js/admin/school/add.js'></script>
@endsection

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'>
                    Edit School
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method='post' action={{ route('school_list', ['id' => $school->id]) }} autocomplete='off' enctype='multipart/form-data'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <th><center>School ID</center></th>
                                <td><input type='number' class='form-control' name='school_id' value={{ $school->school_id }} required></td>
                            </tr>
                            <tr>
                                <th><center>School Name</center></th>
                                <td><input type='text' class='form-control' name='school_name' value={{ $school->school_name }} required></td>
                            </tr>
                            <tr>
                                <th><center>School Year</center></th>
                                <td>
                                    <input type='number' class='form-control' name='school_year' min="1900" value={{ $school->school_year }} required>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Classification</center></th>
                                <td>
                                    <select class='form-control' name='classification' required>
                                        <option value=''>--- Select ---</option>
                                        @foreach($classification_list as $classification)
                                            <option value='{{ $classification->id }}' @if($classification->id == $school->ref_classification_id) selected @endif>{{ $classification->classification_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Region</center></th>
                                <td>
                                    <select class='form-control' name='region' id='region' required>
                                        <option value=''>--- Select ---</option>
                                        @foreach($region_list as $region)
                                            <option value='{{ $region->id }}' @if($region->id == $school->ref_region_id) selected @endif>{{ $region->region_short_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Division</center></th>
                                <td>
                                    <select class='form-control' name='division' id='division' required>
                                        <option value='' >--- Select ---</option>
                                        @foreach($division_list as $division)
                                            <option value='{{ $division->id }}' @if($division->id == $school->ref_division_id) selected @endif>{{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th rowspan='2'><center>School Logo</center></th>
                                <td>
                                    @if($school->school_logo)
                                        <a href='{{ route('login') }}{{$school->school_logo}}' target="_blank"><img src='{{$school->school_logo}}' width='75px'>
                                    @else
                                        No Photo Uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="school_logo" accept="image/png, image/jpeg">
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2><center><input type='submit' value='Edit School' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection