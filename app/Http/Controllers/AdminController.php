<?php

namespace App\Http\Controllers;
use App\Exports\CustomExport;
use App\Models\Credit;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\PurchasePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PhoneListImport;
use App\Exports\PhoneListExport;
use App\Models\PhoneList;


class AdminController extends Controller
{

    protected $data;
    protected $allData;

            // view admin Dashboard

    public function index()
    {
        return view('admin.dashboard');
    }

            //  admin Dashboard file upload


    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImportExport()
    {
        //return view('file-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Illuminate\Validation\ValidationException
     */



    public function fileImport(Request $request)
    {
        Excel::import(new PhoneListImport, $request->file('file')->store('temp'));
        return back()->with('message', 'file imported Successfully');
    }

    /**
     * @return \Illuminate\Support\Collection
     */



    public function fileExport()
    {
        return Excel::download(new PhoneListExport, 'phoneList-collection.xlsx');
    }


    public function customExport(Request $request)
    {
        $credit=Credit::find($request->userId);
        if ($credit->useableCredit >= count($request->chk))
        {
            ExportHistori::newExportHistori($request);
            Credit::updateUserCradit($request);
            CreditHistory::create($request);
            return (new CustomExport($request->chk))->download('phoneList.xlsx');
        }
        else
        {
            return redirect('/settings/upgrade');
        }
    }



            //  admin Dashboard view all data // data edit update delete


    public function manageData(){
        $this->allData = PhoneList::paginate(10);
        return view('admin.manage-data', ['allData' => $this->allData]);
    }
    public function editData($id){
        $this->data = PhoneList::find($id);
        //return view('admin.edit-data', ['data'=>$this->data]);
    }
    public function updateData(Request $request){
        data::updatedata($request);
        return redirect('/manage-data')->with('message', 'data Updated Successfully');
    }
    public function deleteData($id){
        $this->data = PhoneList::find($id);
        $this->data->delete();
        return redirect()->back()->with('message', 'data Deleted Successfully');
    }
}
