<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class TrickRepository extends EntityRepository
{
    public function getLatest(int $page, int $limit, bool $published)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.published = :published')
            ->setParameter('published', $published)
            ->leftJoin('t.categories', 'c')
            ->addSelect('c')
            ->leftJoin('t.images', 'i')
            ->addSelect('i')
            ->orderBy('t.createAt', 'DESC')
            ->getQuery()
        ;

        $qb
            ->setFirstResult(($page-1) * $limit)
            ->setMaxResults($limit)
        ;

        return new Paginator($qb, true);
    }

    public function getOneBySlug($slug)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->leftJoin('t.categories', 'c')
            ->addSelect('c')
            ->leftJoin('t.images', 'i')
            ->addSelect('i')
            ->leftJoin('t.videos', 'v')
            ->addSelect('v')
        ;

        return $qb->getQuery()->getResult();
    }
}
