<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Tabel_belanja;
use Redirect;
use Schema;
use App\JualSapi;
use App\Http\Requests\CreateJualSapiRequest;
use App\Http\Requests\UpdateJualSapiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BelanjaSapi;
use PDF; // at the top of the file



class JualSapiController extends Controller {

    /**
     * Display a listing of jualsapi
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $jualsapi = Tabel_belanja::get();

        return view('admin.jualsapi.index', compact('jualsapi'));
    }

    /**
     * Show the form for creating a new jualsapi
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $belanjasapi = BelanjaSapi::pluck("eartag", "id")->prepend('Please select', null);
        $belanjasapi = BelanjaSapi::select('eartag','bobot_sapi');

        return view('admin.jualsapi.create', compact("belanjasapi"));
    }

    /**
     * Store a newly created jualsapi in storage.
     *
     * @param CreateJualSapiRequest|Request $request
     */
    public function store(CreateJualSapiRequest $request)
    {
        $id_chart = $request->id_chart;
        Tabel_belanja::where('id_chart','=',$id_chart)->update([
            'total_belanja'=>$request->total_harga,
            'nama_pembeli'=>$request->nama_pembeli,
            'no_tlpn'=>$request->no_tlpn,
            'alamat'=>$request->alamat,
            'status_bayar'=>$request->status_bayar,
            'bayar'=>$request->bayar,
            'keterangan'=>$request->keterangan,
            'status'=>2
        ]);


//        return $request;


//		JualSapi::create($request->all());

		return redirect()->route(config('quickadmin.route').'.jualsapi.index')->withErrors([$id_chart]);
    }

    /**
     * Show the form for editing the specified jualsapi.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id_chart)
    {

        return view('admin.jualsapi.create', compact("id_chart"));


        $jualsapi = JualSapi::find($id);
//	    $belanjasapi = BelanjaSapi::pluck("eartag", "id")->prepend('Please select', null);


        return view('admin.jualsapi.edit', compact('jualsapi', "belanjasapi"));
    }

    /**
     * Update the specified jualsapi in storage.
     * @param UpdateJualSapiRequest|Request $request
     *
     * @param  int  $id
     */
    public function update($id, UpdateJualSapiRequest $request)
    {
        $jualsapi = JualSapi::findOrFail($id);



        $jualsapi->update($request->all());

        return redirect()->route(config('quickadmin.route').'.jualsapi.index');
    }

