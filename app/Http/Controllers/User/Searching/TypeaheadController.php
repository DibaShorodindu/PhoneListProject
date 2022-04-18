<?php

namespace App\Http\Controllers\User\Searching;

use App\Http\Controllers\Controller;
use App\Models\PhoneList;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;

class TypeaheadController extends Controller
{
    protected $data;
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = PhoneList::where('name', 'LIKE', '%'. $query. '%')->take(10)->get();
        //return response()->json($filterResult);
        $data = array();
        foreach ($filterResult as $hsl)
        {
            $data[] = $hsl->name;
        }
        return response()->json($data);
        //echo json_encode($data);

    }

    public function searchPeople($request)
    {
        $query = $request;
        $this->data = DB::table('phone_lists')
            ->where('name', 'like', $query.'%');
        return view('userDashboard.people', ['allData' => $this->data]);

    }
}
