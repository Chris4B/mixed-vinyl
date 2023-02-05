<?php

namespace App\Controller;




use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
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
     public function browse(HttpClientInterface $httpClient,CacheInterface $cache, $slug = null):Response
     {
         dump($cache);
         $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
         $mixes = $cache->get('mixes_data' ,function(CacheItemInterface $cacheItem)use($httpClient){
             $response = $httpClient->request('GET','https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
             $cacheItem->expiresAfter(5);
             return $response->toArray();
         });

         return $this->render('vinyl/browse.html.twig', [
             'genre' => $genre,
             'mixes' => $mixes,
         ]);
     }

    private function getMixes(): array
    {
        // temporary fake "mixes" data
        return [
            [
                'title' => 'PB & Jams',
                'trackCount' => 14,
                'genre' => 'Rock',
                'createdAt' => new \DateTime('2021-10-02'),
            ],
            [
                'title' => 'Put a Hex on your Ex',
                'trackCount' => 8,
                'genre' => 'Heavy Metal',
                'createdAt' => new \DateTime('2022-04-28'),
            ],
            [
                'title' => 'Spice Grills - Summer Tunes',
                'trackCount' => 10,
                'genre' => 'Pop',
                'createdAt' => new \DateTime('2019-06-20'),
            ],
        ];
    }


}
