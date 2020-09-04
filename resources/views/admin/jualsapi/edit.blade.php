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

{!! Form::model($jualsapi, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.jualsapi.update', $jualsapi->id))) !!}

<div class="form-group">
    {!! Form::label('belanjasapi_id', 'Eartag*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::select('belanjasapi_id', $belanjasapi, old('belanjasapi_id',$jualsapi->belanjasapi_id), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('harga_p_kg', 'Harga Per Kg*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('harga_p_kg', old('harga_p_kg',$jualsapi->harga_p_kg), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total_harga', 'Total Harga', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('total_harga', old('total_harga',$jualsapi->total_harga), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('nama_pembeli', 'Nama Pembeli*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('nama_pembeli', old('nama_pembeli',$jualsapi->nama_pembeli), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('no_tlpn', 'No Telepon*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('no_tlpn', old('no_tlpn',$jualsapi->no_tlpn), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('status_bayar', 'Status Bayar*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('status_bayar', old('status_bayar',$jualsapi->status_bayar), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('bayar', 'bayar*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('bayar', old('bayar',$jualsapi->bayar), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('keterangan', 'Keterangan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::textarea('keterangan', old('keterangan',$jualsapi->keterangan), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.jualsapi.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-sm btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection