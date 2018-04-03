<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use c975L\UserBundle\Entity\UserFullAbstract;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="un_email", columns={"name", "email"})})
 * @ORM\Entity(repositoryClass="c975L\UserBundle\Repository\UserRepository")
 */
class User extends UserFullAbstract
{
    /**
     * @Assert\Regex(
     *      pattern="/^(live|google|facebook)$/i"
     * )
     * @ORM\Column(name="social_network", type="string", nullable=true)
     */
    protected $socialNetwork;

    /**
     * @ORM\Column(name="credits", type="integer", nullable=true)
     */
    protected $credits;


    /**
     * Set credits
     *
     * @param integer $credits
     *
     * @return User
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return integer
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Add credits
     *
     * @param integer $credits
     *
     * @return User
     */
    public function addCredits($credits)
    {
        $this->credits += $credits;

        return $this;
    }
}