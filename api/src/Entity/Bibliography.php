<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Bibliography class. References related to the expression.
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *      itemOperations={
 *         "get",
 *         "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     }
 * )
 * @ORM\Entity
 */
class Bibliography
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var expression The expression this reference belongs to.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Expression", inversedBy="bibliographies")
     */
    public $expressions;

    /**
     * @var string The title of this reference.
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $title;

    /**
     * @var The author of the reference.
     * @Assert\NotNull
     * @ORM\Column(type="text")
     */
    public $author;

    /**
     * @var The editor of this reference
     * @ORM\Column(type="text", options={"default":""})
     */
    public $editor = '';

    /**
     * @var string The city where the library is
     *
     * @ORM\Column
     * @Assert\NotNull
     */
    public $place;

    /**
     * @var The date of this reference
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     */
    public $date;

    /**
     * @var Publisher of this reference.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $publisher = '';


    /**
     * @var Name of the journal.
     * @ORM\Column(type="text", options={"default":""})
     */
    public $journal = '';

    /**
     * @var codeBibl The code linked to the reference.
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="CodeBibl", inversedBy="bibliography")
     */
    public $codeBibl;

    /**
     * @var The issue of this journal
     * @ORM\Column(type="text", options={"default":""})
     */
    public $journalNumber = '';

    public function __construct() {
        $this->expressions = new ArrayCollection();
    }   

    public function getId(): int
    {
        return $this->id;
    }
}
