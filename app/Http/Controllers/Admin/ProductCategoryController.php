<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    public function index(){
        return view('admin.pages.product_category.index');
    }
    public function create(){
        return view('admin.pages.product_category.create');
    }

    public function store(Request $request){
        //B1 : Validate + Has error -> show error
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'status' => ['required'],
        ],[
            'name.required' => 'Ten buoc phai nhap.',
            'name.min' => 'Ten it nhat 3 ky tu.',
            'name.max' => 'Ten nhieu nhat 10 ky tu.',
            'status.required' => 'Trang thai buoc phai nhap.'
        ]);

        //B2 : Receive data
        $name = $request->name;
        $status = $request->status;

        //B3: Empty Error -> Model -> insert -> DB
        //Query Builder
        $result = DB::table('product_category')->insert([
            'name' => $name,
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        //B4: Show thanh cong hay that bail
        //Flash message
        return redirect()->route('admin.product_category.index')->with('message', $result ? 'Thanh cong' : 'That bai');
    }
}