    /**
     * Remove the specified jualsapi from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        BelanjaSapi::where('id_chart','=',$id)->update([
            'id_chart'=>0,
            'bobot_sapi'=>0,
            'harga_jual_p_kg'=>0,
            'total_harga_jual'=>0
        ]);
        Tabel_belanja::destroy($id);

        return redirect()->route(config('quickadmin.route').'.jualsapi.index');
    }

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Tabel_belanja::destroy($toDelete);
        } else {
            Tabel_belanja::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.jualsapi.index');
    }

    public function get_berat($data){
//        $belanjasapi = BelanjaSapi::select((DB::raw('SUM(bobot_sapi) as bobot_sapi')))->whereRaw('belanjasapi.eartag IN ('.$data.')')->get();
        $belanjasapi = BelanjaSapi::select( 'bobot_sapi')->whereRaw('belanjasapi.eartag IN ('.$data.')')->get();
        return response()->json($belanjasapi,200);

    }
    public function jual_sapi(Request $request){

        if(empty($request->id_chart)){
            $id_chart = rand(1000,999999).$request->eartag;
            $post = new Tabel_belanja();
            $post->id_chart = $id_chart;
            $post->status = 1;
            $post->save();
            $chart_id = $post->id;
        }
        else{
            $id_chart = $request->id_chart;
            $tabel_belanja = Tabel_belanja::select('id')->where('id_chart','=',$id_chart)->get();
            $chart_id = $tabel_belanja[0]->id;


        }

        $data = (int)$id_chart;
        BelanjaSapi::where('id','=',$request->id)->update([
            'id_chart'=>$chart_id,
            'bobot_sapi'=>$request->bobot_sapi,
            'harga_jual_p_kg'=>$request->harga_p_kg,
            'total_harga_jual'=>$request->total_harga

        ]);
        return response()->json($data,200);

    }
    public function list_chart($id_chart){
        $list_chart = BelanjaSapi::
        select(DB::raw('*, belanjasapi.id as id_belanjasapi'))
            ->join('tabel_belanja','tabel_belanja.id','=','belanjasapi.id_chart')
            ->where('tabel_belanja.id_chart','=',$id_chart)
            ->with("jenissapi")->with("kandang")
            ->get();
        $data = ([
            'data'=>$list_chart
        ]);
        return response()->json($data);

    }
    public function delete_list($id){
        BelanjaSapi::where('id','=',$id)->update([
            'id_chart'=>0,
            'bobot_sapi'=>0,
            'harga_jual_p_kg'=>0,
            'total_harga_jual'=>0
        ]);
        return response()->json($id,200);
    }
    public function total_h_b($id_chart) {
        $data = BelanjaSapi::select(DB::raw('sum(belanjasapi.total_harga_jual) AS harga, sum(belanjasapi.harga_jual_p_kg) AS berat'))
            ->join('tabel_belanja','tabel_belanja.id','=','belanjasapi.id_chart')
            ->where('tabel_belanja.id_chart','=',$id_chart)
            ->get();
        return response()->json($data,200);
    }
    public function get_data($id_chart){
        $data =Tabel_belanja::where('id_chart','=', $id_chart)->get();
        return response()->json($data,200);

    }

    public function struk($id_chart){

//
        PDF::SetAuthor('Dh Farm');
        PDF::SetTitle('Struk-'.$id_chart);
        PDF::SetSubject('TCPDF Tutorial');
        PDF::SetKeywords('TCPDF, PDF, example, test, guide');

// ---------------------------------------------------------

// set font
        PDF::SetFont('times', 'BI', 11);

        PDF::AddPage();
        $image_file = public_path('/images/dhfarm2.jpg');
        PDF::Image($image_file, 15, 10, 30, '', 'JPG', '', 'T', false, 0, '', false, false, 0, false, false, false);
        // Set font

        PDF::ln();


        PDF::SetFont('Times', 'B', 20);
        // Title
        PDF::Cell(0, 5, '- NOTA PEMBELIAN -', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        PDF::SetFont('Times', 'B', 18);
        PDF::ln();
        PDF::Cell(0, 5, 'DAURAH HASANAH FARM', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        PDF::SetFont('Times', 'I', 12);
        PDF::ln();
        PDF::Cell(0, 5, 'Alamat: Jl. Raya Hambaro, Babakan Sadeng, Leuwisadeng, Bogor, Jawa Barat 16640', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        PDF::ln();
        PDF::Cell(0, 10, 'Tlp. +62 811-9110-296/+62 812-8496-805, Website. www.ternaksapi.id', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        PDF::ln();
        PDF::writeHTML("<hr>", true, false, false, false, '');
//        $id_chart = 125855101;

        $list_chart = BelanjaSapi::
        select(DB::raw('*, belanjasapi.id as id_belanjasapi'))
            ->join('tabel_belanja','tabel_belanja.id','=','belanjasapi.id_chart')
            ->where('tabel_belanja.id_chart','=',$id_chart)
            ->with("jenissapi")->with("kandang")
            ->get();
        $data =Tabel_belanja::where('id_chart','=', $id_chart)->get();

        PDF::SetFont('Times', '', 12);
        PDF::Cell(30, 5, 'Nama Pembeli', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::Cell(120, 5, ': ' . $data[0]->nama_pembeli, 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::Cell(10, 5, 'Tanggal : '. date_format($data[0]->updated_at,"d-m-Y"), 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::ln();
        PDF::Cell(30, 5, 'Tlp', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::Cell(0, 5, ': '.$data[0]->no_tlpn, 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::ln();
        PDF::Cell(30, 5, 'Alamat', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::Cell(0, 5, ': '.$data[0]->alamat, 0, false, 'L', 0, '', 0, false, 'M', 'M');
        PDF::Write(0, 'Example of SetLineStyle() method', '', 0, 'L', true, 0, false, false, 0);

        PDF::Ln();
        PDF::SetFont('Times', 'B', 12);

        $i = 0;
        $header = array('No', 'Jenis Sapi','Eartag','Berat','Harga/Kg','Total');
        PDF::SetFillColor(124,124,124);

        PDF::SetTextColor(255,255,255);

        $w = array(10, 50,35, 30, 30, 35);
        for($i=0;$i<count($header);$i++)
            PDF::Cell($w[$i],7,$header[$i],1,0,'C',true);
        PDF::Ln();
        // Color and font restoration
        PDF::SetFillColor(194,194,194);
        PDF::SetTextColor(0);
        PDF::SetFont('');
        // Data
        $fill = false;
        $no = 1;
        foreach($list_chart as $row)
        {
            PDF::Cell($w[0],6,$no . '. ','LR',0,'L',$fill);
            PDF::Cell($w[1],6,$row->jenissapi->jenis_sapi,'LR',0,'C',$fill);
            PDF::Cell($w[2],6,$row->eartag,'LR',0,'C',$fill);
            PDF::Cell($w[3],6,$row->bobot_sapi . " Kg",'LR',0,'R',$fill);
            PDF::Cell($w[4],6,"Rp. ".number_format($row->harga_jual_p_kg),'LR',0,'R',$fill);
            PDF::Cell($w[5],6,"Rp. ".number_format($row->total_harga_jual),'LR',0,'R',$fill);
            PDF::Ln();
            $fill = !$fill;
            $no++;
        }
        PDF::SetFillColor(124,124,124);
        PDF::SetTextColor(255);
        PDF::SetDrawColor(0,0,0);
        PDF::SetLineWidth(0.3);
        PDF::SetFont('','B');

        PDF::Cell(155,6,"Total",'LR',0,'C',true);
        PDF::Cell($w[5],6,"Rp. ".number_format($data[0]->total_belanja),'LR',0,'R',true);
        PDF::Ln();




// ---------------------------------------------------------

//Close and output PDF document
        PDF::Output('example_035.pdf', 'I');

    }


}
