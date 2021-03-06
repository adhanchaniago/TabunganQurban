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

                {!! Form::open(array('route' => config('quickadmin.route').'.belanjasapi.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

                <div class="form-group">
                    {!! Form::label('kandang', 'Kandang Sapi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::select('kandang', $kandang, old('kandang'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('jenis_sapi', 'Jenis Sapi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::select('jenis_sapi', $jenissapi, old('jenis_sapi'), array('class'=>'form-control form-control-primary')) !!}

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Eartag', 'Eartag*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('eartag', old('eartag'), array('class'=>'form-control form-control-primary')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('bobot_sapi', 'Bobot Sapi', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::number('bobot_sapi', old('bobot_sapi'), array('class'=>'form-control form-control-primary', 'id'=>'input1')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('harga_p_kg', 'Harga per Kg.', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::number('harga_p_kg', old('harga_p_kg'), array('class'=>'form-control form-control-primary', 'id'=>'input2')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('harga_p_ekor', 'Harga Sapi', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::number('harga_p_ekor', old('harga_p_ekor'), array('class'=>'form-control form-control-primary', 'id'=>'input3')) !!}

                    </div>
                </div>

                <div class="form-group">
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
        $("#input1,#input2,#input4").keyup(function() {
            var val1 = $('#input1').val();
            var val2 = $('#input2').val();
            var val3 = $('#input3').val();
            var val4 = $('#input4').val();
            var kali = Number(val1) * Number(val2);
            var kali2 = Number(val3) * Number(val4);
            if ( val1 != "" && val2 != "" ) {
                $('#input3').val(kali);
            }
            if ( val3 != "" && val4 != "" ) {
                $('#total').val(kali2);
            }
        })
    </script>

@stop
