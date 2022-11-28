<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AsignacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AsignacionRepository::class)]
#[ApiResource]
class Asignacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'asignacion')]
    private ?Empresa $empresa = null;

    #[ORM\ManyToOne(inversedBy: 'asignacion')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lugar $lugar = null;

    #[ORM\ManyToOne(inversedBy: 'asignacion')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tipo $tipo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $chapa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEmpresa(): ?Empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getLugar(): ?Lugar
    {
        return $this->lugar;
    }

    public function setLugar(?Lugar $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getTipo(): ?Tipo
    {
        return $this->tipo;
    }

    public function setTipo(?Tipo $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getChapa(): ?string
    {
        return $this->chapa;
    }

    public function setChapa(?string $chapa): self
    {
        $this->chapa = $chapa;

        return $this;
    }
}
