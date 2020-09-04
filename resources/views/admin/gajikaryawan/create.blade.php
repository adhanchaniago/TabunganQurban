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

{!! Form::open(array('route' => config('quickadmin.route').'.gajikaryawan.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::label('kandang', 'Kandang Sapi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::select('kandang', $kandang, old('kandang'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div>
<div class="form-group">
    {!! Form::label('nama', 'Nama Karyawan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::text('nama', old('nama'), array('class'=>'form-control form-control-primary')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('gaji_p_bln', 'Gaji Per Bulan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::number('gaji_p_bln', old('gaji_p_bln'), array('class'=>'form-control form-control-primary', 'id'=>'gaji')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('jumlah_bln', 'Jumlah Bulan', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::number('jumlah_bln', old('jumlah_bln'), array('class'=>'form-control form-control-primary', 'id'=>'bulan')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('total', 'total', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::number('total', old('total'), array('class'=>'form-control form-control-primary', 'id'=>'total', 'readonly')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('tanggal_gaji', 'Tanggal Pengeluaran Gaji*', array('class'=>'control-label')) !!}
    <div class="col-md-12">
        {!! Form::date('tanggal_gaji', old('tanggal_gaji'), array('class'=>'form-control form-control-primary')) !!}

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
    <script>
        $("#gaji,#bulan").keyup(function() {
            var val1 = $('#gaji').val();
            var val2 = $('#bulan').val();

            var kali = Number(val1) * Number(val2);
            if ( val1 != "" && val2 != "" ) {
                $('#total').val(kali);
            }

        })
    </script>

@stop
