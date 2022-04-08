<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;        // Ajout au moment de la mise en place collection des ingredients
use Doctrine\Common\Collections\Collection;             // Ajout en cas de besoin à l'exemple du bouquin avec catégories
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;      // Ajout en cas de besoin à l'exemple du bouquin avec catégories

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'float')]
    private $price;

    #[Ignore()]
    #[ORM\ManyToOne(targetEntity: Ingredient::class, inversedBy: 'pizzas')]
    private $ingredients;

    // Ajout de la collection des ingredients
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }
    // Ajout à l'exemple du bouquin avec catégories
    //---------------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIngredients(): ?Ingredient //<- Bug des choses à crééer
    {
        return $this->ingredients;
    }

    public function setIngredients(?Ingredient $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection  //<- Bug des choses à crééer
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {  //<- Bug des choses à crééer
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);  //<- Bug des choses à crééer

        return $this;
    }
}
