<?php

namespace App\Controller\Item;


use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\LazyCriteriaCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    private $entityManager;
    private $itemRepository;

    private $messages = [
        "not_found" => "Item with selected id not found.",
        "no_name_field" => "Name field is required.",
        "no_amount_field" => "Amount field is required"
    ];

    private $criteria;

    public function __construct(EntityManagerInterface $entityManager, ItemRepository $itemRepository)
    {
        $this->entityManager = $entityManager;   
        $this->itemRepository = $itemRepository;
        $this->criteria = new Criteria();
    }

    /**
     * @Route("/api/v1/item/getAvailableItems", name="getAvailableItems", methods={"GET"})
     */
    public function getAvailableItems(Request $request): JsonResponse
    { 
        $this->criteria->where(Criteria::expr()->gt("amount", 0));
        return $this->json(["items" => $this->itemRepository->matching($this->criteria)], 200);
    }

    /**
     * @Route("/api/v1/item/getUnavailableItems", name="getUnavailableItems", methods={"GET"})
     */
    public function getUnavailableItems(Request $request): JsonResponse
    {
        $this->criteria->where(Criteria::expr()->lte('amount', 0));
        return $this->json(["items" => $this->itemRepository->matching($this->criteria)], 200);
    }

    /**
     * @Route("/api/v1/item/getItemsWithGTAmount", name="getItemsWithGTAmount", methods={"GET"})
     */
    public function getItemsWithGTAmount(Request $request): JsonResponse
    {
        $amount = $request->query->get("amount") ?? 5;
        $this->criteria->where(Criteria::expr()->gt("amount", $amount));
        return $this->json(["items" => $this->itemRepository->matching($this->criteria)], 200);
    }

    /**
     * @Route("/api/v1/item/Items", name="getItems", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {
        return $this->json(["items" => $this->itemRepository->findAll()], 200);
    }

    /**
     * @Route("/api/v1/item/Items", name="postItem", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data["name"])){
            return $this->json(["info" => $this->messages["no_name_field"]], 404);
        }

        if(!isset($data["amount"])){
            return $this->json(["info" => $this->messages["no_amount_field"]], 404);
        }

        $item = new Item();
        $item->setName($data["name"] ?? null);
        $item->setAmount($data["amount"] ?? 0);
        
        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $this->json(["item" => $item], 200);
    }

    /**
     * @Route("/api/v1/item/Items/{id}", name="putItem", methods={"PUT"})
     */
    public function put(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data["name"])){
            return $this->json(["info" => $this->messages["no_name_field"]], 404);
        }

        if(!isset($data["amount"])){
            return $this->json(["info" => $this->messages["no_amount_field"]], 404);
        }

        $item = $this->itemRepository->find($id);
        if(!$item){
            return $this->json($this->messages["not_found"], 404);
        }

        $item->setName($data["name"]);
        $item->setAmount($data["amount"]);
        
        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $this->json(["item" => $item], 200);
    }


    /**
     * @Route("/api/v1/item/Items/{id}", name="getItem", methods={"GET"})
     */
    public function getItem(Request $request, int $id): JsonResponse
    {
        $item = $this->itemRepository->find($id);
        if(!$item){
            return $this->json($this->messages["not_found"], 404);
        }
        return $this->json(["item" => $item], 200);
    }

    /**
     * @Route("/api/v1/item/Items/{id}", name="patchItem", methods={"PATCH"})
     */
    public function patch(Request $request, $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $item = $this->itemRepository->find($id);
        if(!$item){
            return $this->json($this->messages["not_found"], 404);
        }

        $item->setName($data["name"] ?? $item->getName());
        $item->setAmount($data["amount"] ?? $item->getAmount());

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $this->json(["item" => $item], 200);
    }

    /**
     * @Route("/api/v1/item/Items/{id}", name="deleteItem", methods={"DELETE"})
     */
    public function delete(Request $request, $id): JsonResponse
    {
        $item = $this->itemRepository->find($id);

        if(!$item){
            return $this->json($this->messages["not_found"], 404);
        }

        $this->entityManager->remove($item);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
}
