<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telephone
 *
 * @ORM\Table(name="telephone", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_telephone_users_idx", columns={"users_id"})})
 * @ORM\Entity
 */
class Telephone
{
    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=45, nullable=false)
     */
    private $tel;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ManyToOne(targetEntity="AppBundle\Entity\Users", inversedBy="telephone")
     * @JoinColumn(name="users_id", referencedColumnName="id")
     */
    private $users;



    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Telephone
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Telephone
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
     * Set users
     *
     * @param \AppBundle\Entity\Users $users
     *
     * @return Telephone
     */
    public function setUsers(\AppBundle\Entity\Users $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUsers()
    {
        return $this->users;
    }
}
