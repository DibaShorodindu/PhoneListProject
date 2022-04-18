<?php

namespace App\Http\Controllers;

use App\Models\PhoneList;
use Illuminate\Http\Request;
use App\CustomClasses\ColectionPaginate;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    protected $data;
    protected $userData;
    public function index()
    {
        return view('front.dashboard');
    }
    public function home()
    {
        return view('front.home');
    }
    public function category($id)
    {
        $x=$id;
        $this->data = DB::table('phone_lists')
            ->where('first_name', 'like', $x.'%')
            ->paginate(50);
        return view('front.category', ['data'=>$this->data])->with('dataId', $x);
    }
    public function user($id)
    {
        $this->data = Phonelist::find($id);
        $result = substr($this->data->first_name, 0, 3);
        $this->userData = PhoneList::where('name', 'LIKE', $result. '%'  )->get();

        return view('front.user.user', ['data'=>$this->data])->with('userData', $this->userData);
    }
    public function userSearch(Request $request)
    {
        $this->data = PhoneList::where('name', $request->searchPeople)->first();
        $result = substr($this->data->name, 0, 3);
        $this->userData = PhoneList::where('name', 'LIKE', $result. '%'  )->get();

        return view('front.user.user', ['data'=>$this->data])->with('userData', $this->userData);
    }

    public function country($id)
    {
        $x=$id;
        $this->data = DB::table('phone_lists')
            ->where('country', 'like', $x.'%')
            ->paginate(50);
        return view('front.country.country', ['data'=>$this->data])->with('dataId', $x);
    }
}
