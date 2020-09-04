@extends('admin.layouts.master')
@section('css')
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/ablepro/bower_components/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    {{--<link rel="stylesheet" href="{{ asset('/ablepro/bower_components/select2/css/select2.min.css')}}" />--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('ablepro/bower_components/multiselect/css/multi-select.css')}}" />--}}
@endsection
@section('content')
    <div class="col-sm-12">
        <!-- Nestable card start -->
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <!-- [ page content ] start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <form>
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-blue">Date</h4>
                                                {!! Form::text('tanggal_awal', old('tanggal_awal'), array('class'=>'form-control datepicker block form-control-primary','id'=>'tanggal' ,'readonly', 'placeholder'=>'Awal')) !!}
                                                <h6>sampai</h6>
                                                {!! Form::text('tanggal_awal', old('tanggal_awal'), array('class'=>'form-control datepicker block form-control-primary','id'=>'tanggal2' ,'readonly', 'placeholder'=>'Akhir')) !!}
                                            </div>

                                            <div class="col-4 text-right">
                                                <i class="feather icon-calendar f-28"></i>
                                            </div>

                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-mini btn-info btn-block">Terapkan</button>
                                    </form>
                                    <div class="card-footer bg-c-blue">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <p class="text-white m-b-0">Filter Bulan</p>
                                            </div>
                                            <div class="col-3 text-right">
                                                <i class="feather icon-trending-down text-white f-16"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- page statustic card start -->
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <p class="text-white m-b-0">Sapi</p>
                                            </div>
                                            <div class="col-3 text-right">
                                                <i class="feather icon-trending-up text-white f-16"></i>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-yellow">{{ $sapi[0] }}</h4>
                                                <h6 class="text-muted m-b-0">Ekor Sapi</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-bar-chart-2 f-28"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="cari_sapi()" class="btn btn-info btn-block btn-mini"> Cari Sapi </button>
                                    <a href="{{ url('admin/belanjasapi/create?') }}" ><button class="btn btn-success btn-block btn-mini"> Tambah Sapi </button></a>


                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h5 class="text-muted m-b-0">Total</h5>
                                                <h4 class="text-c-green">{{ "Rp. ". number_format($sapi[1]->total_harga,0,',','.') }}</h4>

                                            </div>
                                            {{--<div class="col-4 text-right">--}}
                                                {{--<i class="feather icon-file-text f-28"></i>--}}
                                            {{--</div>--}}
                                        </div>

                                    </div>
                                    <div class="card-footer bg-c-green">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <p class="text-white m-b-0">Investasi</p>
                                            </div>
                                            <div class="col-3 text-right">
                                                <i class="feather icon-trending-up text-white f-16"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <input class="form-control form-bg-info text-center w3-text-black" id="tanggal_pakan" value="asda" readonly>
                                                <h6 id="anggaran_pakan" class="text-muted m-b-0"></h6>
                                                <h6 id="pakan_terpakai" class="text-muted m-b-0"></h6>
                                                <h6 id="sisa_anggaran_pakan" class="text-muted m-b-0"></h6>

                                            </div>


                                        </div>

                                    </div>
                                    <button onclick="detail_pakan()" class="btn btn-info btn-block btn-mini"> Lihat Detail </button>

                                    <div class="card-footer bg-c-red">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <p class="text-white m-b-0">Pakan</p>
                                            </div>
                                            <div class="col-3 text-right">
                                                <i class="feather icon-trending-down text-white f-16"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- page statustic card end -->

                            <div class="col-xl-8 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Statistik Pertumbuhan Sapi</h5>
                                        <div class="row">
                                            <div class="col-sm-12 col-xl-4 m-b-30">
                                                <select class="js-example-data-array col-sm-12" id="pilihsapi"></select>
                                            </div>
                                        </div>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                <li><i class="feather icon-trash close-card"></i></li>
                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        {{--<div id="sales-analytics" style="height: 360px;"></div>--}}
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h3>20500</h3>
                                        <p class="text-muted">Site Analysis</p>
                                        <div id="seo-anlytics1" style="height:50px"></div>
                                    </div>
                                </div>
                                <div class="card bg-c-blue text-white widget-visitor-card">
                                    <div class="card-block-small text-center">
                                        <h2>5,678</h2>
                                        <h6>Daily visitor</h6>
                                        <i class="feather icon-file-text"></i>
                                    </div>
                                </div>
                                <div class="card bg-c-yellow text-white widget-visitor-card">
                                    <div class="card-block-small text-center">
                                        <h2>5,678</h2>
                                        <h6>Last month visitor</h6>
                                        <i class="feather icon-award"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- seo start -->
                            <div class="col-xl-6 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Allocation</h5>
                                        <div class="card-header-right">                                                             <ul class="list-unstyled card-option">                                                                 <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>                                                                 <li><i class="feather icon-maximize full-card"></i></li>                                                                 <li><i class="feather icon-minus minimize-card"></i></li>                                                                 <li><i class="feather icon-refresh-cw reload-card"></i></li>                                                                 <li><i class="feather icon-trash close-card"></i></li>                                                                 <li><i class="feather icon-chevron-left open-card-option"></i></li>                                                             </ul>                                                         </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div id="allocation-map" style="height:250px"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div id="allocation-chart" style="height:250px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h3>$16,756</h3>
                                                <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                            </div>
                                            <div class="col-6">
                                                <div id="seo-chart1" style="height:50px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h3>49.54%</h3>
                                                <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                                            </div>
                                            <div class="col-6">
                                                <div id="seo-chart2" style="height:50px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h3>1,62,564</h3>
                                                <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                            </div>
                                            <div class="col-6">
                                                <div id="seo-chart3" style="height:50px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- seo end -->

                        </div>
                        <!-- [ page content ] end -->
                    </div>
                </div>
            </div>
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
    <div class="loader " id="loader" hidden="true"></div>
