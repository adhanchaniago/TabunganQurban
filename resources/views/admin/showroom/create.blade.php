@extends('admin.layouts.master')

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

                {!! Form::open(array('route' => config('quickadmin.route').'.showroom.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::label('kandang', 'Kandang Sapi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::select('kandang', $kandang, old('kandang'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('deskripsi', 'Deskripsi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('deskripsi', old('deskripsi'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('nilai', 'Nilai*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('nilai', old('nilai'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('jumlah', 'Jumlah*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('jumlah', old('jumlah'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('total', 'Total', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('total', old('total'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('tanggal_pembelian', 'Tanggal Pembelian*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('tanggal_pembelian', old('tanggal_pembelian'), array('class'=>'form-control datepicker form-control-primary')) !!}

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
