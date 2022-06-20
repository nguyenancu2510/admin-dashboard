<?php

class Route {

    private function simpleRoute($file, $route){
        //replacing first and last forward slashes
        //$_SERVER['REQUEST_URI'] will be empty if req uri is /

        if(!empty($_SERVER['REQUEST_URI'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_SERVER['REQUEST_URI']);
        }else{
            $reqUri = "/";
        }

        if($reqUri == $route){
            $params = [];
            include($file);
            exit();

        }
    }

    function add($route,$file){
        

        //will store all the parameters value in this array
        $params = [];

        //will store all the parameters names in this array
        $paramKey = [];

        //finding if there is any {?} parameter in $route
        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        //if the route does not contain any param call simpleRoute();
        if(empty($paramMatches[0])){
            $this->simpleRoute($file,$route);
            return;
        }

        //setting parameters names
        foreach($paramMatches[0] as $key){
            $paramKey[] = $key;
        }

        //replacing first and last slashes
        //$_SERVER['REQUEST_URI'] will be empty if req uri is /
        if(!empty($_SERVER['REQUEST_URI'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_SERVER['REQUEST_URI']);
        }else{
            $reqUri = "/";
        }

        //exploding route address
        $uri = explode("/", $route);

        //will store index number where {?} parameter is required in the $route 
        $indexNum = []; 

        //storing index number, where {?} parameter is required with the help of regex
        foreach($uri as $index => $param){
            if(preg_match("/{.*}/", $param)){
                $indexNum[] = $index;
            }
        }

        //exploding request uri string to array to get
        //the exact index number value of parameter from $_SERVER['REQUEST_URI']
        $reqUri = explode("/", $reqUri);

        //running for each loop to set the exact index number with reg expression
        //this will help in matching route
        foreach($indexNum as $key => $index){
        
             //in case if req uri with param index is empty then return
            //because url is not valid for this route
            if(empty($reqUri[$index])){
                return;
            }
            
            //setting params with params names
            $params[$paramKey[$key]] = $reqUri[$index];


            //this is to create a regex for comparing route address
            $reqUri[$index] = "{.*}";
        }

        //converting array to sting
        $reqUri = implode("/",$reqUri);

        //replace all / with \/ for reg expression
        //regex to match route is ready !
        $reqUri = str_replace("/", '\\/', $reqUri);

        //now matching route with regex
        if(preg_match("/$reqUri/", $route))
        {
            include($file);
            exit();

        }
    }

    function notFound($file){
        include($file);
        exit();
    }
}
// //Route instance
$route = new Route();

// //Example
// $route->add("ROUTE ADDRESS","PHP FILE LOCATION FOR THIS ROUTE");

// //without parameter
$route->add("/", "pages/dashboard.php");
$route->add("/category","pages/category.php");
$route->add("/tables","pages/tables.php");
$route->add("/billing","pages/billing.php");
$route->add("/virtual-reality","pages/virtual-reality.php");
$route->add("/profile","pages/profile.php");
$route->add("/sign-in","pages/sign-in.php");
$route->add("/sign-up","pages/sign-up.php");

// //with parameter
// $route->add("/user/{id}","user.php");

// //in user.php access id like this :
// $params['id'];

// //At the last of index.php file call notFound() method of Route for 404 error.
// $route->notFound("404 PAGE LOCATION");

$route->notFound("pages/404.php");

?>