<?php
class Json {

    private static $jsonObj;
    private $data;

    public static function getDB()
    {
    return self::$jsonObj ?? self::$jsonObj = new self;  // jeigu sitam objektui nera sukurtas json failas, tai as ji sukuriu ir priskiriu nauja.
    }

private function __construct()
{
    if (!file_exists(DIR.'data/boxes.json')) {// pirmas kartas
        $data = json_encode([]);
        file_put_contents(DIR.'data/boxes.json', $data);
    }
    $data = file_get_contents(DIR.'data/boxes.json');
    $this->data = json_decode($data);
}

public function __destruct()  // stebuklingai pasileidzia, kai objektas buna istrintas is atminties.
{
    file_put_contents(DIR.'data/boxes.json', json_encode($this->data));    // pries numirstant skriptui irasom faila i $his->data.
    
}


public function readData() : array
{
    return $this->data;
}

public function writeData(array $data) : void
{
    $this->data = json_encode($data);
}

public function getBox(int $id) : ?object
{
    foreach($this->data as $box) {
        if ($box->id == $id) {
            return $box;
        }
    }
    return null;
}

public function store(Box $box) : void    // create pervadinom i store funkcija
{
    $id = $this->getNextId();
    $box->id = $id;
    $this->data[] = $box;    // i masyva ideda objekta
}

public function update(object $updateBox) : void
{
    foreach($this->data as $key => $box) {     //jeigu egzistuoja, tai surandu ta ID
        if ($box->id == $updateBox ->id) {
            $this->data[$key] = $updateBox;           // tai ta ID surandu ir ji pakeiciu i nauja box ir iseinu is funkcijos.
            return;   
            }
    }
}


public function delete(int $id) : void  // ankciau vadinosi deleteBox funkcija
{
    foreach($this->data as $key => $box) {    // foreachinu per visus boxus ir jeigu jis sutampa
        if ($box->id == $id) {
            unset($this->data[$key]);   // tada ta boxa unsetinu ir jis isirasys automatiskai
            // normalizuojam masyva iki normalaus masyvo be "skyliu"
            $this->data = array_values($this->data);
            //
                /*
                pvz indeksai pries trynima 0 1 2 3 4
                trinam 2 elementa
                indeksai po trynimo 0 1 3 4
                indeksai po normalizavimo 0 1 2 3
                */
            return;
        }
    }
}


private function getNextId() : int
{
    if (!file_exists(DIR.'data/indexes.json')) {// pirmas kartas
        $index = json_encode(['id'=>1]);
        file_put_contents(DIR.'data/indexes.json', $index);
    }
    $index = file_get_contents(DIR.'data/indexes.json');
    $index = json_decode($index, 1);
    $id = (int) $index['id'];
    $index['id'] = $id + 1;
    $index = json_encode($index);
    file_put_contents(DIR.'data/indexes.json', $index);
    return $id;
}

}

/*
'index.php' ----> __DIR__ c:/x/box/ <----- atskaitos taskas define DIR
'../index.php' ----> __DIR__ c:/x/box/app
'../../index.php' ----> __DIR__ c:/x/box/app/dargiliau

__DIR__+'index.php'

*/