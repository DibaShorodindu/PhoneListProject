<?php

namespace App\Http\Controllers\User\Searching;

use App\Exports\CustomExport;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\PhoneList;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Response;
use Symfony\Component\Console\Output\ConsoleOutput;

class TypeaheadController extends Controller
{
    protected $data;
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = PhoneList::where('name', 'LIKE', '%'. $query. '%')->take(10)->get();
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->name;
        }
        return response()->json($data);

    }
    public function store(Request $request)
    {
        $credit=Credit::find(Auth::user()->id);
        if ($credit->useableCredit >= 1)
        {
            ExportHistori::newExportHistoriForOne($request);
            Credit::updateUserCraditForOne($request);
            CreditHistory::createForOne($request);
            $customExport = new CustomExport($request);
            return Response::json("okay");
        }
        else
        {
            return redirect('/settings/upgrade');
        }
    }



    public function searchPeople($request)
    {
        $query = $request;
        $this->data = DB::table('phone_lists')
            ->where('name', 'like', $query.'%');
        return view('userDashboard.people', ['allData' => $this->data]);

    }
}
