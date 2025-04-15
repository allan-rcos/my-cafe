<?php

namespace Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Support\Database\Seeds\AppSeeder;
use Tests\Support\Models\BookModel;

/**
 * @internal
 */
final class BookDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $seed = AppSeeder::class;

    public function testSeeder(): void
    {
        $model = new BookModel();

        self::assertCount(2, $model->findAll());
    }

    public function testInsert(): void
    {
        $model = new BookModel();

        $model->insert([
            'user_id'  => 0,
            'datetime' => (new \DateTime('tomorrow 18:00'))->format('Y-m-d H:i:s'),
            'message'  => 'Boa noite! A mesa no canto, aquela com banco estofado, bem confortável!'
        ]);

        self::assertCount(3, $model->findAll());
    }

    #[DataProvider('validationProvider')]
    public function testValidation(array $data, int $count): void
    {
        $model = new BookModel();

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
                    'datetime'    => null,
                    'message'     => null,
                ],
                3
            ],
            'Model NotANumber and MaxLength' => [
                [
                    'user_id'     => 'notANumber',
                    'datetime'    => (new \DateTime('tomorrow 18:00'))->format('Y-m-d H:i:s'),
                    'message'     => str_repeat('x', 260)
                ],
                2
            ]
        ];
    }
}