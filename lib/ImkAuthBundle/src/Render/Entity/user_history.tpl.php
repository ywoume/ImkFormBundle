<?php echo "<?php "; ?>

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\UsersHistoryRepository")
*/
class UsersHistory
{

/**
* @ORM\Id()
* @ORM\GeneratedValue()
* @ORM\Column(type="integer")
*/
private $id;

/**
* @ORM\Column(type="string", length=255)
*/
private $session�;

/**
* @ORM\Column(type="datetime", nullable=true)
*/
private $at;

/**
* @ORM\Column(type="string", length=20)
*/
private $ip;

/**
* @ORM\Column(type="string", length=255)
*/
private $os;

/**
* @ORM\Column(type="string", length=255)
*/
private $nav;

public function getId(): ?int
{
return $this->id;
}

public function getSession�(): ?string
{
return $this->session�;
}

public function setSession�(string $session�): self
{
$this->session� = $session�;

return $this;
}

public function getAt(): ?\DateTimeInterface
{
return $this->at;
}

public function setAt(?\DateTimeInterface $at): self
{
$this->at = $at;

return $this;
}

public function getIp(): ?string
{
return $this->ip;
}

public function setIp(string $ip): self
{
$this->ip = $ip;

return $this;
}

public function getOs(): ?string
{
return $this->os;
}

public function setOs(string $os): self
{
$this->os = $os;

return $this;
}

public function getNav(): ?string
{
return $this->nav;
}

public function setNav(string $nav): self
{
$this->nav = $nav;

return $this;
}
}
