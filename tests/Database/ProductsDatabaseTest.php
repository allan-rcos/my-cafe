<?php

namespace Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Support\Database\Seeds\AppSeeder;
use Tests\Support\Entities\ProductEntity;
use Tests\Support\Models\CategoryModel;
use Tests\Support\Models\ProductModel;

/**
 * @internal
 */
final class ProductsDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $seed = AppSeeder::class;

    public function testSeeders(): void
    {
        $models = self::getModels();

        $categories = $models['category']->findAll();
        $products = $models['product']->findAll();

        self::assertCount(3, $categories);
        self::assertCount(9, $products);
    }

    public function testCategoryIdCast(): void
    {
        $models = self::getModels();

        $categories = $models['category']->findAll();
        $products = $models['product']->findAll();

        self::assertEquals($categories[0]->formated_name(), $products[0]->category->formated_name(), "$categories[0] is different from {$products[0]->category_id}.");
        self::assertEquals($categories[1]->formated_name(), $products[3]->category->formated_name(), "$categories[1] is different from {$products[3]->category_id}.");
        self::assertEquals($categories[2]->formated_name(), $products[6]->category->formated_name(), "$categories[2] is different from {$products[6]->category_id}.");

        $new_product_entity = new ProductEntity([
            'id'          => count($categories),
            'name'        => 'SmartWatch Ultra',
            'price'       => 500,
            'filename'    => 'smartwatch_ultra.png',
            'description' => 'Relógio digital com medição de batimento cardíaco e aprova d\'água' ,
            'category_id' => $categories[0]
        ]);
        $id = $models['product']->insert($new_product_entity);

        $new_product = $models['product']->find($id);

        self::assertEquals($categories[0]->formated_name(), $new_product->category->formated_name(), "$categories[0] is different from $new_product.");

        // Testing Model DataCasts

        $id = $models['product']->insert([
            'name'        => 'SmartWatch Ultra 2',
            'price'       => 500,
            'filename'    => 'smartwatch_ultra.png',
            'description' => 'Relógio digital com medição de batimento cardíaco e aprova d\'água' ,
            'category_id' => $categories[0]
        ]);

        $new_product = $models['product']->find($id);

        $this->assertEquals($categories[0]->formated_name(), $new_product->category->formated_name(), "$categories[0] is different from $new_product.");
    }

    public function testCategoryCascateRemove(): void
    {
        $models = self::getModels();

        // Testing children delete:
        $models['category']->deleteProducts(1);

        self::assertCount(6, $models['product']->findAll());
        self::assertEmpty($models['product']->where('category_id', 1)->first());

        // Testing cascate:
        $models['category']->delete(2);

        self::assertCount(3, $models['product']->findAll());
        self::assertEmpty($models['product']->where('category_id', 2)->first());
        self::assertCount(2, $models['category']->findAll());
    }

    #[DataProvider('categoryValidationProvider')]
    public function testCategoryValidation(array $data, int $count): void
    {
        $models = self::getModels();

        $is_valid = $models['category']->validate($data);
        $validation = $models['category']->validation;

        self::assertTrue($is_valid === false, "Expected false for insert.");
        self::assertCount($count, $validation->getErrors(), "Expected $count for error count.");
    }

    #[DataProvider('productsValidationProvider')]
    public function testProductsValidation(array $data, int $count): void
    {
        $models = self::getModels();

        $is_valid = $models['product']->validate($data);
        $validation = $models['product']->validation;

        self::assertTrue($is_valid === false, "Expected false for insert");
        self::assertCount($count, $validation->getErrors(), "Expected $count for error count.");
    }

    /**
     * @return array{'category': CategoryModel, 'product': ProductModel}
     */
    private static function getModels(): array
    {
        return [
            'category' => new CategoryModel(),
            'product' => new ProductModel()
        ];
    }

    public static function categoryValidationProvider(): array
    {
        return [
            "Category model required" => [
                [
                    'name'        => null,
                    'description' => null
                ],
                2,
            ],
            "Category Model MaxLength" => [
                [
                    'name'        => str_repeat('x', 32),
                    'description' => str_repeat('x', 256)
                ],
                2
            ],
            'Category Model Name' => [
                [
                    'name'        => 'Bolo\'s',
                    'description' => 'Bolos bem macios, que derretem na boca.'
                ],
                1
            ],
            'Category Model MinLength' => [
                [
                    'name'        => 'Kq',
                    'description' => 'Bolos bem macios, que derretem na boca.'
                ],
                1
            ],
            'Category Model IsUnique' => [
                [
                    'name'        => 'Bolos',
                    'description' => 'Bolos bem macios, que derretem na boca.'
                ],
                1
            ]
        ];
    }

    public static function productsValidationProvider(): array
    {
        return [
            'Product Model Required' => [
                [
                    'name'        => null,
                    'price'       => null,
                    'filename'    => null,
                    'description' => null,
                    'category_id' => null
                ],
                5,
            ],
            'Product Model MaxLength and Number' => [
                [
                    'name'        => str_repeat('x', 32),
                    'price'       => 'notANumber',
                    'filename'    => str_repeat('x', 32),
                    'description' => str_repeat('x', 256),
                    'category_id' => 1
                ],
                4
            ],
            'Product Model Name and Zero Price' =>[
                [
                    'name'        => 'C@fé Gel@do Especi@l',
                    'price'       => 0,
                    'filename'    => 'cafe_gelado_espacial.jpg',
                    'description' => 'Refrescante, com toque especial da casa.',
                    'category_id' => 1
                ],
                2
            ],
            'Product Model MinLength' => [
                [
                    'name'        => 'CG',
                    'price'       => 12.,
                    'filename'    => 'cafe_gelado_especial.jpg',
                    'description' => 'Refrescante, com toque especial da casa.',
                    'category_id' => 1
                ],
                1
            ],
            'Product Model IsUnique and CategoryNotExists' => [
                [
                    'name'        => 'Mocha Especial',
                    'price'       => 12.,
                    'filename'    => 'mocha_especial.jpg',
                    'description' => 'Refrescante, com toque especial da casa.',
                    'category_id' => 5
                ],
                2
            ]
        ];
    }
}