@extends('admin.layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/ablepro/bower_components/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">

@endsection

@section('content')
 <div class="col-sm-12">
        <!-- Nestable card start -->
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h5>
            </div>
            <div class="card-block">
<div class="row">
    <div class="col-md-12 col-sm-offset-2">

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => config('quickadmin.route').'.anggaranpakan.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('Periode Bulan', 'Periode Bulan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('tanggal_awal', old('tanggal_awal'), array('class'=>'form-control datepicker form-control-primary','id'=>'tanggal','readonly')) !!}

    </div>
</div>


                <div class="form-group">
    {!! Form::label('jumlah_anggaran', 'Jumlah Anggaran', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::number('jumlah_anggaran', old('jumlah_anggaran'), array('class'=>'form-control form-control-primary')) !!}

    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-sm btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('/ablepro/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script>

    var startDate = new Date();


    $('#tanggal').datepicker({
        autoclose: true,
        minViewMode: 1,
        format: 'yyyy-mm'
    }).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to').datepicker('setStartDate', startDate);
    });





</script>



    @endsection
