<?php

namespace App\Services\Items;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\LazyCriteriaCollection;
use Symfony\Component\HttpFoundation\Response;

class ItemService
{
    protected $em;
    protected $ir;

    public $criteria;

    public function __construct(EntityManagerInterface $em_, ItemRepository $ir_)
    {
        $this->em = $em_;   
        $this->ir = $ir_;
        $this->criteria = new Criteria();
    }

    public function getAvailableItems(): LazyCriteriaCollection
    { 
        $this->criteria->where(Criteria::expr()->gt('amount', 0));
        return $this->ir->matching($this->criteria);
    }

    public function getUnavailableItems(): LazyCriteriaCollection
    {
        $this->criteria->where(Criteria::expr()->eq('amount', 0));
        return $this->ir->matching($this->criteria);
    }

    public function getItemsWithGTAmount(int $amount = 5): LazyCriteriaCollection
    {
        $this->criteria->where(Criteria::expr()->gt('amount', 0));
        return $this->ir->matching($this->criteria);
    }
    
    public function getItems()
    {
        return $this->ir->findAll();
    }

    public function getItem(int $id): Item
    {  
        return $this->ir->find($id);
    }

    public function postPutItem(array $attributes, int $id = null): Item
    {
        if($id){
            $item = $this->it->find($id);
            $item->setName($attributes['name'] ?? $item->getName());
            $item->setAmount($attributes['amount'] ?? $item->getAmount());
        }
        else{
            $item = new Item();
            $item->setName($attributes['name'] ?? null);
            $item->setAmount($attributes['amount'] ?? 0);
        }
        
        $this->em->persist($item);
        $this->em->flush();

        return $item;
    }

    public function patchItem(int $id, array $attributes): Item
    {
        $item = $this->it->find($id);



        $this->em->persist($item);
        $this->em->flush();
        return $item;
    }

    public function deleteItem(int $id): void
    {
        $this->em->ir->delete($id);
    }
}