@endsection

@section('javascript')
    <!-- Float Chart js -->
    {{--<script src="{{ asset('ablepro/assets/pages/chart/float/jquery.flot.js') }}"></script>--}}
    {{--<script src="{{ asset('ablepro/assets/pages/chart/float/jquery.flot.categories.js') }}"></script>--}}
    {{--<script src="{{ asset('ablepro/assets/pages/chart/float/curvedLines.js') }}"></script>--}}
    {{--<script src="{{ asset('ablepro/assets/pages/chart/float/jquery.flot.tooltip.min.js') }}"></script>--}}
    <!-- amchart js -->
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/amcharts.js') }}"></script>
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/gauge.js') }}"></script>
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/serial.js') }}"></script>
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/light.js') }}"></script>
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/pie.min.js') }}"></script>
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/ammap.min.js') }}"></script>
    <script src="{{ asset('ablepro/assets/pages/widget/amchart/usaLow.js') }}"></script>
    <!-- data-table js -->
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
    {{--<!-- Multiselect js -->--}}
    {{--<script type="text/javascript" src="{{ asset('ablepro/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}">--}}
    {{--</script>--}}
    {{--<script type="text/javascript" src="{{ asset('ablepro/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('ablepro/assets/js/jquery.quicksearch.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('ablepro/assets/pages/advance-elements/select2-custom.js')}}"></script>--}}

    <!-- Custom js -->
{{--    <script src="{{ asset('ablepro/assets/pages/data-table/js/data-table-custom.js')}}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script type="text/javascript" src="{{ asset('/ablepro/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>



        var startDate = new Date();


        $('#tanggal').datepicker({
            autoclose: true,
            minViewMode: 1,
            format: 'yyyy-mm'
        }).on('changeDate', function(selected){
            startDate = new Date(selected.date.valueOf());
            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
            $('.to').datepicker('setStartDate', startDate);
        });
        $('#tanggal2').datepicker({
            autoclose: true,
            minViewMode: 1,
            format: 'yyyy-mm'
        }).on('changeDate', function(selected){
            startDate = new Date(selected.date.valueOf());
            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
            $('.to').datepicker('setStartDate', startDate);
        });





    </script>
    <script type="text/javascript" src="{{ asset('ablepro/assets/pages/dashboard/analytic-dashboard.min.js') }}"></script>
    <script>
        var url = "{{ url('/api/') }}";
        $(document).ready(function () {
            var data = [{
                id: 0,
                text: 'enhancement'
            }, {
                id: 1,
                text: 'bug'
            }, {
                id: 2,
                text: 'duplicate'
            }, {
                id: 3,
                text: 'invalid'
            }, {
                id: 4,
                text: 'wontfix'
            }];
            $("#pilihsapi").select2({
                data: data
            });

            pakan();
            console.log(url);

        });
        var tanggal = $("#tanggal_pakan");
        var anggaran_pakan = document.getElementById('anggaran_pakan');
        var pakan_terpakai = document.getElementById('pakan_terpakai');
        var sisa_anggaran_pakan = document.getElementById('sisa_anggaran_pakan');
        var html;

        function pakan() {
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url+"/anggaran_pakan",
                "method": "GET",
                "headers": {
                    "cache-control": "no-cache",
                    "Postman-Token": "21494fe4-28b6-48cc-806d-a8fae5e6086b"
                }
            }

            $.ajax(settings).done(function (response) {
                tanggal.val(response[2]);
                anggaran_pakan.innerHTML = "Anggaran Pakan : <br>"+response[0][0].jumlah_anggaran;
                pakan_terpakai.innerHTML = "Pakan Terpakai : <br>"+response[1][0].total_harga;
                sisa_anggaran_pakan.innerHTML = "Sisa Anggaran : <br>"+(parseInt(response[0][0].jumlah_anggaran) - parseInt(response[1][0].total_harga));
                // console.log(response);


            });
        }


        function detail_pakan() {
            html = "<table id=\"datapakan\" class=\"table table-striped table-bordered nowrap\">\n" +
                "                                <thead>\n" +
                "                                <tr>\n" +
                "                                    <td>Kandang</td>\n" +
                "                                    <td>Pakan</td>\n" +
                "                                    <td>Jumlah</td>\n" +
                "                                    <td>Harga</td>\n" +
                "                                    <td>Total Harga</td>\n" +
                "                                    <td>Tanggal Beli</td>\n" +
                "                                </tr>\n" +
                "                                </thead>\n" +
                "                                <tfoot>\n" +
                "                                <tr>\n" +
                "                                    <td>Kandang</td>\n" +
                "                                    <td>Pakan</td>\n" +
                "                                    <td>Jumlah</td>\n" +
                "                                    <td>Harga</td>\n" +
                "                                    <td>Total Harga</td>\n" +
                "                                    <td>Tanggal Beli</td>\n" +
                "                                </tr>\n" +
                "                                </tfoot>\n" +
                "\n" +
                "                            </table>";
            document.getElementById("modal_body").innerHTML = html;



            var datapakan = $('#datapakan').DataTable({
                "ajax": url+"/belanja_pakan/2019-October",
                "columns": [
                    {"data": "jenis_pakan"},
                    {"data": "kandang.nama"},
                    {"data": "jumlah"},
                    {"data": "harga"},
                    {"data": "total_harga"},
                    {"data": "tanggal_pembelian"}
                ]
            });
            console.log(datapakan);



            showModal();
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
                // $('#id_chart').val(response);
                // $("#myModal2").modal("hide");
                // cari_sapi();
                // update_chart(response);

                window.location.replace("{{ url('/admin/jualsapi/') }}"+response+"/edit");

            });
        }
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
                "                                    <tfoot>\n" +
                "                                    <tr>\n" +
                "                                        <th>Eartag</th>\n" +
                "                                        <th>Jenis</th>\n" +
                "                                        <th>Kandang</th>\n" +
                "                                        <th>Bobot *kg</th>\n" +
                "                                        <th>harga</th>\n" +
                "                                        <th>Pembelian</th>\n" +
                "                                        <th>option</th>\n" +
                "                                    </tr>\n" +
                "                                    </tfoot>\n" +
                "\n" +
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
                    {"data": "harga_p_ekor"},
                    {"data": "tanggal_pembelian"},
                    {"targets": -1,
                        "data": null,
                        "defaultContent": "<button class='btn btn-info btn-mini'>Jual</button>"
                    }
                ]

            });
            $('#datasapi').on('click', 'button', function() {
                var data = generatetable.row($(this).parents('tr')).data();
                // alert(data.eartag + "'Adalah Jenis Sapi " + data.jenis_sapi);
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

    </script>
@stop
