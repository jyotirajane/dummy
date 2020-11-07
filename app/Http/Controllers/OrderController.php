<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Imports\OrderImport;
use App\Export\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Helpers\CustomHelper;
use Storage;
use File;

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


        // try {
        //     Excel::load($filemove, function ($reader) {

        //         foreach ($reader->toArray() as $row) {
        //         Orders::updateOrCreate(
        //                 [
        //             'Order_Number' => $row['order_number'],
        //             'Item_Name' => $row['item_name']
        //             ],
        //                 $row
        //             );
        //         }
        //     });
        //     \Session::flash('success', 'Orders uploaded successfully.');
        //  return redirect(route('orders'));
        // } catch (\Exception $e) {
        //     \Session::flash('error', $e->getMessage());
        //     return redirect(route('orders'));
        // }

        return redirect('orders');

    }



    public function loadOrdersJSON(Request $request)
    {
        if($request->has('start_date') || $request->has('end_date')){
            return datatables()->of(Orders::whereBetween('Order_Date', [$request->get('start_date'), $request->get('end_date')])->get())->toArray();
        }
        return datatables()->of(Orders::all())->toArray();
    }

    public function export_order(Request $request)
    {
        if($request->has('export_with_date') && $request->get('export_with_date') == 'yes'){
            $orders = Orders::whereBetween('Order_Date', [$request->get('start'), $request->get('end')])->get()->toArray();
            $keys = array_keys($orders[0]);
            $final = array_prepend($orders, $keys);
            return Excel::download(new OrdersExport($final), 'orders.xlsx');
        }
        $orders= Orders::all()->toArray();
        $keys = array_keys($orders[0]);
        $final = array_prepend($orders, $keys);
        return Excel::download(new OrdersExport($final), 'orders.xlsx');
    }

    public function export_summary(Request $request)
    {
        $data = Orders::select('Item_Name', 'Building_Name',\DB::raw('SUM(Quantity) as items'))->groupBy(['Item_Name', 'Building_Name'])->get();


        $transpose_data=[];
        $keys=['Building_Name'];
        foreach($data as $row) {
            if(!in_array($row->Item_Name, $keys))
            {
                $keys[]=$row->Item_Name;
            }
            $transpose_data[$row->Building_Name][$row->Item_Name]=$row->items;
        }
        $keys[]='Remarks';
        foreach ($transpose_data as $key => $value) {
            $row_data=[];
            foreach ($keys as $arr_key){
                $row_data[$arr_key]=null;
            }
             $row_data['Building_Name']=$key;
            foreach ($value as $key1 => $value1){
                $row_data[$key1]=$value1;
            }
            $final_data[]=$row_data;
        }
        return Excel::download(new OrdersExport(array_prepend($final_data, $keys)), 'order_summary.xlsx');
    }

    public function export_filtered_summary(Request $request)
    {
        $exports= new OrdersExport;
        $data= $exports->summary();
        return Excel::download($data, 'orders.xlsx');
    }

    public function reports(Request $request)
    {
        return view('reports');
    }

    public function loadReportsJSON(Request $request)
    {
        $f_s_date = $request->input('startDate');
        $f_e_date = $request->input('endDate');

        $sql_query = "select count(*)as no_of_orders, Building_Name from orders";
        $sql_query.= " Where 1=1 ";
        if ( isset( $f_s_date ) && $f_s_date != null) {
              $f_s_date = date('Y-m-d', strtotime($f_s_date));
              $f_e_date = date('Y-m-d', strtotime($f_e_date));

              $sql_query .= "AND DATE(order_date) BETWEEN '$f_s_date' AND '$f_e_date'  ";
         }

        $sql_query .=" group by Building_Name order by Building_Name";

        $results = \DB::select(\DB::raw("$sql_query") );
        return datatables()->of($results)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = "<form method='POST' action='".url('reports/building_summary/download')."'><input type='hidden' value='".$row->Building_Name."' name='building'/><input type='hidden' name='_token' value='".csrf_token()."'/><input type='Submit' value='Download Report' class='edit btn btn-primary btn-sm'/></form>";
                return $btn;
            })->rawColumns(['action'])
            ->make(true);
    }

    public function export_building_summary(Request $request)
    {
        $Building_Name=$request->get('building');
        $data = Orders::select('Item_Name','Tower','House_No', 'Phone_Billing',
            'First_Name_Billing','Last_Name_Billing',
            \DB::raw('SUM(Quantity*Item_Cost) as items_cost'),
            \DB::raw('SUM(Quantity) as items'))->where('Building_Name',$Building_Name)
            ->groupBy(['Item_Name','Tower','House_No','Phone_Billing','First_Name_Billing','Last_Name_Billing'])->get();

        $distinct_rooms = Orders::select('Building_Name','Tower','House_No', \DB::raw('concat(First_Name_Billing," ",Last_Name_Billing) as name'),'Phone_Billing'
            )->where('Building_Name',$Building_Name)->distinct()->get()->toArray();
        $final_data = [];
        $transpose_data=[];
        $keys=['Building_Name','Tower','House_No','Name','Phone_Billing'];
        $product_keys=[];
        foreach($data as $row) {
            if(!in_array($row->Item_Name, $product_keys)) 
            {
                $keys[]=$row->Item_Name;
                $product_keys[]=$row->Item_Name;
            }
            $column_key=$row->Tower.'-'.$row->House_No.'-'.$row->First_Name_Billing.' '.$row->Last_Name_Billing.'-'.$row->Phone_Billing;
            $transpose_data[$column_key][$row->Item_Name]['quantity']=$row->items;
            $transpose_data[$column_key][$row->Item_Name]['Amount']=$row->items_cost;
        }
        $keys[]='Amount';
        $keys[]='Remarks';

        //print_r($transpose_data);
        //die();
        foreach($distinct_rooms as $rooms => $room)
        {
            //print_r($room);
            $amount=0;
            $arr_column_key=$room['Tower'].'-'.$room['House_No'].'-'.$room['name']
                .'-'.$room['Phone_Billing'];
                // echo $arr_column_key.'</br>';
                // print_r($transpose_data[$arr_column_key]);
            foreach ($product_keys as $arr_key){
                $room[$arr_key]=null;
            }
            foreach ($transpose_data[$arr_column_key] as $key => $value) {
            // echo $key;
            // print_r($value);
            // foreach ($value as $key1 => $value1){
                 $room[$key]=$value['quantity'];
                 $amount += $value['Amount'];
            // }

            }
            $room['Amount']=$amount;
            $final_data[]=$room;
        }
         // print_r($final_data);
         // die();
        // $final_data=$distinct_rooms;

        return Excel::download(new OrdersExport(array_prepend($final_data, $keys)), $Building_Name.'_order_summary.xlsx');
    }

}
