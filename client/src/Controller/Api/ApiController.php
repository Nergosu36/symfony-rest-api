<?php

namespace App\Controller\Api;

use App\Service\Item\ItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    
    /**
     * @Route("/api/v1/test", name="test")
     */
    public function test(): Response
    {
        $results = $this->itemService->getItems(); 
        return $this->json($results['content'], 200);
    }
}
