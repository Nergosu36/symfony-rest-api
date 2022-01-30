<?php

namespace App\Controller\Api;

use App\Service\Item\ItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $itemService;
    private $messages = [
        "not_found" => "Item with selected id not found.",
        "no_name_field" => "Name field is required.",
        "no_amount_field" => "Amount field is required"
    ];

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @Route("/api/v1/getAvailableItems", name="getAvailableItem", methods={"GET"})
     */
    public function getAvailableItems(Request $request): Response
    {
        $results = $this->itemService->getAvailableItems(); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/getUnavailableItems", name="getUnavailableItem", methods={"GET"})
     */
    public function getUnavailableItems(Request $request): Response
    {
        $results = $this->itemService->getUnavailableItems(); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/getItemsWithGTAmount", name="getItemsWithGTAmount", methods={"GET"})
     */
    public function getItemsWithGTAmount(Request $request): Response
    {
        $amount = $request->query->get("amount") ?? 5;
        $results = $this->itemService->getItemsWithGTAmount($amount); 
        return $this->json($results['content'], 200);
    }
    
    /**
     * @Route("/api/v1/getItems", name="getItems", methods={"GET"})
     */
    public function getItems(Request $request): Response
    {
        $results = $this->itemService->getItems(); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/getItem/{id}", name="getItem", methods={"GET"})
     */
    public function getItem(Request $request, Int $id): Response
    {
        $results = $this->itemService->getItem($id); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/postItem", name="postItem", methods={"POST"})
     */
    public function postItem(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data["name"])){
            return $this->json(["info" => $this->messages["no_name_field"]], 404);
        }

        if(!isset($data["amount"])){
            return $this->json(["info" => $this->messages["no_amount_field"]], 404);
        }

        $item = json_encode([
            "name" => $data["name"],
            "amount" => $data["amount"]
        ]);

        $results = $this->itemService->postItem($item); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/putItem/{id}", name="putItem", methods={"PUT"})
     */
    public function putItem(Request $request, Int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data["name"])){
            return $this->json(["info" => $this->messages["no_name_field"]], 404);
        }

        if(!isset($data["amount"])){
            return $this->json(["info" => $this->messages["no_amount_field"]], 404);
        }

        $itemEntity = $this->itemService->getItem($id);
        if(!isset($itemEntity['content']['item'])){
            return $this->json($this->messages["not_found"], 404);
        }

        $item = json_encode([
            "name" => $data["name"],
            "amount" => $data["amount"]
        ]);

        $results = $this->itemService->putItem($item, $id); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/patchItem/{id}", name="patchItem", methods={"PATCH"})
     */
    public function patchItem(Request $request, Int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $itemEntity = $this->itemService->getItem($id);
        if(!isset($itemEntity['content']['item'])){
            return $this->json($this->messages["not_found"], 404);
        }

        $item = json_encode([
            "name" => $data["name"] ?? $itemEntity["content"]["item"]["name"],
            "amount" => $data["amount"] ?? $itemEntity["content"]["item"]["amount"]
        ]);

        $results = $this->itemService->patchItem($item, $id); 
        return $this->json($results['content'], 200);
    }

    /**
     * @Route("/api/v1/deleteItem/{id}", name="deleteItem", methods={"DELETE"})
     */
    public function deleteItem(Request $request, Int $id): Response
    {
        $itemEntity = $this->itemService->getItem($id);
        if(!isset($itemEntity['content']['item'])){
            return $this->json($this->messages["not_found"], 404);
        }

        $results = $this->itemService->deleteItem($id); 
        return $this->json($results['content'], 200);
    }
}
