<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Credit;
use App\Models\CreditHistory;
use App\Models\ExportHistori;
use App\Models\PhoneList;
use App\Models\PhoneListUserModel;
use App\Models\PurchasePlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Session;
use Illuminate\Support\Facades\Auth;
use Storage;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    protected $email;
    protected $password;
    protected $emailAuth;
    protected $passwordAuth;
    protected $data;
    protected $id;
    protected $user;
    protected $allData;
    protected $credit;
    protected $creditHistory;
    protected $exportHistory;
    protected $purchasePlan;


    public function dashboard()
    {
        if(Auth::check()){
            $this->creditHistory = CreditHistory::where('userId',Auth::user()->id)->orderBy('date', 'desc')->get();
            $this->purchasePlan = PurchasePlan::where('userId',Auth::user()->id)->get();
            $i=0;
            $dataPurchase = [];
            foreach ($this->creditHistory as $history)
            {
                $dataPurchase [$i] = $history->dataPurchase;
                $i++;
            }
            $j=0;
            $creditPurchase = [];
            foreach ($this->purchasePlan as $plan)
            {
                $creditPurchase [$j] = $plan->credit;
                $j++;
            }
            return view('userDashboard.userDashboard',['userHistory'=> $this->creditHistory])->with('data',json_encode($dataPurchase,JSON_NUMERIC_CHECK))->with('credit',json_encode($creditPurchase,JSON_NUMERIC_CHECK));
        }
        return redirect('/phonelistUserLogin')->with('message','Oppes! You have entered invalid credentials');

    }
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function userRegister()
    {
        return view('user.userRegister');
    }

    public function newUser(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:phone_list_user_models,email',
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone'=>'required|min:11|numeric|unique:phone_list_user_models',
            'country' => 'required',
        ]);
        if ($validator->fails()) {
            //$errors = $validator->errors();
            return redirect()->back()->with('message1', 'The email or phone number has already been taken');
        } else {
            $check = $this->create($data);
            $newUser = PhoneListUserModel::where('email', $data['email'])->first();
            PurchasePlan::create($newUser);
            Credit::create([
                'userId' => $newUser->id,
                'useableCredit' => 20,
            ]);
            return redirect("loggedInUser")->with('message2', 'data Updated Successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return PhoneListUserModel::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'name' => $data['firstName'].' '.$data['lastName'],
            'phone' => $data['phone'],
            'country' => $data['country'],
        ]);
    }


    /** start updating user information*/
    public function updateUserFirstName(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['firstName' => $request->firstName]);
        return redirect()->back();

    }
    public function updateUserLastName(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['lastName' => $request->lastName]);
        return redirect()->back();

    }
    public function updateUserTitle(Request $request)
    {
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['title' => $request->title]);
        return redirect()->back();

    }
    public function updateUserPhone(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['phone' => $request->phone]);
        return redirect()->back();

    }
    public function updateUserAddress(Request $request)
    {
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['address' => $request->address]);
        return redirect()->back();

    }
    public function updateUserCountry($id)
    {
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['country' => $id]);
        return redirect()->back();
    }
    public function updateUserEmail(Request $request, $id)
    {
        $this->user = PhoneListUserModel::where('id', $id)->update(['email' => $request->email]);
        return redirect()->back();

    }
    public function updateUserPassword(Request $request, $id)
    {
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return redirect()->back();

    }
    public function updateUserInfo($array)
    {
        $myArray = explode(',', $array);
        $address = array_slice($myArray,5);
        $myAddress = implode(',', $address);
        //dd($myAddress);

        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['firstName' => $myArray[1]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['lastName' => $myArray[2]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['title' => $myArray[3]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['phone' => $myArray[4]]);
        $this->user = PhoneListUserModel::where('id', Auth::user()->id)->update(['address' => $myAddress]);
        return redirect()->back();

    }
    /** end updating user information*/
    /** start add/updating user billing information*/

    public function addCardInfo(Request $request)
    {
        Card::create([
            'userId' => $request->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'creditCardNumber' => $request->creditCardNumber,
            'expirationDate' => $request->expirationDate,
            'cvc' => $request->cvc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
        ]);
        return redirect()->route('billing');
    }
    public function updateCardInfo(Request $request)
    {
        Card::where('id', $request->cardId)->update([
            'userId' => $request->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'creditCardNumber' => $request->creditCardNumber,
            'expirationDate' => $request->expirationDate,
            'cvc' => $request->cvc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postalCode' => $request->postalCode,
        ]);
        return redirect()->route('billing');
    }
    public function removeCard()
    {
        Card::where('userId', Auth::user()->id)->delete();
        return redirect()->route('billing');
    }

    /** end add/updating user billing information*/

    public function userLogin()
    {
        return view('user.userLogin');
    }
    public function userLoginAuth(Request $request)
    {
        return view('user.userLogin');
    }

    /*
     * Write code on Method
     *
     * @return response()
     */
    public function userAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $result = $request->email;
            $this->data = PhoneListUserModel::where('email', 'LIKE', $result. '%'  )->get();
            return redirect('loggedInUser')
                ->with( ['userData' => $this->data] )
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("/phonelistUserLogin")->with('message','Oppes! You have entered invalid credentials');


    }

    public function handleGoogleRegister($userArray)
    {
        $this->data = $userArray;
        return view('user.', ['newUserData'=>$this->data]);
    }

    public function people()
    {
        $this->allData = PhoneList::paginate(15);
        return view('userDashboard.people', ['allData' => $this->allData]);
    }
    public function peopleSearch(Request $request)
    {
        $result = $request->name;
        $this->allData = DB::table('phone_lists')
            ->where('name', 'like', '%'.$result.'%')
            ->paginate(15);
        return view('userDashboard.peopleSearch', ['allData' => $this->allData, 'searchHistory' => $result]);
    }
    public function genderSearch(Request $request)
    {
        $result = $request->gender;
        $this->allData = DB::table('phone_lists')
            ->where('gender', 'like', '%'.$result.'%')
            ->paginate(15);

        return view('userDashboard.genderSearch', ['allData' => $this->allData, 'searchHistory' => $result]);
    }

    public function relationshipSearch(Request $request)
    {
        $result = $request->relationship;
        $this->allData = DB::table('phone_lists')
            ->where('relationship_status', 'like', '%'.$result.'%')
            ->paginate(15);

        return view('userDashboard.relationshipStatusSearch', ['allData' => $this->allData,'searchHistory' => $result]);
    }
    public function locationSearch(Request $request)
    {
        $result = $request->location;
        $this->allData = DB::table('phone_lists')
            ->where('location', 'like', '%'.$result.'%',)
            ->paginate(15);

        return view('userDashboard.addressSearch', ['allData' => $this->allData,'searchHistory' => $result]);
    }
    public function hometownSearch(Request $request)
    {
        $result = $request->hometown;
        $this->allData = DB::table('phone_lists')
            ->where('hometown', 'like', '%'.$result.'%')
            ->paginate(15);

        return view('userDashboard.hometownSearch', ['allData' => $this->allData,'searchHistory' => $result]);
    }
    public function countrySearch(Request $request)
    {
        $result = $request->country;
        $this->allData = DB::table('phone_lists')
            ->where('country', 'like', '%'.$result.'%')
            ->paginate(15);

        return view('userDashboard.countrySearch', ['allData' => $this->allData,'searchHistory' => $result]);
    }


    public function account()
    {
        return view('userDashboard.settings.account');
    }
    public function managePlan()
    {
        $data = PurchasePlan::where('userId', Auth::user()->id)->get();
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $items[0] = $data->last()->plan;
        $items[1] = $this->credit->useableCredit;

        $items[2] = $this->credit->useableCredit;
        $items[3] = $data->last()->price;

        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[4] = $monthName; $items[5] = $year; $items[6] = $day;
        //$date2 = Carbon::createFromFormat('Y-m-d', $data->last()->end);
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[7] = $monthName2; $items[8] = $day2; $items[9] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[10] = 0;
        $items[11] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[10]= $items[10]+$credithistory->usedCredit;
        }


        return view('userDashboard.settings.plans.managePlan', ['userPurchasePlan' => $items]);
    }

    public function billing()
    {
        $data = Card::where('userId', Auth::user()->id)->get();
        return view('userDashboard.settings.plans.billing', ['userCardInfo' => $data, 'amount'=>0]);
    }
    public function billingRequest(Request $request)
    {
        $data = Card::where('userId', Auth::user()->id)->get();
        return view('userDashboard.settings.plans.billingRequest', ['userCardInfo' => $data, 'purchasePlan'=>$request]);
    }
    public function exports()
    {
       $data = ExportHistori::where('userId',Auth::user()->id)->orderBy('createdOn', 'desc')->paginate(9);
        return view('userDashboard.settings.exports.exports', ['exportHistory' => $data]);
    }
    public function reDownloadFile($file_name)
    {
        $data = ExportHistori::find($file_name);
        return response()->download('storage/'. $data->file,'phonelist.xlsx');
    }
    public function csvExportSettings()
    {
        return view('userDashboard.settings.exports.csv-export-settings');
    }
    public function current()
    {
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[1] = $monthName; $items[2] = $year; $items[3] = $day;
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[4] = $monthName2; $items[5] = $day2; $items[6] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[7] = 0;
        $items[8] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[7]= $items[7]+$credithistory->usedCredit;
        }

        return view('userDashboard.settings.credits.current', ['userPurchasePlan' => $items]);
    }
    public function history()
    {
        //$this->creditHistory = ExportHistori::where('userId', Auth::user()->id)->get();
        //dd($this->creditHistory);
        $this->credit = Credit::where('userId', Auth::user()->id)->first();
        $monthName = Carbon::now()->subMonth()->format('M');
        if (Carbon::now()->format('M') == 'Jan')
        {
            $year = Carbon::now()->subYear()->format('Y');
        }
        else
        {
            $year = Carbon::now()->format('Y');
        }
        $day = Carbon::now()->subDays(30)->format('d');
        $items[1] = $monthName; $items[2] = $year; $items[3] = $day;
        $monthName2 = Carbon::now()->format('M');
        $day2 = Carbon::now()->format('d');
        $items[4] = $monthName2; $items[5] = $day2; $items[6] = Carbon::now()->format('Y');

        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        $this->creditHistory = CreditHistory::whereBetween('date', [$from, $to])->get();
        $items[7] = 0;
        $items[8] = $this->credit->useableCredit;
        foreach ($this->creditHistory as $credithistory)
        {
            $items[7]= $items[7]+$credithistory->usedCredit;
        }
        return view('userDashboard.settings.credits.history', ['userPurchasePlan' => $items]);
    }


    public function upgradeUser()
    {
        return view('userDashboard.settings.upgrade');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
