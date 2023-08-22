<?php

namespace App\Http\Controllers;

use App\Models\Indomaret;
use Illuminate\Http\Request;

class DataTableAjaxCRUDController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Indomaret::select('*'))
            ->addColumn('action', 'indomaret-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('indomarets');  
    }
      
    public function store(Request $request)
    {  
 
        // $indomaretId = $request->id;
 
        // $indomaret   =   Indomaret::updateOrCreate(
        //             [
        //              'id' => $indomaretId
        //             ],
        //             [
        //             'name' => $request->name, 
        //             'email' => $request->email,
        //             ]);    
                         
        // return Response()->json($indomaret);
        
        $post = Indomaret::udpate([
            'userEmail'   => $request->userEmail
        ]);

        // create post
        $post = Indomaret::create([
            'userName'     => $request->userName, 
            'userEmail'   => $request->userEmail
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post  
        ]);
 
    }
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $indomaret  = Indomaret::where($where)->first();
      
        return Response()->json($indomaret);

        
    }
      
      
   
    public function destroy(Request $request)
    {
        $indomaret = Indomaret::where('id',$request->id)->delete();
      
        return Response()->json($indomaret);
    }
}
