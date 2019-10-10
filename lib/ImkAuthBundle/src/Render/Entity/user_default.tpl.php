<?php echo "<?php"; ?>

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Imk\AuthBundle\Interfaces\UsersInterface;

/**
* @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
*/
class Users implements UsersInterface
{
/**
* @ORM\Id()
* @ORM\GeneratedValue()
* @ORM\Column(type="integer")
*/
private $id;

/**
* @ORM\Column(type="string", length=255, nullable=true)
*/
private $username;

/**
* @ORM\Column(type="string", length=255)
*/
private $password;

/**
* @ORM\Column(type="array")
*/
private $roles = [];

/**
* @ORM\Column(type="string", length=255, nullable=true)
*/
private $salt;

/**
* @ORM\Column(type="boolean", nullable=true)
*/
private $enabled;

/**
* @ORM\Column(type="string", length=255, nullable=true)
*/
private $token;

/**
* @ORM\Column(type="datetime")
*/
private $updatedAt;

public function getId(): ?int
{
return $this->id;
}

public function getUsername(): ?string
{
return $this->username;
}

public function setUsername(?string $username): self
{
$this->username = $username;

return $this;
}

public function getPassword(): ?string
{
return $this->password;
}

public function setPassword(string $password): self
{
$this->password = $password;

return $this;
}

public function getRoles(): ?array
{
return $this->roles;
}

public function setRoles(array $roles): self
{
$this->roles = $roles;

return $this;
}

public function getSalt(): ?string
{
return $this->salt;
}

public function setSalt(?string $salt): self
{
$this->salt = $salt;

return $this;
}

public function getEnabled(): ?bool
{
return $this->enabled;
}

public function setEnabled(?bool $enabled): self
{
$this->enabled = $enabled;

return $this;
}

public function getToken(): ?string
{
return $this->token;
}

public function setToken(?string $token): self
{
$this->token = $token;

return $this;
}

public function getUpdatedAt(): ?\DateTimeInterface
{
return $this->updatedAt;
}

public function setUpdatedAt(\DateTimeInterface $updatedAt): self
{
$this->updatedAt = $updatedAt;

return $this;
}

/**
* Removes sensitive data from the user.
*
* This is important if, at any given point, sensitive information like
* the plain-text password is stored on this object.
*/
public function eraseCredentials()
{
// TODO: Implement eraseCredentials() method.
}

}
