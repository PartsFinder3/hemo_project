<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Number;
class ApiController extends Controller
{
    //
public function numbers() {
    $get_numbers = Number::all();
    return response()->json($get_numbers);
}
}
