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

{!! Form::model($growth, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.growth.update', $growth->id))) !!}

<div class="form-group">
    {!! Form::label('belanjasapi_id', 'Eartag*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::select('belanjasapi_id', $belanjasapi, old('belanjasapi_id',$growth->belanjasapi_id), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('bobot', 'Catatan*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('bobot', old('bobot',$growth->bobot), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('catatan', 'Catatan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::textarea('catatan', old('catatan',$growth->catatan), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tanggal_cek', 'Tanggal Cek*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('tanggal_cek', old('tanggal_cek',$growth->tanggal_cek), array('class'=>'form-control datepicker form-control-primary')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.growth.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-sm btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection