<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transactions
 *
 * @ORM\Table(name="transaction", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_transactions_orders1_idx", columns={"orders_id"})})
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @var string
     *
     * @ORM\Column(name="sum_transactions", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $sumTransactions;

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
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Orders
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Order")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="orders_id", referencedColumnName="id")
     * })
     */
    private $orders;



    /**
     * Set sumTransactions
     *
     * @param string $sumTransactions
     *
     * @return Transactions
     */
    public function setSumTransactions($sumTransactions)
    {
        $this->sumTransactions = $sumTransactions;

        return $this;
    }

    /**
     * Get sumTransactions
     *
     * @return string
     */
    public function getSumTransactions()
    {
        return $this->sumTransactions;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Transactions
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
     * @return Transactions
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
     * @return Transactions
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
     * Set orders
     *
     * @param \AppBundle\Entity\Orders $orders
     *
     * @return Transactions
     */
    public function setOrders(\AppBundle\Entity\Order $orders)
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * Get orders
     *
     * @return \AppBundle\Entity\Orders
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
