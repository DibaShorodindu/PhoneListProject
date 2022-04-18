<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditHistory extends Model
{
    use HasFactory;
    protected static $creditHistory;
    protected static $credit;
    protected $fillable = [
        'userId',
        'usedCredit',
        'useAbleCredit',
        'prevCredit',
        'dataPurchase',
        'date',
    ];
    public static function create($request)
    {
        self::$creditHistory = new CreditHistory();
        self::$credit = Credit::find($request->userId);
        $usableCredit = self::$credit->useableCredit;
        self::$creditHistory->userId         = $request->userId;
        self::$creditHistory->usedCredit  = count($request->chk);
        self::$creditHistory->useAbleCredit  = $usableCredit;
        self::$creditHistory->prevCredit  = $usableCredit;
        self::$creditHistory->dataPurchase  = count($request->chk);
        self::$creditHistory->date  = Carbon::now();
        self::$creditHistory->save();
    }
    /*public static function updateUseableCredit($request)
    {
        self::$purchagePlan = PurchasePlan::where('userId', $request->userId)->update([
            'useAbleCredit'       => $request->userId,
            'plan'         => $request->plan,
            'price'        => $request->price,
            'credit'       => $request->credit,
            'phoneNumber'  => $request->phoneNumber,
            'dataFilter'   => $request->dataFilter,
            'csvExport'    => $request->csvExport,
            'start'        => Carbon::now()->toDateString(),
            'end'          => Carbon::now()->addDays(29)->format('Y-m-d'),
        ]);
    }*/
}
