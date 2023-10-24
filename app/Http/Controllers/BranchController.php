<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\BranchImages;
use App\Models\BranchTiming;
use App\Models\Business;
use App\Models\BusinessBranch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables,Redirect,Storage,Auth,DB,File;

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
        // dd($request->all());
        $branch =  BusinessBranch::create([
            "business_id" => $request->business_id,
            "name" => $request->name,
        ]);
        if(!empty($branch->id)){
            if(!empty($request->images)){
                foreach($request->images as $iValue){
                    $imageName="";
                    $imageName = time().'.'.$iValue->extension();
                    $iValue->move(public_path('branch_images'), $imageName);
                    BranchImages::create([
                        "branch_id" =>$branch->id,
                        "image" => $imageName,
                    ]);
                }
            }
            $createArr = [];
            if(!empty($request->week)){
                foreach($request->week as $key =>$wValue){

                    if( (isset($wValue['start_time']) && !empty($wValue['start_time'])) && (isset($wValue['end_time']) && !empty($wValue['end_time']))){
                        foreach($wValue['start_time'] as $sKey => $sValue){
                            if(isset($wValue['end_time'][$sKey]) && $wValue['end_time'][$sKey] !="" && $sValue!="" ){
                                $temp = [];
                                $temp['branch_id'] = $branch->id;
                                $temp['week_day'] = $key;
                                $temp['start_time'] = $sValue;
                                $temp['end_time'] =  $wValue['end_time'][$sKey];
                                $temp['opening_status'] = isset($wValue['opening_status']) ? 'Available' :'Unavailable';
                                $temp['created_at'] = date('Y-m-d H:i:s');
                                $createArr[] = $temp;
                            }
                        }

                    }
                }
            }
            // dd($createArr);
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
        return view("branch.index");
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
    public function destroy(Request $request,string $id)
    {
        $branch_id = $id ?? '';
        if(!empty($branch_id)){
                BranchTiming::where('branch_id',$branch_id)->delete();
                $branch_images = BranchImages::where('branch_id',$branch_id)->get();
                if(!empty($branch_images)){
                    foreach($branch_images as $bValue){
                        unlink("branch_images/".$bValue->image);
                        $bValue->delete();
                    }
                }
                BusinessBranch::where('id',$branch_id)->delete();
            return response()->json(["success"=>true,"message" => "Branch deleted successfully."]);
        }else{
            return response()->json(["error"=>true,"message" => "Server Error."]);
        }
    }

    public function show_timing(Request $request,$id){
        $id  = $request->id;
        return view("branch.branch_timing",compact('id'));
    }

    public function anydata(Request $request){
        if ($request->ajax()) {
            $data = BusinessBranch::select("*")->with('branchImages');
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function($data) {
               return $data->name ?? '';
            })
            ->addColumn('image', function($data){
                $logo = '';
                if(!empty($data->branchImages)){
                    foreach($data->branchImages as $image){
                        $url = asset('branch_images/'.$image->image);
                        $logo .= '<img src="'.$url.'" width="100" height="100">';
                    }
                }
                return $logo;
            })
            ->editColumn('action', function($data) {
                return '<a href="'.route("branch.show_timing",$data->id).'" class="btn btn-primary">View</a>
                        <a class="btn btn-danger delete_branch" data-url="'.route("branch.destroy",$data->id).'">Delete</a>';
            })
            ->rawColumns(['name','action','image'])
            ->make(true);
        }
    }

    public function branch_timing_list(Request $request,$id){
        if ($request->ajax()) {
            $data = BranchTiming::select("*")->where('branch_id',$id);
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('week_day', function($data) {
               return $data->week_day ?? '';
            })
            ->editColumn('start_time', function($data) {
                return date("h:i A",strtotime($data->start_time)) ?? '';
             })->editColumn('end_time', function($data) {
                return date('h:i A',strtotime($data->end_time)) ?? '';
             })->editColumn('opening_status', function($data) {
                $today = Carbon::now();
                $dayName = $today->format('l');
                $currentTime = Carbon::now('Asia/Kolkata')->format('H:i');
                if($data->week_day == $dayName){
                    if($data->start_time < $currentTime && $data->end_time > $currentTime){
                        return '<span class="badge badge-success">Today Open</span>';
                    }
                }
                else{
                    return '<span class="badge badge-danger">Close</span>';
                }
             })

            ->rawColumns(['week_day','start_time','end_time','opening_status'])
            ->make(true);
        }
    }
}
