<?php

namespace App\Models;

use App\Exports\CustomExport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

class ExportHistori extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'createdOn',
        'file',
        'record',
    ];

    protected static $history;
    protected static $file;
    protected static $fileDirectory;
    protected static $fileName;
    protected static $fileUrl;

    public static function saveFile($request)
    {
        $filepath = 'user/release/'.\Auth::user()->id.'.'.time().'.'.'phoneList.xlsx' ;

        self::$file = Excel::store(new CustomExport($request->chk), $filepath, 'public');
        if(self::$file)
        {
            self::$fileName = \Auth::user()->id.'.'.time().'.'.'phoneList.xlsx';
            self::$fileDirectory = 'user/release/';
            self::$fileUrl = self::$fileDirectory.self::$fileName;
            return self::$fileUrl;
        }
        else{
            return '';
        }
    }

    public static function newExportHistori($request)
    {
        self::$history = new ExportHistori();
        self::$history->userId            = $request->userId;
        self::$history->createdOn         = Carbon::now();
        self::$history->file              = self::saveFile($request);
        self::$history->record            = count($request->chk);
        self::$history->save();
    }
}
