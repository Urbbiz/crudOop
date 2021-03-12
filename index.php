<?php
require __DIR__.'/bootstrap.php';



// _dc(explode('/',str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI'])));

$uri = explode('/',str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']));  //kelias

_d($uri);

//ROUTINGAS - routinsim routus i kontrolerio metodus.

if(''== $uri[0]) {
    (new AppleController)->index();
}
elseif('create'== $uri[0]){
    (new AppleController)->create();   // create metodas grazins mums create wievs.
}
elseif('store'== $uri[0]) {            // ideda nauja deze i musu aplikacija
    (new AppleController) ->store();
}
elseif('edit'== $uri[0]) {            // editina deze
    (new AppleController) ->edit((int)$uri[1]);    // mes einame i edit metoda
}
elseif('update'== $uri[0]) {            // editina deze
    (new AppleController) ->update((int)$uri[1]);    // mes einame i edit metoda
}
elseif('delete'== $uri[0]) {            // delete deze
    (new AppleController) ->delete((int)$uri[1]);    // mes einame i delete metoda
}






echo 'DURYS';
?>