<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinesHoursRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\BusinesHour;
class BusinesController extends Controller
{
    public function index(){
        $busineshours = BusinesHour::all();
        $user = auth('admin')->user();
        return view('Admins.SuperAdmin.business_hours', compact('user','busineshours'));
    }
    public function update(BusinesHoursRequest $request){
        $bh = BusinesHour::query()->upsert($request->validated()['data'],['day']);
        // is query me bhi condition hai wo miss hai
        // aur maine y function use nhi kuya hai to no idea
        // is query ko shi kro ye function create or update krta hai but iski koi  con dition hoti hai
        //iske jagah pe updateorcreate function use kr lo youtube or chatgpt simple haibhai office ka kuch kaam
        // ok then bye GN
        return back();
    }
}
