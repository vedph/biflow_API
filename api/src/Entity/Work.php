<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Validator\Constraints\RangeDate;

/**
 * This is the Work class. The beginning of our world.
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
 * @UniqueEntity("code")
 */
class Work
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
     * @var string The code of this work
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $code = '';

    /**
     * @var Author The author of this work
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="works")
     */
    public $author;

    /**
     * @var Content the content of this work
     * @ORM\Column(type="text", options={"default":""})
     */
    public $content = '';

    /**
     * @var Other Translations the history of the translations of this work. TBD
     * @ORM\Column(type="text", options={"default":""})
     */
    public $otherTranslations = '';

    /**
     * @var the genres whose the text was written.
     * @ORM\OneToMany(targetEntity="WorkGenre", mappedBy="work")
     */
    public $genres;
    
    /**
     * @var Expressions the list of the expressions for this work
     * @ORM\OneToMany(targetEntity="Expression", mappedBy="work")
     */
    public $expressions;

    /**
     * @var Editor The editor of this work
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Editor", inversedBy="works")
     */
    public $editor;

    /**
     * @var the work date
     *
     * @RangeDate
     * @ORM\Column(type="string", options={"default":""})
     */
    public $date = "";

    public function __construct() {
        $this->expressions = new ArrayCollection();
        $this->genres = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }
}
