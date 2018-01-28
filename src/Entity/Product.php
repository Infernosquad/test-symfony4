<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    const TYPE_FIRST = 1;
    const TYPE_SECOND = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Name cannot be blank")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Type cannot be blank")
     * @Assert\Choice(
     *      choices = {
     *          Product::TYPE_FIRST,
     *          Product::TYPE_SECOND
     *      },
     *      message = "Choose a valid type."
     * )
     */
    private $type;

    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @TODO add constant in expression
     * @Assert\Expression(
     *    "this.getType() != 1 or value != null",
     *     message="Color cannot be null for this type"
     * )
     */
    private $color;

    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @Assert\Expression(
     *    "this.getType() != 1 or value != null",
     *     message="Texture cannot be null for this type"
     * )
     */
    private $texture;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @Assert\Expression(
     *    "this.getType() != 2 or value != null",
     *     message="Height cannot be null for this type"
     * )
     */
    private $height;

    /**
     * @ORM\Column(type="integer",nullable=true)
     *
     * @Assert\Expression(
     *    "this.getType() != 2 or value != null",
     *     message="Width cannot be null for this type"
     * )
     */
    private $width;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getTexture()
    {
        return $this->texture;
    }

    /**
     * @param string $texture
     */
    public function setTexture($texture)
    {
        $this->texture = $texture;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public static function getTypes()
    {
        return [
            self::TYPE_FIRST,
            self::TYPE_SECOND,
        ];
    }
}
