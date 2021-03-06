<?php
/**
 * User: youcef_l
 * Date: 20/02/2017
 * Time: 16:52
 */
declare(strict_types = 1);


namespace Actor\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Film\Entity\Film;

/**
 * Class Actor
 * @package Actor\Entity
 *
 * @ORM\Entity(repositoryClass="Actor\Repository\ActorRepository")
 * @ORM\Table(name="actor")
 */
class Actor
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastName;

    /**
     *
     * @ORM\Column(name="date_birth", type="datetime", nullable =true)
     */
    private $dtBirth;


    /**
     * @var int
     *
     * @ORM\Column(name="sex", type="integer", length=100)
     */
    private $sex;

    /**
     * @ORM\ManyToMany(targetEntity="Film\Entity\Film", mappedBy="Actor\Entity\Actor")
     */

     private $film;

     public function __construct()
     {
         $this->film = new ArrayCollection();
     }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDtBirth()
    {
        return $this->dtBirth;
    }

    /**
     * @param \DateTime $dtBirth
     *
     * @return $this
     */
    public function setDtBirth(\DateTime $dtBirth)
    {
        $this->dtBirth = $dtBirth;

        return $this;
    }

    /**
     * @return int
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param int $sex
     *
     * @return $this
     */
    public function setSex(int $sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @param ArrayCollection $film
     *
     * @return $this
     */
    public function setFilm(ArrayCollection $film)
    {
        $this->film = $film;

        return $this;
    }



    public function addFilm(Collection $films)
    {
        foreach($films as $film) {
            $this->film[] = $film;
        }
    }

    public function removeFilm(Collection $films)
    {
        foreach ($films as $film) {
            $this->actor->removeElement($films);
        }
    }
}
