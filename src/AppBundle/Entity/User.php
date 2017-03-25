<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity()
* @ORM\Table(name="users",
*      uniqueConstraints={@ORM\UniqueConstraint(name="users_email_unique",columns={"email"})}
* )
*/
class User implements UserInterface
{
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    protected $plainPassword;


    /**
     * [getId description]
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * [setId description]
     * @param [type] $id [description]
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * [getFirstname description]
     * @return [type] [description]
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * [setFirstname description]
     * @param [type] $firstname [description]
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * [getLastname description]
     * @return [type] [description]
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * [setLastname description]
     * @param [type] $lastname [description]
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * [getEmail description]
     * @return [type] [description]
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * [setEmail description]
     * @param [type] $email [description]
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
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
     * Set plain password
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * [getRoles description]
     * @return [type] [description]
     */
    public function getRoles()
    {
        return [];
    }

    /**
     * [getSalt description]
     * @return [type] [description]
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * [getUsername description]
     * @return [type] [description]
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * [eraseCredentials description]
     * @return [type] [description]
     */
    public function eraseCredentials()
    {
        // Suppression des données sensibles
        $this->plainPassword = null;
    }
}
