<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SongController extends AbstractController
{
    public function getSong(int $id, LoggerInterface $logger): Response
    {
        // TODO query the database
        $song = [
            'id' => $id,
            'name' => 'Waterfalls',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];

        $logger->info('returning API response for song {song}',[
            'song'=>$id,
        ]);

       // return new JsonResponse($song);
          return $this->json($song);
    }
}