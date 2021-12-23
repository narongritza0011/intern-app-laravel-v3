<?php

namespace App\Http\Controllers;

use App\Internship;
use App\SubmitDocument;
use DataTables;
use Illuminate\Http\Request;

class InternMemberController extends Controller
{

    function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Internship::where('status', 'กำลังรออนุมัติ')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('edit', function ($data) {
                    return '<a class="btn btn-warning mr-1" onclick="editData(' . $data->id . ')"><i class="fas fa-eye"></i> </a> <a class="btn btn-primary mr-1" href="internship/resume/' . $data->id . '" ><i class="fas fa-file"></i></a>  <a  onclick="uploadData(' . $data->id . ')" class="btn btn-success" data-toggle="modal" data-target="#uploadModal">
                    <i class="fa fa-upload"></i>
                  </a>';
                })
                ->addColumn('time', function ($data) {
                    return  '<div class="text-success">' . $data->start_intern . ' - ' . $data->end_intern . '</div>';
                })

                ->rawColumns(['edit', 'name', 'time'])
                ->make(true);
        }
        return view('internship.index');
    }



    public function store(Request $request)
    {
        //  dd($request->all());
        if ($request->id) {

            $data = Internship::find($request->id);
        } else {
            $data = new Internship();
        }

        $data->status = $request->status;
        $data->save();

        $json['success'] = true;
        $json['message'] = '';
        // return response()->json($json);
        return $json;
    }

    public function uploadFileIntern(Request $request)
    {
        dd($request->all());
        if ($request->id) {

            $data = Internship::find($request->id);
        } else {
            $data = new Internship();
        }

        $data->status = $request->status;
        $data->save();

        $json['success'] = true;
        $json['message'] = '';
        // return response()->json($json);
        return $json;
    }






    public function view($id)
    {
        $data = Internship::find($id);

        $json['message'] = '';
        $json['success'] = true;
        $json['cus'] = $data;
        return response()->json($json);
    }



    public function viewUploadFile($id)
    {
        $data = Internship::find($id);

        $json['message'] = '';
        $json['success'] = true;
        $json['cus'] = $data;
        return response()->json($json);
    }




    public function resume($id)
    {
        $data = Internship::find($id);

        // dd($data);
        return view('internship.view_resume', compact('data'));
    }







    //หน้าอนุมัติเเล้ว

    function approved(Request $request)
    {

        if ($request->ajax()) {
            $data = Internship::where('status', 'อนุมัติเเล้ว')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('edit', function ($data) {
                    return '<a class="btn btn-warning m-1" onclick="editData(' . $data->id . ')"><i class="fas fa-eye"></i> </a> <a class="btn btn-primary" href="internship/resume/' . $data->id . '" ><i class="fas fa-file"></i></a>';
                })
                ->addColumn('time', function ($data) {
                    return  '<div class="text-success">' . $data->start_intern . ' - ' . $data->end_intern . '</div>';
                })

                ->rawColumns(['edit', 'name', 'time'])
                ->make(true);
        }
        return view('internship.approved');
    }



    //หน้าฝึกงานเสร็จเเล้ว

    function internSuccess(Request $request)
    {

        if ($request->ajax()) {
            $data = Internship::where('status', 'ฝึกงานเสร็จเเล้ว')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })

                ->addColumn('edit', function ($data) {
                    return '<a class="btn btn-warning " onclick="editData(' . $data->id . ')"><i class="fas fa-eye"></i> </a> <a class="btn btn-primary" href="internship/resume/' . $data->id . '" ><i class="fas fa-file"></i></a>';
                })
                ->addColumn('time', function ($data) {
                    return  '<div class="text-success">' . $data->start_intern . ' - ' . $data->end_intern . '</div>';
                })


                ->rawColumns(['edit', 'name', 'time'])
                ->make(true);
        }
        return view('internship.intern_success');
    }






   
}
