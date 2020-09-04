@extends('admin.layouts.master')
@section('css')

    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/assets/pages/data-table/css/buttons.dataTables.min.css')}}">

@endsection
@section('content')
    <div class="col-sm-12">
        <!-- Nestable card start -->
        <div class="card">
            @if ($errors->any())
                <div class="modal " id="myModal">
                    <div class="modal-dialog modal-md md-effect-5">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Pesanan Selesai</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <a href="{{ route('setruk',$errors->first())}}" target="_blank"><button type="button" id="" onclick="close_modal()" class="btn btn-success">Cetak Struk</button></a>
                            </div>
                        </div>
                    </div>
                </div>


            @endif
            <div class="card-header">
                <h5>{{ trans('quickadmin::templates.templates-view_index-list') }}</h5>
            </div>
            <div class="card-block">
                <div id="nestable-menu" class="m-b-10">
                    {!! link_to_route(config('quickadmin.route').'.jualsapi.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}
                </div>


                @if ($jualsapi->count())


                    <div class="table-responsive dt-responsive">

                        <table class="table table-striped table-bordered nowrap datatable" id="datatable">
                            <thead>
                            <tr>
                                <th>
                                    {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                                </th>
                                <th>ID Pembelian</th>
                                <th>Nama Pembeli</th>
                                <th>No Telepon</th>
                                <th>Total Belanja</th>
                                <th>Bayar</th>
                                <th>Keterangan</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($jualsapi as $row)
                                <tr>
                                    <td>
                                        {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                                    </td>
                                    <td><a href="{{ url('/admin/jualsapi/').'/'.$row->id_chart.'/edit' }}">{{ $row->id_chart }}</a></td>
                                    <td>{{ $row->nama_pembeli }}</td>
                                    <td><a href="https://api.whatsapp.com/send?phone={{ $row->no_tlpn }}&text=" target="_blank"></a>{{ $row->no_tlpn }}</td>
                                    <td>{{ $row->total_belanja }}</td>
                                    <td>{{ $row->bayar }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td> @if($row->status == 1)
                                            <label class="label label-danger">Belum Selesai</label>

                                        @else
                                            @if($row->bayar < $row->total_belanja  )
                                                <label class="label label-warning">Uang Muka (Belum Lunas)</label>
                                            @elseif($row->bayar >= $row->total_belanja)
                                                <label class="label label-success">Lunas</label>
                                            @endif


                                        @endif

                                    </td>

                                    <td>
                                        {!! link_to_route(config('quickadmin.route').'.jualsapi.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id_chart), array('class' => 'btn btn-sm btn-info')) !!}
                                        {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array(config('quickadmin.route').'.jualsapi.destroy', $row->id))) !!}
                                        {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                        {!! Form::close() !!}
                                        <a href="{{ route('setruk',$row->id_chart) }}" target="_blank"><button class="btn btn-sm btn-secondary">Cetak Struk</button></a>
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
                        {!! Form::open(['route' => config('quickadmin.route').'.jualsapi.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
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
    <script src="{{ asset('ablepro/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('ablepro/assets/pages/data-table/js/jszip.min.js')}}"></script>
    <script src="{{ asset('ablepro/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
    <script src="{{ asset('ablepro/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('ablepro/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('ablepro/bower_components/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

        } );
        $(document).ready(function() {
            $("#myModal").modal("show");

        } );
        function close_modal() {
            $("#myModal").modal("hide");

        }
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
