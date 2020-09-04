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

{!! Form::model($showroom, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.showroom.update', $showroom->id))) !!}

<div class="form-group">
    {!! Form::label('deskripsi', 'Deskripsi*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('deskripsi', old('deskripsi',$showroom->deskripsi), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('nilai', 'Nilai*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('nilai', old('nilai',$showroom->nilai), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('jumlah', 'Jumlah*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('jumlah', old('jumlah',$showroom->jumlah), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('total', 'Total', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('total', old('total',$showroom->total), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tanggal_pembelian', 'Tanggal Pembelian*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('tanggal_pembelian', old('tanggal_pembelian',$showroom->tanggal_pembelian), array('class'=>'form-control datepicker form-control-primary')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.showroom.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-sm btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection