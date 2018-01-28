<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findProducts($params)
    {
        $qb = $this->createQueryBuilder('p');

        if (!empty($params['limit'])) {
            $qb->setMaxResults($params['limit']);
        }

        if (!empty($params['offset'])) {
            $qb->setFirstResult($params['offset']);
        }

        return $qb->getQuery()->getResult();
    }
}
