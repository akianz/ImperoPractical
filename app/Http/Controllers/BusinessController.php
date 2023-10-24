<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BusinessRequest;
use App\Models\BranchImages;
use App\Models\BranchTiming;
use App\Models\Business;
use App\Models\BusinessBranch;
use DataTables,Redirect,Storage,Auth,DB;
use Illuminate\Support\Facades\File;

class BusinessController extends Controller
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
        return view('business.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessRequest $request)
    {
		$business_id = $request->create_business();
        if(!empty($business_id)){
            return Redirect('/')->with('success',"Business Added Successfully");
        }else{
            return redirect()->back();
        }
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
    public function destroy(Request $request,string $id)
    {
        $business_id = $id ?? '';
        if(!empty($business_id)){
            $business_branch = BusinessBranch::where('business_id',$business_id)->get();
            if(!empty($business_branch)){
                foreach($business_branch as $bValue){
                    BranchTiming::where('branch_id',$bValue->id)->delete();
                    $branch_images = BranchImages::where('branch_id',$bValue->id)->get();
                    if(!empty($branch_images)){
                        foreach($branch_images as $bRValue){
                            unlink("branch_images/".$bRValue->image);
                            $bRValue->delete();
                        }
                    }
                    $bValue->delete();
                }
            }
            $business = Business::where('id',$business_id)->first();
            if(!empty($business)){
                    unlink("images/".$business->logo);
                    $business->delete();
            }
            return response()->json(["success"=>true,"message" => "Business deleted successfully."]);
        }else{
            return response()->json(["error"=>true,"message" => "Server Error."]);
        }

    }

    public function anydata(Request $request){
        if ($request->ajax()) {
            $data = Business::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function($data) {
               return '<a href="'.route("branch.show",$data->id).'" style="text-decoration:underline; cursor:pointer;">'.$data->name.'</a>';
            })
            ->editColumn('email', function($data) {
                return $data->email ?? '';
             })
            ->editColumn('phone', function($data) {
               return $data->phone ?? '';
            })
            ->editColumn('logo', function($data) {
                return '<img src="' . asset("images/" . $data->logo) . '" width="100" height="400" />';
            })
            ->editColumn('action', function($data) {
                return '<a class="btn btn-danger delete_business" data-url="'.route("business.destroy",$data->id).'">Delete</a>';
            })
            ->rawColumns(['name','email','phone','logo','action'])
            ->make(true);
        }
    }
}
