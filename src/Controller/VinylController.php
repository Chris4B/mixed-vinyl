<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
    public function homepage():Response
    {
        $tracks = [
            ['song'=>'Gansta Paradise', 'artist' =>'Coolio'],
            ['song'=>'Waterfalls', 'artist' =>'TLC'],
            ['song'=>'Creep', 'artist' =>'Radiohead'],
            ['song'=>'kiss from a Rose', 'artist' =>'Boys II Men'],
            ['song'=>'Fantasy', 'artist' =>'Mariah Carey'],
        ];
        return $this->render('Vinyl/homepage.html.twig',[
            'title' =>'PB & Jams',
            'tracks' => $tracks
        ]);
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
