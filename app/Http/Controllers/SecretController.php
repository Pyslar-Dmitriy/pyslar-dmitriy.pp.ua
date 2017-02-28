<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class SecretController extends Controller
{
    public function index(){
        return view('dashboard.secret')->with('statistic',$this->getStatistic());
    }

    private function getStatistic(){
        $users_count = User::count();
        $works_count = Work::count();
        return [$users_count, $works_count];
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title_rus' => 'required|unique:works|max:255',
            'title_eng' => 'required|unique:works|max:255',
            'url' => 'required|unique:works|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);
    }
    
    public function createWork(Request $request){
        $data = $request->all();
        $this->validator($data)->validate();
        $work = new Work();
        if($request->hasFile('images')) {
            $imageRule = array('image' => 'image|max:5120');
            $messages = [
                'image' => 'Можно загружать только картинки',
                'max' => 'Каждый файл должен быть не больше 5 Мб',
            ];
            $imagesNames = array();
            $imagesFiles = array();
            foreach ($data['images'] as $image) {
                $imagesNames[] = $image->getClientOriginalName();
                $imagesFiles[] = $image;
                $image = array('image' => $image);
                $imageValidator = Validator::make($image, $imageRule, $messages);
                if ($imageValidator->fails()) {
                    $imagesNames = null;
                    return Response::json($imageValidator->errors(), 422);
                }
                File::delete(storage_path() . '/app/public/' . end($imagesNames));
                end($imagesFiles)->move(storage_path() . '/app/public/', end($imagesNames));
            }
            $work->images = implode(',', $imagesNames);
        }

        $work->title_rus = $data['title_rus'];
        $work->title_eng = $data['title_eng'];
        $work->url = $data['url'];
        $work->text_rus = $data['text_rus'];
        $work->text_eng = $data['text_eng'];
        $work->save();
        
        $tags = str_replace(' ', '', $data['tags']);
        $tagsArr = explode(',', $tags);

        foreach ($tagsArr as $tag){
            $current = Tag::firstOrCreate(['name' => $tag]);
            DB::table('tags_relations')->insert(['work_id' => $work->id, 'tag_id' => $current->id]);
        }
        
        return true;
    }

    public function removeWork($id){
        foreach(explode(',',Work::where('id', $id)->first()->images) as $image)
            File::delete(storage_path() . '/app/public/' . $image);
        Work::where('id', '=', $id)->delete();
        return redirect()->back();
    }

    public function editWork(Request $request){
        $data = $request->all();
        $currentWork = Work::find($data['id']);
        if($data['title_rus'] == $currentWork->title_rus || $data['title_eng'] == $currentWork->title_eng
            || $data['url'] == $currentWork->url && !$request->hasFile('images'));
        $currentWork->text_rus = $data['text_rus'];
        $currentWork->text_eng = $data['text_eng'];
        $tagsArr = explode(',',str_replace(' ', '', $data['tags']));
        if($data['tagsResult'] == str_replace(' ', '', $data['tags']))
            $currentWork->save();
        else{
            DB::table('tags_relations')->where('work_id', $data['id'])->delete();
            foreach ($tagsArr as $tag){
                $current = Tag::firstOrCreate(["name" => $tag]);
                DB::table('tags_relations')->insert(['work_id' => $data['id'], 'tag_id' => $current->id]);
            }
        }
        if($request->hasFile('images')) {
            $imageRule = array('image' => 'image|max:5120');
            $messages = [
                'image' => 'Можно загружать только картинки',
                'max' => 'Каждый файл должен быть не больше 5 Мб',
            ];
            $imagesNames = array();
            $imagesFiles = array();
            foreach ($data['images'] as $image) {
                $imagesNames[] = $image->getClientOriginalName();
                $imagesFiles[] = $image;
                $image = array('image' => $image);
                $imageValidator = Validator::make($image, $imageRule, $messages);
                if ($imageValidator->fails()) {
                    $imagesNames = null;
                    return Response::json($imageValidator->errors(), 422);
                }
                File::delete(storage_path() . '/app/public/' . end($imagesNames));
                end($imagesFiles)->move(storage_path() . '/app/public/', end($imagesNames));
            }
            $oldImages = $currentWork->images;
            $currentWork->images = $oldImages . ',' . implode(',', $imagesNames);
        }
        $currentWork->save();
        return redirect('/secret')->with('tab', 'portfolio');
    }

    public function addCategory(Request $request){
        $data = $request->all();
        Validator::make($data, ['name' => 'required|unique:categories|max:255'])->validate();
        $category = new Category();
        $category->name = $data['name'];
        $category->save();
        return redirect()->back()->with('tab', 'blog');
    }

    public function removeCategory($id){
        Category::where('id', '=', $id)->delete();
        return redirect()->back();
    }

    public function addArticleView(){
        $categories = [];
        foreach (Category::select('name')->get() as $cat)
            $categories[$cat->name] = $cat->name;
        return view('dashboard.addArticle')->with('categories', $categories);
    }
    
    public function addArticle(Request $request){
        $data = $request->all();
        Validator::make($data, ['title' => 'required|unique:articles'])->validate();
        $article = new Article();
        $article->title = $data['title'];
        $article->text = $data['text'];
        $article->category_id = Category::where('name', $data['category'])->first()->id;
        $article->save();
        
        $tags = explode(',',str_replace(' ', '', $data['tags']));
        foreach ($tags as $tag){
            $current = Tag::firstOrCreate(["name" => $tag]);
            DB::table('tags_relations')->insert(['article_id' => $article->id, 'tag_id' => $current->id]);
        }
        return redirect('/secret')->with('tab', 'blog');
    }

    public function removeArticle($id){
        Article::where('id', '=', $id)->delete();
        return redirect()->back()->with('tab', 'blog');
    }
}
