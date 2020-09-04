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

{!! Form::model($belanjasapi, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.belanjasapi.update', $belanjasapi->id))) !!}

<div class="form-group">
    {!! Form::label('jenis_sapi', 'Jenis Sapi*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('jenis_sapi', old('jenis_sapi',$belanjasapi->jenis_sapi), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('bobot_sapi', 'Bobot Sapi', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('bobot_sapi', old('bobot_sapi',$belanjasapi->bobot_sapi), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('harga_p_kg', 'Harga per Kg.', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('harga_p_kg', old('harga_p_kg',$belanjasapi->harga_p_kg), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('harga_p_ekor', 'Harga per Ekor', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('harga_p_ekor', old('harga_p_ekor',$belanjasapi->harga_p_ekor), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('jumlah', 'jumlah QTY', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('jumlah', old('jumlah',$belanjasapi->jumlah), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_harga', 'Total Harga', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('total_harga', old('total_harga',$belanjasapi->total_harga), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tanggal_pembelian', 'Tanggal Pembelian*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('tanggal_pembelian', old('tanggal_pembelian',$belanjasapi->tanggal_pembelian), array('class'=>'form-control datepicker form-control-primary')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.belanjasapi.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-sm btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection