<?php

namespace App\Controller;



use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\String\u;

class VinylController
{
    public function homepage():Response
    {
        return new Response('je sui content');
    }
     public function browse(string $slug = null):Response
     {
         if($slug){
             $title = u(str_replace('-',  ' ',    $slug))->title(true);
             //the method "title" change all string to title case
         } else{
             $title = 'All Genres';
         }



         return new Response('vinyl browse: '.$title );
     }



}
