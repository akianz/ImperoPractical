<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\BranchImages;
use App\Models\BranchTiming;
use App\Models\Business;
use App\Models\BusinessBranch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables,Redirect,Storage,Auth,DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $business_list  = Business::all();
        return view('branch.create',compact('business_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        $branch =  BusinessBranch::create([
            "business_id" => $request->business_id,
            "name" => $request->name,
        ]);
        if(!empty($branch->id)){
            if(!empty($request->images)){
                foreach($request->images as $iValue){
                    $imageName="";
                    $imageName = time().'.'.$iValue->extension();
                    $iValue->move(public_path('images'), $imageName);
                    BranchImages::create([
                        "branch_id" =>$branch->id,
                        "image" => $imageName,
                    ]);
                }
            }
            $createArr = [];
            if(!empty($request->week)){
                foreach($request->week as $key =>$wValue){
                    if($wValue['start_time'] != "" && $wValue['end_time'] != ""){
                        $temp = [];
                        $temp['branch_id'] = $branch->id;
                        $temp['week_day'] = $key;
                        $temp['start_time'] = Carbon::createFromFormat('h:i A', $wValue['start_time'])->format("H:i");
                        $temp['end_time'] =  Carbon::createFromFormat('h:i A', $wValue['end_time'])->format("H:i");
                        $temp['opening_status'] = isset($wValue['opening_status']) ? 'Available' :'Unavailable';
                        $temp['created_at'] = date('Y-m-d H:i:s');
                        $createArr[] = $temp;
                    }
                }
            }
            if(!empty($createArr)){
                BranchTiming::insert($createArr);
            }
        }
        return redirect('/')->with('success',"Branch Added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function anydata(Request $request){
        if ($request->ajax()) {
            $data = BranchTiming::with('getBranch');
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function($data) {
               return $data->getBranch->name ?? '';
            })
            ->editColumn('week_day', function($data) {
                return $data->week_day ?? '';
             })
            ->editColumn('start_time', function($data) {
               return date("h:i A",strtotime($data->start_time)) ?? '';
            })
            ->editColumn('end_time', function($data) {
               return date("h:i A",strtotime($data->end_time)) ?? '';
            })
            ->editColumn('opening_status', function($data) {
                return $data->opening_status ?? '';
            })
            ->rawColumns(['name','week_day','start_time','end_time','opening_status'])
            ->make(true);
        }
    }
}
