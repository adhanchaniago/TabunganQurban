@extends('admin.layouts.master')

@section('content')
<div class="col-sm-12">
        <!-- Nestable card start -->
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h5>
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

{!! Form::model($gajikaryawan, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.gajikaryawan.update', $gajikaryawan->id))) !!}

<div class="form-group">
    {!! Form::label('nama', 'Nama Karyawan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('nama', old('nama',$gajikaryawan->nama), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('gaji_p_bln', 'Gaji Per Bulan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('gaji_p_bln', old('gaji_p_bln',$gajikaryawan->gaji_p_bln), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('jumlah_bln', 'Jumlah Bulan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('jumlah_bln', old('jumlah_bln',$gajikaryawan->jumlah_bln), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total', 'total', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('total', old('total',$gajikaryawan->total), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tanggal_gaji', 'Tanggal Pengeluaran Gaji*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('tanggal_gaji', old('tanggal_gaji',$gajikaryawan->tanggal_gaji), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.gajikaryawan.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-sm btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection