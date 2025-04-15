<?php

namespace Database;


namespace Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Support\Database\Seeds\AppSeeder;
use App\Models\DeliveryItemModel;

/**
 * @internal
 */
final class DeliveryItemDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $seed = AppSeeder::class;

    public function testSeeder(): void
    {
        $model = new DeliveryItemModel();

        self::assertCount(3, $model->findAll());
    }

    public function testInsert(): void
    {
        $model = new DeliveryItemModel();

        $model->insert([
            'user_id'     => 0,
            'product_id'  => 2,
            'quantity'    => 2
        ]);

        self::assertCount(4, $model->findAll());
        self::assertCount(2, $model->where('checked_at')->findAll());
    }

    public function testCheckout(): void
    {
        $model = new DeliveryItemModel();
        $user_id = 0;

        self::assertCount(1, $model->where('user_id', $user_id)->where('checked_at')->findAll());
        self::assertCount(2, $model->where('user_id', $user_id)->where('checked_at IS NOT NULL')->findAll());

        $model->checkout($user_id);

        self::assertCount(0, $model->where('user_id', $user_id)->where('checked_at')->findAll());
        self::assertCount(3, $model->where('user_id', $user_id)->where('checked_at IS NOT NULL')->findAll());
    }

    #[DataProvider('validationProvider')]
    public function testValidation(array $data, int $count): void
    {
        $model = new DeliveryItemModel();

        $is_valid =$model->validate($data);
        $validation = $model->validation;

        self::assertTrue($is_valid === false, "Expected false for insert");
        self::assertCount($count, $validation->getErrors(), "Expected $count for error count.");
    }

    public function testCount()
    {
        $model = new DeliveryItemModel();

        $count =  $model->count();

        self::assertEquals(1, $count);
    }

    public function testFindAllTable()
    {
        $model = new DeliveryItemModel();

        $data = $model->findAllTableData();

        self::assertCount(1, $data);
    }

    public function testUpdateMany()
    {
        $model = new DeliveryItemModel();

        $data = $model->where('checked_at IS NOT NULL')->findAll();

        $checked_at   = $data[0]->checked_at;
        $user_id      = $data[0]->user_id;
        $updated_data =  [
            $data[0]->id => $data[0]->quantity + 1,
            $data[1]->id => $data[1]->quantity + 1
        ];

        $success = $model->updateMany($updated_data, $user_id, $checked_at);

        self::assertTrue($success, 'Update many not works.');

        $new_data = $model->where('checked_at IS NOT NULL')->findAll();

        self::assertNotEquals($data[0]->quantity, $new_data[0]->quantity, 'Quantity not changed in item 1');
        self::assertEquals($updated_data[$new_data[0]->id], $new_data[0]->quantity, 'Wrong quantity in item 1.');

        self::assertNotEquals($data[1]->quantity, $new_data[1]->quantity, 'Quantity not changed in item 2');
        self::assertEquals($updated_data[$new_data[1]->id], $new_data[1]->quantity, 'Wrong quantity in item 2.');
    }

    public static function validationProvider(): array
    {
        return [
            'Model Required' => [
                [
                    'user_id'     => null,
                    'product_id'  => null,
                    'quantity'    => null,
                ],
                3,
            ],
            'Model NotANumber' => [
                [
                    'user_id'     => 'notANumber',
                    'product_id'  => 'notANumber',
                    'quantity'    => 'notANumber',
                ],
                3,
            ],
            'Model Not Exists or Zero' => [
                [
                    'user_id'     => 5,
                    'product_id'  => 10,
                    'quantity'    => 0,
                ],
                3,
            ]
        ];
    }
}