<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Imports\OrderImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use File;
use DB;
use App\Export\OrderExport;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('orders');
    }


    public function uploadScreen()
    {
        return view('orders_upload');
    }


    public function postUpload(Request $request)
    {
        $path = $request->file('orders');
        $filename = $path->getClientOriginalName();
        $uploads = storage_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        if (!file_exists($uploads)) {
            mkdir($uploads, 0777, true);
        }
        Storage::disk('uploads')->put($filename, File::get($path));
        $filemove = storage_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;
        Excel::import(new OrderImport, $filemove);
        return redirect('orders');
    }



    public function loadOrdersJSON(Request $request)
    {
        return datatables()->of(Orders::all())->toArray();
    }


    public function orderSummary(Request $request)
    {
        $data = Orders::select('Item_Name', 'First_Name_Billing',DB::raw('SUM(Item_Cost) as item_cost'), DB::raw('SUM(Quantity) as items'))->groupBy(['Item_Name', 'First_Name_Billing'])->get()->toArray();
        $keys = array_keys($data[0]);
        return Excel::download(new OrderExport(array_prepend($data, $keys)), 'order.xlsx');
    }

}
