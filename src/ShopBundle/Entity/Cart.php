<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CartRepository")
 */
class Cart
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idproducto", type="integer")
     */
    private $idproducto;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="quantityproduct", type="integer")
     */
    private $quantityproduct;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idproducto
     *
     * @param integer $idproducto
     *
     * @return Cart
     */
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;

        return $this;
    }

    /**
     * Get idproducto
     *
     * @return int
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Cart
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set quantityproduct
     *
     * @param integer $quantityproduct
     *
     * @return Cart
     */
    public function setQuantityproduct($quantityproduct)
    {
        $this->quantityproduct = $quantityproduct;

        return $this;
    }

    /**
     * Get quantityproduct
     *
     * @return int
     */
    public function getQuantityproduct()
    {
        return $this->quantityproduct;
    }
}

