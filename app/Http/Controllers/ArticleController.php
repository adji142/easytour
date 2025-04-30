<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\EasyTourSetting;
use Inertia\Inertia;
class ArticleController extends Controller
{
    public function index(){
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();
        $articleCount = Article::where('status', 'published')->count();
        $articleLastest = Article::where('status', 'published')
                    ->orderBy('created_at', 'desc')->first();
        
        $article = null;
        if($articleLastest != null){
            $article = Article::where('status', 'published') 
                        ->where('id', '!=', $articleLastest->id)
                        ->orderBy('created_at', 'desc')->get();
        }

        return Inertia::render('ArticlePage',[
            'easyTourSetting' => $easyTourSetting,
            'article' => $article,
            'articleLastest' => $articleLastest,
            'articleCount' => $articleCount,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
            'BannerName' => "Article"
        ]);
    }

    public function detail($id){
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();
        $article = Article::where('id', $id)->first();

        return Inertia::render('ArticleDetailPage',[
            'easyTourSetting' => $easyTourSetting,
            'article' => $article,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
            'BannerName' => "Read Article"
        ]);
    }
    public function View(Request $request)
    {
        $article = Article::all();

        $title = 'Archive Article !';
        $text = "Are you sure you want to Archive Article ?";
        confirmDelete($title, $text);

        return view("EasyTourAdmin.article", [
            'article' => $article
        ]);
    }

    public function Form($id = null)
    {
        $sql = "articles.*";
        $article = Article::selectRaw($sql)
            ->where('id', '=', $id)->get();

        return view("EasyTourAdmin.article-Input", [
            'article' => $article,
        ]);
    }

    public function store(Request $request) {
        $data = array('success' => false, 'message' => '', 'data' => array());
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        try {
            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'thumbnail' => $request->image_base64,
            ]);

            $data['success'] = true;
            $data['message'] = 'Article Created Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }

        return response()->json($data);
    }

    public function edit(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $id = $request->input('id');
            $model = Article::findOrFail($id);
            $model->title = $request->input('title');
            $model->content = $request->input('content');
            $model->thumbnail = $request->input('image_base64');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Article Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function publish($id){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = Article::findOrFail($id);
            $model->status = 'published';
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Article Published Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
            alert()->success('error',$th->getMessage());
            return redirect('article');
        }
        alert()->success('Success','Article Published Successfully.');
        return redirect('article');
        // return response()->json($data);
    }

    public function archive($id){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            // $id = $request->input('id');
            // dd($id);
            $model = Article::findOrFail($id);
            
            $model->status = 'archived';
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Article Archived Successfully';
        } catch (\Throwable $th) {
            alert()->success('error',$th->getMessage());
            return redirect('article');
        }
        // return response()->json($data);
        alert()->success('Success','Article Archived Successfully.');
        return redirect('article');
    }
}
