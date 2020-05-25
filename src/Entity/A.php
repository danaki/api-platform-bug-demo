<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Validator\BatchQuantity;
use App\Validator\UniqueStartedBatchPerEmployee;
use App\Validator\UniqueUnfinishedBatchPerEmployeePerProductionPlan;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @ApiResource(
 *     attributes={"order"={"id": "DESC"}},
 *     graphql={
 *         "collection_query"={"normalization_context"={"groups"={"a:query"}}},
 *         "item_query"={"normalization_context"={"groups"={"a:query"}}},
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *     "b": "exact",
 *     "b.c": "exact"
 * })
 */
class A
{
    /**
     * @var ?int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ProductionPlan
     *
     * @ORM\ManyToOne(targetEntity="B")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *     "a:query",
     * })
     */
    protected $b;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }    
}
