<?php

namespace Softlogo\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Softlogo\ShopBundle\Model\CustomerInterface;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Softlogo\ShopBundle\Model\OrderInterface;
//use Sonata\UserBundle\Model\User;

/**
 * Customer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Customer extends BaseUser implements CustomerInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(name="nip", type="string", length=255, nullable=true)
     */
    private $nip;

    /**
     * @ORM\Column(name="regon", type="string", length=255, nullable=true)
     */
    private $regon;

	/**
	 * @ORM\OneToMany(targetEntity="Softlogo\ShopBundle\Model\OrderInterface", mappedBy="customer", cascade="persist", orphanRemoval=true)
	 * @ORM\OrderBy({"id" = "DESC"})
     */
    private $customerOrders;

	/**
	 * @ORM\OneToMany(targetEntity="Softlogo\ShopBundle\Entity\Address", mappedBy="customer", cascade="persist", orphanRemoval=true)
     */
    private $addresses;




    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set company
     *
     * @param string $company
     * @return Customer
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set nip
     *
     * @param string $nip
     * @return Customer
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return string 
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set regon
     *
     * @param string $regon
     * @return Customer
     */
    public function setRegon($regon)
    {
        $this->regon = $regon;

        return $this;
    }

    /**
     * Get regon
     *
     * @return string 
     */
    public function getRegon()
    {
        return $this->regon;
    }


    /**
     * Add customerOrders
     *
     * @param \Softlogo\ShopBundle\Model\OrderInterface $customerOrders
     * @return Customer
     */
    public function addCustomerOrder(\Softlogo\ShopBundle\Model\OrderInterface $customerOrders)
    {
		$customerOrders->setCustomer($this);
        $this->customerOrders[] = $customerOrders;

        return $this;
    }


    /**
     * Remove customerOrders
     *
     * @param \Softlogo\ShopBundle\Model\OrderInterface $customerOrders
     */
    public function removeCustomerOrder(\Softlogo\ShopBundle\Model\OrderInterface $customerOrders)
    {
        $this->customerOrders->removeElement($customerOrders);
    }

    /**
     * Get customerOrders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCustomerOrders()
    {
        return $this->customerOrders;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
		parent::__construct();
        $this->customerOrders = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;


    /**
     * Add address
     *
     * @param \Softlogo\ShopBundle\Entity\Address $address
     *
     * @return Customer
     */
    public function addAddress(\Softlogo\ShopBundle\Entity\Address $address)
    {
		$address->setCustomer($this);
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Softlogo\ShopBundle\Entity\Address $address
     */
    public function removeAddress(\Softlogo\ShopBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

	public function removeAddresses(){
		if (is_array($this->addresses) || is_object($this->addresses)){
			foreach($this->addresses as $address){
			$this->removeAddress($address);
			} 
		}
	}

    public function updateFromOrder(\Softlogo\ShopBundle\Model\OrderInterface $order)
    {

		$this->setFirstname($order->getFirstname());
		$this->setLastname($order->getLastname());
		$this->setEmail($order->getEmail());
		$this->setPhone($order->getPhone());
		$this->setCompany($order->getCompany());
		$this->setNip($order->getNip());
		$this->setRegon($order->getRegon());

		$this->removeAddresses();
		//$this->getAddresses()->clear();

		foreach($order->getAddresses() as $address){
			$this->addAddress($address);
		} 
	}

}
