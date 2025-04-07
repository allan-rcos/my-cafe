<?php

namespace Controller;

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\Files\FileCollection;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\URI;
use CodeIgniter\HTTP\UserAgent;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Tests\Support\Database\Seeds\AppSeeder;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Controllers\Admin\Products;

class ProductsControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;

    protected $seed = AppSeeder::class;

    public function testAuthorize(): void
    {
        $autorize = service('authorize');
        $autorize->isTest = true;

        $this->assertTrue($autorize->isTest);
    }

    #[Depends('testAuthorize')]
    #[DataProvider('viewsProvider')]
    public function testView(string $view)
    {
        $result = $this->controller(Products::class)
            ->execute($view);

        $this->assertTrue($result->isOK());
    }

    #[Depends('testAuthorize')]
    public function testCreateAction()
    {
        $data = [
            'name'        => 'Smartphone X',
            'price'       => 250,
            'filename'    => 'smartwatch_ultra.jpg',
            'description' => 'Relógio digital com medição de batimento cardíaco e aprova d\'água',
            'category_id' => 1
        ];
        $filename = 'burger-1.jpg';
        $request = $this->request;
        $globals = $this->getPrivateProperty($request, 'globals');
        $globals['post'] = $data;
        $_FILES['image'] = ["tmp_name" => PUBLICPATH.'assets/images/'.$filename, "name" => $filename];
        $this->setPrivateProperty( $request, 'globals', $globals );

        $result = $this
            ->withRequest($request)
            ->controller(Products::class)
            ->execute('createAction')
        ;

        $this->assertTrue($result->isRedirect());
        $result->assertSessionMissing('error');
        $result->assertSessionMissing('errors');
        $result->assertSessionHas('message');

        $model = model('products');

        self::assertCount(9, $model->count());
    }

    #[Depends('testAuthorize')]
    public function testEditAction()
    {
        $data = [
            "name" => "Livro Infanto-Juvenil",
            "price" => 29.00,
        ];
        $id = 8;
        $filename = 'burger-1.jpg';
        $request = new IncomingRequest($this->appConfig, new URI($this->uri), userAgent: new UserAgent());
        $globals = $this->getPrivateProperty($request, 'globals');
        $globals['post'] = $data;
        $this->setPrivateProperty( $request, 'globals', $globals );
        $this->setPrivateProperty(
            $this->getPrivateProperty($request, 'files'), 'files',
            [new File(PUBLICPATH.'assets/images/'.$filename)]
        );
        $result = $this
            ->withRequest($request)
            ->controller(Products::class)
            ->execute('editAction', $id);

        $this->assertTrue($result->isRedirect());
        $result->assertSessionMissing('error');
        $result->assertSessionMissing('errors');
        $result->assertSessionHas('message');

        $product = model('products')->find($id);

        self::assertEquals($data['name'], $product->name);
        self::assertEquals($data['price'], $product->price);
        self::assertEquals(strtolower(str_replace(' ', '_', $data['name'])).'.jpg', $product->filename);
    }

    #[Depends('testAuthorize')]
    public function testRemoveAction()
    {
        $result = $this
            ->controller(Products::class)
            ->execute('removeAction', 8)
        ;

        $this->assertTrue($result->isRedirect());
        $result->assertSessionMissing('error');
        $result->assertSessionMissing('errors');
        $result->assertSessionHas('message');

        $model = model('products');

        self::assertCount(8, $model->count());
    }

    public static function viewsProvider(): array
    {
        return [
            'Index view' => 'indexView',
            'Create view' => 'createView',
            'Edit view' => 'editView'
        ];
    }
}