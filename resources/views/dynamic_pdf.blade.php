@extends('layouts.app')

@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>

<div class="container">
    <select name="column_select" id="column_select">
        <option value="col1">Population</option>
        <option value="col2">New Born</option>
        <option value="col3">Deaths</option>
    </select>

    <select name="layout_select" id="layout_select">
        <!--Below shows when '1 column' is selected is hidden otherwise-->
        <option value="col1" id="ByGenderOpt">By Gender</option>
        <option value="col1">By Age Range</option>
        <option value="col1">By Education Level</option>
        <option value="col1">By Marital Status</option>

        <!--Below shows when '2 column' is selected is hidden otherwise-->
        <option value="col2">By Year</option>
        <option value="col2">By Month In a Year</option>

        <!--Below shows when '3 column' is selected is hidden otherwise-->
        <option value="col3">By Year</option>
        <option value="col3">By Month In a Year</option>
    </select>

    <div class="row">
            <div class="col-md-7" align="right"><h4>Villagers Details Report</h4></div>
            <div class="col-md-5" align="right">
                <div>
                    <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-danger">Convert into PDF</a>
                </div>
            </div>
    </div>
    <br />
    <div class="table-responsive">
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Ic</th>
                    <th>Gender</th>
                    <th>Race</th>
                </tr>
            </thead>
            <tbody>
                @foreach($villager_data as $villager)
                <tr>
                    <td>{{ $villager->name }}</td>
                    <td>{{ $villager->ic }}</td>
                    <td>{{ $villager->gender }}</td>
                    <td>{{ $villager->race }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var optarray = $("#layout_select").children('option').map(function() {
            return {
                "value": this.value,
                "option": "<option value='" + this.value + "'>" + this.text + "</option>"
            }
        })

        $("#column_select").change(function() {
            $("#layout_select").children('option').remove();
            var addoptarr = [];
            for (i = 0; i < optarray.length; i++) {
                if (optarray[i].value.indexOf($(this).val()) > -1) {
                    addoptarr.push(optarray[i].option);
                }
            }
            $("#layout_select").html(addoptarr.join(''))
        }).change();


    });
</script>

@endsection
