<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProductTest extends TestCase
{

    public function test_product(): void
    {
        // **** tipo do produto diferente de numero **** ///
        $arrData = [
            'type_product_id' => 'TESTE',
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);

        // **** tipo do produto inexistente **** ///
        $arrData = [
            'type_product_id' => 0,
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);

        // **** sem o tipo do produto  **** ///
        $arrData = [
            'type_product_id' => '',
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);
        // **** sem o tipo do produto  **** ///

        // **** sem o nome  **** ///
        $arrData = [
            'type_product_id' => '1',
            'name' => '',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'type_product_id' => 'TESTE',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);
        // **** sem o nome  **** ///

        // **** sem o preço  **** ///
        $arrData = [
            'type_product_id' => 'TESTE',
            'name' => 'Produto teste',
            'price' => '',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'type_product_id' => 'TESTE',
            'name' => 'Produto teste',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);
        // **** sem o preço  **** ///

        // **** sem a foto  **** ///
        $arrData = [
            'type_product_id' => 'TESTE',
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> ""
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'type_product_id' => 'TESTE',
            'name' => 'Produto teste',
            'price' => '5.55'
        ];
        $response = $this->post('api/product',$arrData);
        $response->assertStatus(403);
        // **** sem o preço  **** ///

        $arrData = [
            'type_product_id' => 1,
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->post('api/product',$arrData);
        $data = $response->json();
        $response->assertStatus(201);

        $response = $this->get('/api/product/'.$data['data']['id']);
        $response->assertStatus(200);

        $response = $this->get('/api/product/0');
        $response->assertStatus(500);

        $response = $this->get('/api/product');
        $response->assertStatus(200);

        // **** erro ao atualiza produto sem tipo  **** ///
        $arrData = [
            'type_product_id' => '',
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'Produto teste',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** erro ao atualiza produto sem tipo  **** ///

        // **** erro ao atualiza produto sem nome  **** ///
        $arrData = [
            'type_product_id' => '2',
            'name' => '',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'type_product_id' => '2',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** erro ao atualiza produto sem nome  **** ///

        // **** erro ao atualiza produto sem preço  **** ///
        $arrData = [
            'type_product_id' => '2',
            'name' => 'Update Product',
            'price' => '',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'type_product_id' => '2',
            'name' => 'Update Product',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** erro ao atualiza produto sem preço  **** ///

        // **** erro ao atualiza produto sem foto  **** ///
        $arrData = [
            'type_product_id' => '2',
            'name' => 'Update Product',
            'price' => '5.55',
            "photo"=> ""
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'type_product_id' => '2',
            'name' => 'Update Product',
            'price' => '5.55'
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** erro ao atualiza produto sem foto  **** ///

        $arrData = [
            'type_product_id' => '2',
            'name' => 'Update Product',
            'price' => '5.55',
            "photo"=> "php.jpg"
        ];
        $response = $this->put('/api/product/'.$data['data']['id'],$arrData);
        $response->assertStatus(200);

        $response = $this->delete('/api/product/0');
        $response->assertStatus(500);

        $response = $this->delete('/api/product/'.$data['data']['id']);
        $response->assertStatus(200);

    }
}
