<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_category_category1_idx", columns={"parent_id"})})
 * @ORM\Entity
 */
class Category
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\OneToMany(targetEntitty="AppBundle\Entity\Category", mappedBy="parent")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Category
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="id")
     */
    private $parent;

    
    public function __construct() {
        $this->parent = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add parent category
     *
     * @param \AppBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function addParent(\AppBundle\Entity\Category $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent cateogories
     *
     * @param \AppBundle\Entity\Cateogory $parent
     */
    public function removeParent(\AppBundle\Entity\Category $parent)
    {
        $this->products->removeElement($parent);
    }

    /**
     * Get parent categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParent()
    {
        return $this->parent;
    }
}
