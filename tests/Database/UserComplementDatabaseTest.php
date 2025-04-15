<?php

namespace Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Support\Database\Seeds\AppSeeder;
use Tests\Support\Models\UserComplementModel;

/**
 * @internal
 */
final class UserComplementDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $seed = AppSeeder::class;

    public function testSeeders(): void
    {
        $model = new UserComplementModel();

        self::assertCount(3, $model->findAll());
    }

    public function testInsert(): void
    {
        $model = new UserComplementModel();

        $model->insert([
            'user_id' => 4,
            'name'    => 'CodeIgnitério da Silva',
            'photo'   => 'codeigniterio_da_silva.user.png',
            'phone'   => '00123456789',
            'address' => 'Rua Joao da Silva - 123 - Maria Jose - Capital (ML)'
        ]);

        self::assertCount(4, $model->findAll());
    }

    #[DataProvider('validationProvider')]
    public function testValidation(array $data, int $count): void
    {
        $model = new UserComplementModel();

        $is_valid =$model->validate($data);
        $validation = $model->validation;

        self::assertTrue($is_valid === false, "Expected false for insert");
        self::assertCount($count, $validation->getErrors(), "Expected $count for error count.");
    }

    public static function validationProvider(): array
    {
        return [
            'Model Required' => [
                [
                    'user_id'     => null,
                    'name'        => null,
                    'photo'       => null,
                    'phone'       => null,
                    'address'     => null
                ],
                5,
            ],
            'Model MaxLength and Number' => [
                [
                    'user_id'     => 'notANumber',
                    'name'        => str_repeat('x', 61),
                    'photo'       => 'codeigniterio_da_silva.user.png',
                    'phone'       => str_repeat('x', 12),
                    'address'     => str_repeat('x', 260)
                ],
                4
            ],
            'Model Name wrong, Phone and id not unique' =>[
                [
                    'user_id'     => 2,
                    'name'        => str_repeat('?', 31),
                    'photo'       => 'codeigniterio_da_silva.user.png',
                    'phone'       => str_repeat('x', 11),
                    'address'     => 'Rua Joao da Silva - 123 - Maria Jose - Capital (ML)'
                ],
                3
            ],
            'Model MinLength' => [
                [
                    'user_id'     => 4,
                    'name'        => str_repeat('x', 2),
                    'photo'       => 'codeigniterio_da_silva.user.png',
                    'phone'       => str_repeat('x', 10),
                    'address'     => 'Rua Joao da Silva - 123 - Maria Jose - Capital (ML)'
                ],
                2
            ],
        ];
    }
}