<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Entity
 * @ORM\Table(name="order_has_product",
 * indexes={
 * @ORM\Index(name="fk_orders_has_products_orders1_idx", columns={"orders_id"}), 
 * @ORM\Index(name="fk_orders_has_products_products1_idx", columns={"products_id"})})
 */
class OrderHasProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="total_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $totalPrice;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="productOrder")
     * @ORM\JoinColumn(name="products_id", referencedColumnName="id")
     */
    private $product;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Order", inversedBy="orderProduct")
     * @ORM\JoinColumn(name="orders_id", referencedColumnName="id")
     */
    private $order;
    
//    public function __construct(\AppBundle\Entity\Product $product, \AppBundle\Entity\Order $order) {
//        $this->product = $product;
//        $this->order   = $order;
//    }

    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
    
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function getProduct()
    {
        return $this->product;
    }
    
    public function setProduct(\AppBundle\Entity\Product $product)
    {
        $this->product = $product;
    }

    public function getOrder()
    {
        return $this->order;
    }
    
    public function setOrder(\AppBundle\Entity\Order $order)
    {
        $this->order = $order;
    }


}
