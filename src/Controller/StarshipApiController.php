<?php

namespace App\Controller;

use App\Model\Starship;
use App\Repository\StarshipRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/starships')]
class StarshipApiController extends AbstractController {

    #[Route('', name: 'starships_get_collection', methods: ['GET'])]
    public function getCollection(StarshipRepository $repository) : Response {

        $startShips = $repository->findAll();

        return $this->json($startShips);
    }
    
    #[Route('/{id<\d+>}', name: 'starship_get_one', methods: ['GET'])]
    public function get(int $id, StarshipRepository $repository) : Response {
        $starship = $repository->findById($id);

        if (!$starship) {
            throw $this->createNotFoundException('Starship not found');
        }

        return $this->json($starship);
    }
}
