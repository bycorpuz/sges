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
                    Add School
                </div>
                <div class='card-body'>
                    @if(session('error'))
                        <center><font color='red'>{{ session('error') }}</font></center><br>
                    @elseif(session('success'))
                        <center><font color='green'>{{ session('success') }}</font></center><br>
                    @endif
                    <form method='post' action={{ route('school_add') }} autocomplete='off' enctype='multipart/form-data'>
                        @csrf
                        <table class='table'>
                            <tr>
                                <th><center>School ID</center></th>
                                <td><input type='number' class='form-control' name='school_id' required></td>
                            </tr>
                            <tr>
                                <th><center>School Name</center></th>
                                <td><input type='text' class='form-control' name='school_name' required></td>
                            </tr>
                            <tr>
                                <th><center>School Year</center></th>
                                <td>
                                    <input type='number' class='form-control' name='school_year' min="1900" required>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Classification</center></th>
                                <td>
                                    <select class='form-control' name='classification' required>
                                        <option value=''>--- Select ---</option>
                                        @foreach($classification_list as $classification)
                                            <option value='{{ $classification->id }}'>{{ $classification->classification_name }}</option>
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
                                            <option value='{{ $region->id }}'>{{ $region->region_short_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>Division</center></th>
                                <td>
                                    <select class='form-control' name='division' id='division' required>
                                        <option value='' >--- Select ---</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><center>School Logo</center></th>
                                <td>
                                    <input type='file' name='school_logo' accept='image/png, image/jpeg'>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2><center><input type='submit' value='Add School' class='btn btn-success'></center></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection