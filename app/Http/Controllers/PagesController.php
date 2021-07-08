<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    //
    public function addPage()
    {
        # code...
        
        return \File::get('/public/pages/page-.html');
        return view('pages.pages.add-page', [
            'title' => 'page ista create'
        ]);
    }

    
    public function pages()
    {
        # code...
        //C:\wamp64\www\bpms_cp\storage\app\public\pages\page-.html

        $pages = Page::paginate(50);
        return view('pages.pages.pages-list', [
            'title' => 'page ista update',
            'pages' => $pages
        ]);
    }

    public function createPage(Request $request)
    {
        # code...
        // return $request->all();
        $request->validate([
            // 'actived_at' => "required",
            'content' => "required",
            'title' => "required",
        ]);

        // $page = new Page();
        // $page->actived_at = $request->actived_at ? Carbon::now() : null;
        // $page->content = $request->content;
        // $page->title = $request->title;
        // $page->save();
        // $page->id
        Storage::put("public/pages/page-.html", $request->content);

        return response()->json([
            'status' => 'success',
            'title' => '',
            'message' => 'add page successfuly.',
        ], 200);
    }
}
