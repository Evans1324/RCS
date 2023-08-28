<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Validator;

class PostController extends Controller
{

    public function index()
    {
        return view('account_category_settings');
    }
    
    public function store(Request $request)
    {
        $request->validate ([
            'inputCategory' => 'required|string|min:5|max:60'
        ]);
        
        $check = DB::table('posts')->select('*')->where('id', $request->inputID)->first();
        if ($check) {
            $accCategory = Post::find($check->id);
            $accCategory->acc_category_settings = $request->inputType;
            $accCategory->save();
            $message = 'Sucessfully Updated';
        } else {
            $accCategory = new Post;
            $accCategory->acc_category_settings = $request->inputType;
            $accCategory->save();
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function getDeletedData(Request $request) {
        $post = new Post;
        $deletedData = $post::where('id',$request->inputID)->update([
            'deleted_at' => now()
        ]);                                                         
        // $deletedData->delete();
        // dd($request);
        return back()->with('Message', 'Successfully Deleted');
    }
}