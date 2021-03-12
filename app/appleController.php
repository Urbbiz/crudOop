<?php


class AppleController
{

    public function index()
    {
        $pageTitle = 'Apple Boxes';
        $boxes = Json::getDB()->readData();
        require DIR.'views/index.php';
    }


    public function create()
    {
        $pageTitle = 'New Apple Box';
        require DIR.'views/create.php';
    }

    public function store()
    {
        //POST scenarijus
        $box = new Box;          // sukuriam nauja box
        $box->apple = (int)($_POST['count'] ?? 0); // paimam kiek tu obuoliu yra

        Json::getDB()->store($box); // sukuria ir sekancioj eiluteje peradresuoja i kita location.
        header('Location: '.URL);
        die;
    }
    
    public function edit(int $id)
    {
        $box = Json::getDB()->getBox($id);
        $pageTitle = 'Edit Apple Box NR: '.$box->id; 
        require DIR.'views/edit.php';
    }

    public function update(int $id)
    {
        //POST scenarijus
        $box = Json::getDB()->getBox($id);    // gaunam box


        $box->apple = (int)($_POST['count'] ?? 0); // updatinam apple

        Json::getDB()->update($box); // updatina ir sekancioj eiluteje peradresuoja i kita location.
        header('Location: '. URL);
        die;
    }
    
    public function delete(int $id)
    {
        Json::getDB()->delete($id);
        header('Location: '. URL);
        die;
    }

}
