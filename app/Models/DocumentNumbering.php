<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class DocumentNumbering extends Model
{
    use HasFactory;

    public function GetNewDoc($TableName, $ColomnName)
    {
    	$currentDate = Carbon::now();
		$Year = $currentDate->format('y');
		$Month = $currentDate->format('m');

		$prefix = $Year.$Month;

        $CharLength = 10;

		$lastNoTRX = DB::select(DB::raw("SELECT * FROM ".$TableName." WHERE LEFT(".$ColomnName.", ".strlen($prefix).") = '".$prefix."' AND RecordOwnerID = '".Auth::user()->RecordOwnerID."'" ));
		// var_dump($lastNoTRX);
		$NoTransaksi = $prefix.str_pad(count($lastNoTRX) + 1, $CharLength, '0', STR_PAD_LEFT);

		return $NoTransaksi;
    }
}
