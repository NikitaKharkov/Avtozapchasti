<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Users
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="fio", type="string", length=255, nullable=false)
     */
    private $fio;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="discount", type="smallint", nullable=true)
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=45, nullable=false)
     */
    private $role = 'user';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Telephone", mappedBy="users")
     */
    private $telephone;
    

    public function __construct() {
        $this->telephone = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set fio
     *
     * @param string $fio
     *
     * @return Users
     */
    public function setFio($fio)
    {
        $this->fio = $fio;
        \Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface::class;
        return $this;
    }

    /**
     * Get fio
     *
     * @return string
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Users
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     *
     * @return Users
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Users
     */
    public function setRole($role)
    {
        $this->role = strtolower(substr($role, 5));

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return "ROLE_".strtoupper($this->role);
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Users
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
     * @return Users
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Add telephone
     *
     * @param \AppBundle\Entity\Telephone $tel
     $
     * @return Category
     */
    public function addTelephone(\AppBundle\Entity\Telephone $tel)
    {
        $this->telephone[] = $tel;

        return $this;
    }

    /**
     * Remove telephone
     *
     * @param \AppBundle\Entity\Telephone $tel
     */
    public function removeTelephone(\AppBundle\Entity\Telephone $tel)
    {
        $this->products->removeElement($tel);
    }

    /**
     * Get telephone
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->fio,
            $this->discount
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,    
            $this->fio,
            $this->discount
        ) = unserialize($serialized);
    }


    public function eraseCredentials()
    {
        
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getSalt()
    {
        
    }

    public function getUsername()
    {
        return $this->fio;
    }

}
