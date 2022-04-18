<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected static $credit;
    protected $fillable = [
        'userId',
        'useableCredit'
    ];

    public static function updateUserCradit($request)
    {
        self::$credit = Credit::find($request->userId);
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit-count($request->chk);
        self::$credit->save();
    }
    public static function updateCradit($request)
    {
        self::$credit = Credit::find($request->userId);
        $usableCredit = self::$credit->useableCredit;
        self::$credit->userId         = $request->userId;
        self::$credit->useableCredit  = $usableCredit+$request->credit;
        self::$credit->save();
    }
}
