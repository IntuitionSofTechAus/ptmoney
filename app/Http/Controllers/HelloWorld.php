<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\District;
use App\Models\Province;
use App\Models\Postcode;


class HelloWorld extends Controller
{
    
   
    public function index() {
        dd('asd');
          $diss  =  DB::table('districts')->
         join('olddistricts','olddistricts.name','districts.name')
        ->select('districts.*','olddistricts.id as disid')
          ->groupBy('districts.name')->get();
    foreach($diss as $dis )
    {
       
        Postcode::create(['proviance'=>$dis->proviance,'name'=>$dis->postcode,'district'=>$dis->disid]);
    }
        //return view('import');
    
    }

   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
       ini_set('max_execution_time', '0'); 
        Excel::import(new ExcelImport,request()->file('file'));
           
        return back();
    }

    public function getdistrict(Request $request)
    {
       $state = 00;
       $data = District::where('proviance',$request->id)->get();
       $html = view('optiondata', compact('data','state'))->render();
       return $html;
    }
     public function getstate(Request $request)
    {
       $state = 00;
       $data = Postcode::where('district',$request->id)->get();
       $html = view('optionselect', compact('data','state'))->render();
       return $html;
    }
    
    public function geteditdistrict(Request $request)
    {
       $state = $request->state;
       $data = District::where('proviance',$request->id)->get();
       $html = view('optiondata', compact('data','state'))->render();
       return $html;
    }
}
