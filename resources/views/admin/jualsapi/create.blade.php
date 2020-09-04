@extends('admin.layouts.master')
@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('/ablepro/bower_components/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/ablepro/bower_components/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/multiselect/css/multi-select.css')}}" />


@endsection

@section('content')
    <div class="col-sm-12">
        <!-- Nestable card start -->
        <div class="card">
            <div class="card-header">
                <h5>Tambah Penjualan Baru</h5>
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
                <div class="form-group">
                    {!! Form::label('carisapi', 'Cari Sapi*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        <button onclick="cari_sapi()" class="btn btn-info "> Cari Sapi </button>

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('belanjasapi_id', 'Daftar Pembelian*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        <p id="datachart">


                        </p>
                    </div>
                </div>

                {!! Form::open(array('route' => config('quickadmin.route').'.jualsapi.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
                @if( empty($id_chart))
                    <input name="id_chart" id="id_chart" value="" type="text" hidden>
                    @else
                    <input name="id_chart" id="id_chart" value="{{$id_chart}}" type="text" hidden>

                @endif
                <div class="form-group">
                    {!! Form::label('total_berat', 'Total Berat', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('total_berat', old('total_berat'), array('class'=>'form-control form-control-primary','id'=>'berat_total','readonly')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('total_harga', 'Total Harga', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('total_harga', old('total_harga'), array('class'=>'form-control form-control-primary','id'=>'harga_total','readonly')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('nama_pembeli', 'Nama Pembeli*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('nama_pembeli', old('nama_pembeli'), array('class'=>'form-control form-control-primary','id'=>'nama_pembeli')) !!}

                    </div>
                </div><div class="form-group">
                    {!! Form::label('no_tlpn', 'No Telepon*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('no_tlpn', old('no_tlpn'), array('class'=>'form-control form-control-primary','no_tlpn')) !!}

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Alamat', 'Alamat*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('alamat', old('alamat'), array('class'=>'form-control form-control-primary','id'=>'alamat')) !!}

                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('status_bayar', 'Status Bayar*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        <select class="form-control form-control-primary" name="status_bayar" >
                            <option value="BSM">BSM</option>
                            <option value="BCA">BCA</option>
                            <option value="CASH">CASH</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('bayar', 'bayar*', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::text('bayar', old('bayar'), array('class'=>'form-control form-control-primary', 'id'=>'bayar')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('keterangan', 'Keterangan', array('class'=>'control-label')) !!}
                    <div class="col-md-12">
                        {!! Form::textarea('keterangan', old('keterangan'), array('class'=>'form-control', 'id'=>'keterangan')) !!}

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-offset-2">
                        {!! Form::submit( "Simpan" , array('class' => 'btn btn-sm btn-primary')) !!}
                    </div>
                </div>

                {!! Form::close() !!}
                <div class="modal " id="myModal">
                    <div class="modal-dialog modal-lg md-effect-5">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Data</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body" id="modal_body">

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal " id="myModal2">
                    <div class="modal-dialog modal-md md-effect-5">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Hitung Sapi</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body" id="modal_body2">

                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Close</button>
                                <button type="button" id="add_to_chart" onclick="add_chart()" class="btn btn-success btn-mini" data-dismiss="modal" disabled>Simpan</button>

                            </div>
                        </div>
                    </div>
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
    <!-- Multiselect js -->
    <script type="text/javascript" src="{{ asset('ablepro/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}">
    </script>
    <script type="text/javascript" src="{{ asset('ablepro/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
    <script type="text/javascript" src="{{ asset('ablepro/assets/js/jquery.quicksearch.js')}}"></script>
    <script type="text/javascript" src="{{ asset('ablepro/assets/pages/advance-elements/select2-custom.js')}}"></script>
    <script>
        $( document ).ready(function () {
            var id_chart = $('#id_chart').val();
            insertlisttable();
            if(id_chart != ""){
                update_chart(id_chart);
                data_all(id_chart);

            }
        });

        var uri = "{{ url('/api/') }}";
        var url = "{{ url('/api/') }}";
        function data_all(id_chart) {
            // var id_chart = $('#id_chart').val();
            var nama_pembeli = $('#nama_pembeli');
            var no_tlpn = $('#no_tlpn');
            var alamat = $('#alamat');
            var keterangan = $('#keterangan');
            var bayar = $('#bayar');

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url+"/jual_sapi/list_chart/"+id_chart+"/data",
                "method": "GET",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "e6e1a2a7-fbc2-400f-9f65-9732b1489c48"
                }
            }

            $.ajax(settings).done(function (response) {
                console.log(response);
                nama_pembeli.val(response[0].nama_pembeli);
                no_tlpn.val(response[0].no_tlpn);
                alamat.val(response[0].alamat);
                keterangan.val(response[0].keterangan);
                bayar.val(response[0].bayar);

            });
        }


        var belanjasapi = $("#belanjasapi");

        belanjasapi.on('change', function () {

            var arr = belanjasapi.val();

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": uri+"/get_berat/"+arr,
                "method": "GET",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "b73dfd20-67db-4747-88b3-f9862ddf58d9"
                }
            }

            $.ajax(settings).done(function (response) {
                console.log(response[0].bobot_sapi);
                response.forEach(function (a) {
                    console.log(a.bobot_sapi);

                })
                $('#total_berat').val(response[0].bobot_sapi);
            });
            hitung();
        });
        function cari_sapi() {
            html = " <div class=\"table-responsive dt-responsive\">\n" +
                "                                <table id=\"datasapi\" class=\"table table-striped table-bordered nowrap\">\n" +
                "                                    <thead>\n" +
                "                                    <tr>\n" +
                "                                        <th>Eartag</th>\n" +
                "                                        <th>Jenis</th>\n" +
                "                                        <th>Kandang</th>\n" +
                "                                        <th>Bobot *Kg</th>\n" +
                "                                        <th>harga</th>\n" +
                "                                        <th>Pembelian</th>\n" +
                "                                        <th>option</th>\n" +
                "                                    </tr>\n" +
                "                                    </thead>\n" +
                "                                </table>\n" +
                "                            </div>";
            document.getElementById("modal_body").innerHTML = html;

            var generatetable = $('#datasapi').DataTable({

                "ajax": url+"/belanja_sapi",
                "columns": [
                    {"data": "eartag"},
                    {"data": "jenissapi.jenis_sapi"},
                    {"data": "kandang.nama"},
                    {"data": "bobot_sapi"},
                    {"data": "id"},
                    {"data": "tanggal_pembelian"},
                    {"targets": -1,
                        "data": null,
                        "defaultContent": "<button class='btn btn-info btn-mini'>Tambah Keranjang</button>"
                    }
                ],

            });

            $('#datasapi').on('click', 'button', function() {
                closeModal();

                var data = generatetable.row($(this).parents('tr')).data();
                var text = "<div class=\"form-group\">\n" +
                    "<label class = 'control-label'>Eartag*</label>" +
                    "<div class=\"col-md-12\">\n" +
                    "<input name=\"eartag\" id='eartag' value='"+data.eartag+"'  class=\"form-control\" readonly>\n" +
                    "<input name=\"id_sapi\" id=\"id_sapi\" value='"+data.id+"'  class=\"form-control\" hidden=''>\n" +
                    "\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "<div class=\"form-group\">\n" +
                    "<label class = 'control-label'>Harga Per Kg*</label>" +
                    "<div class=\"col-md-12\">\n" +
                    "\n" +
                    "<input type=\"number\" name=\"harga_per_kg\" id=\"harga_per_kg\" class=\"form-control\">\n" +
                    "\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "<div class=\"form-group\">\n" +
                    "<label class = 'control-label'>Bobot Sapi*</label>" +
                    "<div class=\"col-md-12\">\n" +
                    "<input type=\"number\" name=\"berat_sapi\" id='berat_sapi' class=\"form-control\">\n" +
                    "\n" +
                    "</div>\n" +
                    "</div>\n" +
                    "<div class=\"form-group\">\n" +
                    "<label class = 'control-label'>Total harga*</label>" +
                    "<div class=\"col-md-12\">\n" +
                    "<input type=\"number\" name=\"total_harga\" id='hitung_harga' class=\"form-control\" readonly>\n" +
                    "\n" +
                    "</div>\n" +
                    "</div>";
                document.getElementById("modal_body2").innerHTML = text;
                $("#add_to_chart").attr('disabled','disabled');
                $("#myModal2").modal("show");
                $("#berat_sapi,#harga_per_kg").keyup(function() {
                    hitung();
                });
                function hitung() {
                    var val1 = $('#harga_per_kg').val();
                    var val2 = $('#berat_sapi').val();
                    // console.log(val1+" - "+val2);

                    var kali = Number(val1) * Number(val2);
                    if ( val1 != "" && val2 != "" ) {
                        $('#hitung_harga').val(kali);
                        $('#add_to_chart').removeAttr('disabled');
                        // console.log(kali);
                    }

                }



            });


            showModal();

        }



        function startloader() {
            $('#loader').show();
        }
        function endloader() {
            $('#loader').hide();
        }
        function showModal(){
            $("#myModal").modal("show");
        };

        function closeModal(){
            $("#myModal").modal("hide");
        }
        function add_chart() {
            var id = $('#id_sapi').val();
            var eartag = $('#eartag').val();
            var harga_p_kg = $('#harga_per_kg').val();
            var bobot_sapi = $('#berat_sapi').val();
            var total_harga = $('#hitung_harga').val();
            var id_chart = $('#id_chart').val();
            var form = new FormData();
            form.append("id_chart", id_chart);
            form.append("id", id);
            form.append("eartag", eartag);
            form.append("harga_p_kg", harga_p_kg);
            form.append("bobot_sapi", bobot_sapi);
            form.append("total_harga", total_harga);

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url+"/jual_sapi",
                "method": "POST",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "6a469cc4-8303-4a02-891b-ee972ffbedf4"
                },
                "processData": false,
                "contentType": false,
                "mimeType": "multipart/form-data",
                "data": form
            }

            $.ajax(settings).done(function (response) {
                console.log(response);
                $('#id_chart').val(response);
                $("#myModal2").modal("hide");
                cari_sapi();
                update_chart(response);

            });
        }
        function insertlisttable() {
            var text2 = " <div class=\"table-responsive dt-responsive\">\n" +
                "<table id=\"list_chart\" class=\"table table-striped table-bordered nowrap\">\n" +
                "<thead>\n" +
                "<tr>\n" +
                "<th>Eartag</th>\n" +
                "<th>Jenis</th>\n" +
                "<th>Harga/Kg</th>\n" +
                "<th>Bobot *kg</th>\n" +
                "<th>Total Harga</th>\n" +
                "<th>Option</th>\n" +
                "</tr>\n" +
                "</thead>\n" +

                "</table>\n" +
                "</div>";

            document.getElementById("datachart").innerHTML = text2;
        }

        function update_chart(id_chart) {
            insertlisttable();

            var generatetable = $('#list_chart').DataTable({

                "ajax": url+"/jual_sapi/list_chart/"+id_chart,
                "columns": [
                    {"data": "eartag"},
                    {"data": "jenissapi.jenis_sapi"},
                    {"data": "harga_jual_p_kg"},
                    {"data": "bobot_sapi"},
                    {"data": "total_harga_jual"},
                    {"targets": -1,
                        "data": null,
                        "defaultContent": "<button class='btn btn-info btn-mini'>Hapus</button>"
                    }
                ],
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false

            });
            $('#list_chart').on('click', 'button', function() {
                var data = generatetable.row($(this).parents('tr')).data();
                delete_list(data.id_belanjasapi);

                // console.log(data);

            });
            total(id_chart);

        }
        function total(id_chart) {
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url+"/jual_sapi/list_chart/"+id_chart+"/total",
                "method": "GET",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "5749f6db-3f91-46ed-b1f8-aebdf391a105"
                }
            }

            $.ajax(settings).done(function (response) {
                console.log(response);
                $("#berat_total").val(response[0].berat);
                $("#harga_total").val(response[0].harga);


            });
        }
        function delete_list(id) {
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url+"/jual_sapi/list_chart/"+id+"/delete",
                "method": "GET",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "c0f5022b-b6d0-452f-b9e5-f8c8c29b15c1"
                }
            }

            $.ajax(settings).done(function (response) {
                console.log(response);
                var id_chart = $('#id_chart').val();
                update_chart(id_chart);
            });

        }



    </script>

@endsection
