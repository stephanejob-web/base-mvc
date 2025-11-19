<?php
namespace App\Controllers;
use App\Models\ArticleModel;
use Core\BaseController;

class ArticleController extends BaseController{
    public function index(){
        $article = new ArticleModel();

        $data = [
            "title" => "Liste des articles",
            "articles" =>$article->all(),
        ];
            $this->render('article/index', $data);
    }
}