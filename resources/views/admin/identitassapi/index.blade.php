@extends('admin.layouts.master')
@section('css')
    <!-- Data Table Css -->
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/assets/pages/data-table/css/buttons.dataTables.min.css')}}">


@endsection
@section('content')
<div class="col-sm-12">
        <!-- Nestable card start -->
        <div class="card">
            <div class="card-header">
                <h5>{{ trans('quickadmin::templates.templates-view_index-list') }}</h5>
            </div>
            <div class="card-block">
                <div id="nestable-menu" class="m-b-10">
                    {!! link_to_route(config('quickadmin.route').'.identitassapi.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}
                </div>


                    @if ($identitassapi->count())


                        <div class="table-responsive dt-responsive">

            <table class="table table-striped table-bordered nowrap datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Ear tag Sapi</th>
<th>Jenis Sapi</th>
<th>Bobot Awal</th>
<th>Harga Sapi</th>
<th>Tanggal Masuk</th>
<th>Tanggal Belanja Sapi</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($identitassapi as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ $row->id_sapi }}</td>
<td>{{ $row->jenis_sapi }}</td>
<td>{{ $row->bobot_awal }}</td>
<td>{{ $row->harga }}</td>
<td>{{ $row->tanggal_masuk }}</td>
<td>{{ isset($row->belanjasapi->tanggal_pembelian) ? $row->belanjasapi->tanggal_pembelian : '' }}</td>

                            <td>
                                {!! link_to_route(config('quickadmin.route').'.identitassapi.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-sm btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.identitassapi.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-sm btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.identitassapi.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif
 </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- data-table js -->
    <script src="{{ asset('ablepro/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop
