<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GuestRoom
 *
 * @ORM\Table(name="guest_room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuestRoomRepository")
 */
class GuestRoom
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Guest", inversedBy="rooms")
     * @ORM\JoinColumn(name="guest_id", referencedColumnName="id")
     */
    private $guest;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @return Guest
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * @param Guest $guest
     */
    public function setGuest($guest)
    {
        $this->guest = $guest;
    }


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
     * Set type
     *
     * @param string $type
     *
     * @return GuestRoom
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the number of rooms being booked
     *
     * @param $number the number of rooms being booked
     * @return GuestRoom
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }


}

