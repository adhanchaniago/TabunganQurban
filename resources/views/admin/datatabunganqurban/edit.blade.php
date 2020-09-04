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

{!! Form::model($datatabunganqurban, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.datatabunganqurban.update', $datatabunganqurban->id))) !!}

<div class="form-group">
    {!! Form::label('nama', 'nama*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('nama', old('nama',$datatabunganqurban->nama), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tlpn', 'tlpn*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('tlpn', old('tlpn',$datatabunganqurban->tlpn), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('alamat', 'alamat*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('alamat', old('alamat',$datatabunganqurban->alamat), array('class'=>'form-control form-control-primary')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.datatabunganqurban.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-sm btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}
</div>
</div>
</div>
@endsection