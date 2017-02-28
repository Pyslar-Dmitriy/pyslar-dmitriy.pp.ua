<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Request $request, $filter = 'all'){
        $args = [];
        foreach (Category::select('name')->get() as $cat)
            $args[0][$cat->name] = $cat->name;
        array_unshift($args[0], trans('blog.all'));
        $args[] = $this->getTags();
        if($request->input('category')){
            $args[] = $this->filterByCategory($request);
            $args[] = $request->input('category');
        }
        else $args[] = $this->getArticles($filter);
        return view('common.blog')->with('args', $args);
    }
    
    private function getTags(){
        return DB::select("SELECT tags.id, tags.name, COUNT(tags_relations.article_id) as tagsCount FROM tags_relations
            LEFT JOIN tags ON tags.id = tags_relations.tag_id
            GROUP BY tags_relations.tag_id, tags.name, tags.id
            HAVING COUNT(tags_relations.article_id) > 0
            ORDER BY COUNT(tags_relations.tag_id) DESC
            LIMIT 10");
    }

    private function getArticles($filter){
        if($filter == 'all')
            return Article::orderBy('created_at','desc')->paginate(10);
        else
            return Article::join('tags_relations', 'articles.id', '=', 'tags_relations.article_id')->where('tags_relations.tag_id', $filter)->paginate(10);
    }

    private function filterByCategory(Request $request){
        $category = $request->input('category');
        return Article::join('categories', 'categories.id', 'articles.category_id')->where('categories.name', $category)->paginate(10);
    }

    public function showArticle($id){
        $args['article'] = Article::where('id', $id)->first();
        ++$args['article']->views;
        $args['article']->save();
        $args['category'] = Category::where('id', $args['article']->category_id)->select('name')->get()->toArray()[0]['name'];
        $args['tags'] = DB::select("SELECT name FROM tags_relations r JOIN tags t ON r.tag_id = t.id where article_id = $id");
        return view('common.article')->with('args', $args);
    }
}
