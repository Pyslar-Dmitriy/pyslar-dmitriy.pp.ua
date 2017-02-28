<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index($filter = 'all'){
        $args = [];
        $args[] = $this->getTags();
        $args[] = $this->getWorks($filter);
        return view('common.portfolio')->with('args', $args);
    }

    private function getTags(){
        return DB::select("SELECT tags.id, tags.name, COUNT(tags_relations.work_id) as tagsCount FROM tags_relations
            LEFT JOIN tags ON tags.id = tags_relations.tag_id
            GROUP BY tags_relations.tag_id, tags.name, tags.id
            HAVING COUNT(tags_relations.work_id) > 0
            ORDER BY COUNT(tags_relations.tag_id) DESC
            LIMIT 10");
    }

    private function getWorks($filter){
        if($filter == 'all')
            return Work::paginate(2);
        else
            return Work::join('tags_relations', 'works.id', '=', 'tags_relations.work_id')->where('tags_relations.tag_id', $filter)->paginate(2);
    }
}
