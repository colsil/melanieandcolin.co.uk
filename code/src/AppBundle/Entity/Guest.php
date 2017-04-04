<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Guest
 *
 * @ORM\Table(name="guest")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuestRepository")
 */
class Guest extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\OneToMany(targetEntity="GuestRoom", mappedBy="guest", cascade={"persist"})
     */
    private $rooms;

    /**
     * @var bool
     *
     * @ORM\Column(name="invitedday", type="boolean")
     */
    private $invitedday;

    /**
     * @var bool
     *
     * @ORM\Column(name="invitedevening", type="boolean")
     */
    private $invitedevening;

    /**
     * @var bool
     *
     * @ORM\Column(name="attendingday", type="boolean")
     */
    private $attendingday = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="attendingevening", type="boolean")
     */
    private $attendingevening = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="rsvp_received", type="boolean")
     */
    private $rsvpReceived = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Guest", inversedBy="plusOnes")
     * @ORM\JoinColumn(name="masterGuestId", referencedColumnName="id")
     */
    private $masterGuest;


    /**
     *
     * @ORM\OneToMany(targetEntity="Guest", mappedBy="masterGuest")
     */
    private $plusOnes;

    public function __construct()
    {
        parent::__construct();
        $this->plusOnes = new ArrayCollection();
        $this->rooms = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Guest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Guest
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Guest
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
     * @return Guest
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
     * Set invitedday
     *
     * @param boolean $invitedday
     *
     * @return Guest
     */
    public function setInvitedday($invitedday)
    {
        $this->invitedday = $invitedday;

        return $this;
    }

    /**
     * Get invitedday
     *
     * @return bool
     */
    public function getInvitedday()
    {
        return $this->invitedday;
    }

    /**
     * Set invitedevening
     *
     * @param boolean $invitedevening
     *
     * @return Guest
     */
    public function setInvitedevening($invitedevening)
    {
        $this->invitedevening = $invitedevening;

        return $this;
    }

    /**
     * Get invitedevening
     *
     * @return bool
     */
    public function getInvitedevening()
    {
        return $this->invitedevening;
    }

    /**
     * Set attendingday
     *
     * @param boolean $attendingday
     *
     * @return Guest
     */
    public function setAttendingday($attendingday)
    {
        $this->attendingday = $attendingday;

        return $this;
    }

    /**
     * Get attendingday
     *
     * @return bool
     */
    public function getAttendingday()
    {
        return $this->attendingday;
    }

    /**
     * Set attendingevening
     *
     * @param boolean $attendingevening
     *
     * @return Guest
     */
    public function setAttendingevening($attendingevening)
    {
        $this->attendingevening = $attendingevening;

        return $this;
    }

    /**
     * Get attendingevening
     *
     * @return bool
     */
    public function getAttendingevening()
    {
        return $this->attendingevening;
    }

    /**
     * Set rsvpReceived
     *
     * @param boolean $rsvpReceived
     *
     * @return Guest
     */
    public function setRSVPReceived($rsvpReceived)
    {
        $this->rsvpReceived = $rsvpReceived;

        return $this;
    }

    /**
     * Get rsvpReceived
     *
     * @return bool
     */
    public function getRSVPReceived()
    {
        return $this->rsvpReceived;
    }

    /**
     * Return whether this guest is a master guest (is not a plusone)
     *
     * @return bool
     */
    public function isMasterGuest()
    {
        if ($this->plusOnes->count() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Add a plusOne to this guest
     *
     * @param $guestid
     */
    public function addPlusOne($guestId)
    {
        $this->plusOnes->add($guestId);
        return;
    }

    /**
     * Get the list of plusOnes for this guest
     *
     * @return ArrayCollection
     */
    public function getPlusOnes()
    {
        return $this->plusOnes;
    }

    /**
     * Set the master guest id
     *
     * @param $guest
     * @return $guest
     */
    public function setMasterGuest($guest)
    {
        $this->masterGuest = $guest;
        return $this;
    }

    /**
     * Get the guest marked as the master guest for this guest, or null
     * if not a plusOne
     *
     * @return mixed
     */
    public function getMasterGuest()
    {
        return $this->masterGuest;
    }

    /**
     * Get the room bookings for this guest
     *
     * @return ArrayCollection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Add a room booking
     *
     * @param GuestRoom $room
     * @return bool
     */
    public function addRoom(GuestRoom $room) {
        return $this->rooms->add($room);
    }

    /**
     * Remove a room booking
     *
     * @param GuestRoom $room
     * @return bool
     */
    public function removeGuestRoom(GuestRoom $room) {
        return $this->rooms->removeElement($room);
    }

}
