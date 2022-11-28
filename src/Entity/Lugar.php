<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LugarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LugarRepository::class)]
#[ApiResource]
class Lugar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'lugar', targetEntity: Asignacion::class)]
    private Collection $asignacion;

    public function __construct()
    {
        $this->asignacion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Asignacion>
     */
    public function getAsignacion(): Collection
    {
        return $this->asignacion;
    }

    public function addAsignacion(Asignacion $asignacion): self
    {
        if (!$this->asignacion->contains($asignacion)) {
            $this->asignacion->add($asignacion);
            $asignacion->setLugar($this);
        }

        return $this;
    }

    public function removeAsignacion(Asignacion $asignacion): self
    {
        if ($this->asignacion->removeElement($asignacion)) {
            // set the owning side to null (unless already changed)
            if ($asignacion->getLugar() === $this) {
                $asignacion->setLugar(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->getNombre();
    }
}
