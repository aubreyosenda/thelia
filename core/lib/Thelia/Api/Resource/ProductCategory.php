<?php

namespace Thelia\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Serializer\Annotation\Groups;
use Thelia\Api\Bridge\Propel\Attribute\CompositeIdentifiers;
use Thelia\Api\Bridge\Propel\Attribute\Relation;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/product_categories/{product}/categories/{category}'
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_READ]],
    denormalizationContext: ['groups' => [self::GROUP_WRITE]],
)]
#[CompositeIdentifiers(['category', 'product'])]
class ProductCategory extends AbstractPropelResource
{
    public const GROUP_READ = 'product_categories:read';
    public const GROUP_READ_SINGLE = 'product_categories:read:single';
    public const GROUP_WRITE = 'product_categories:write';

    #[Relation(targetResource: Category::class)]
    #[Groups([self::GROUP_READ, Product::GROUP_READ_SINGLE])]
    private Category $category;

    #[Relation(targetResource: Product::class)]
    #[Groups([self::GROUP_READ])]
    private Product $product;

    #[Groups([self::GROUP_READ, Product::GROUP_READ_SINGLE])]
    private ?bool $defaultCategory = false;

    #[Groups([self::GROUP_READ, Product::GROUP_READ_SINGLE])]
    private int $position;

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): ProductCategory
    {
        $this->category = $category;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): ProductCategory
    {
        $this->product = $product;
        return $this;
    }

    public function getDefaultCategory(): ?bool
    {
        return $this->defaultCategory;
    }

    public function setDefaultCategory(?bool $defaultCategory): ProductCategory
    {
        $this->defaultCategory = $defaultCategory;
        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): ProductCategory
    {
        $this->position = $position;
        return $this;
    }

    public static function getPropelModelClass(): string
    {
       return \Thelia\Model\ProductCategory::class;
    }
}
