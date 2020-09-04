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

                {!! Form::open(array('route' => config('quickadmin.route').'.belanjapakan.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::label('kandang', 'Kandang Sapi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::select('kandang', $kandang, old('kandang'), array('class'=>'form-control form-control-primary', 'required')) !!}

                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('jenis_pakan', 'Jenis Pakan*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('jenis_pakan', old('jenis_pakan'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('jumlah', 'Jumlah Pakan / Kg.', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::number('jumlah', old('jumlah'), array('class'=>'form-control form-control-primary' , 'id'=>'jumlah_pakan')) !!}

                    </div>
                </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('harga', 'Harga Pakan / Kg.', array('class'=>'control-label')) !!}
                                <div class="col-md-12">
                            {!! Form::number('harga', old('harga'), array('class'=>'form-control form-control-primary', 'id'=>'harga_pakan')) !!}
                                </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('harga', 'Harga Pakan / Kg.', array('class'=>'control-label')) !!}
                                <div class="col-md-12">
                                    {!! Form::number('total', old('toal'), array('class'=>'form-control form-control-primary', 'id'=>'total','readonly')) !!}
                                </div>
                            </div>
                        </div>


                </div>

                <div class="form-group">
                    {!! Form::label('total_harga', 'Total Harga', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::number('total_harga', old('total_harga'), array('class'=>'form-control form-control-primary', 'id'=>'total_harga', 'readonly    ')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('tanggal_pembelian', 'Tanggal Pembelian*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::date('tanggal_pembelian', old('tanggal_pembelian'), array('class'=>'form-control datepicker form-control-primary')) !!}

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
        $("#jumlah_pakan,#harga_pakan,#bulan").keyup(function() {
            var val1 = $('#jumlah_pakan').val();
            var val2 = $('#harga_pakan').val();
            var kali = Number(val1) * Number(val2);
            var kali2 = Number(val1) * Number(val2);
            if ( val1 != "" && val2 != "") {
                $('#total_harga').val(kali);
            }
            if ( val1 != "" && val2 != "" ) {
                $('#total').val(kali2);
            }
        })
    </script>

@stop
