<?php

namespace Tests\Unit;

use Tests\TestCase;

class ClientTest extends TestCase
{
    public function test_client(): void
    {
        //erro ao criar cliente com a validação de telefone
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => 'teste-teste',
            'date_born' => '1987-07-fdsafads',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        //erro ao criar cliente com a data de nascimento errada
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)11111-1111',
            'date_born' => '1987-07-fdsafads',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        // **** sem o nome **** ///
        $arrData = [
            'name' => '',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o nome **** ///

        // **** sem o email **** ///
        $arrData = [
            'name' => 'semeao 1',
            'email' => '',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o email **** ///

        // **** sem o telefone **** ///
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o telefone **** ///

        // **** sem o data de nascimento **** ///
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o data de nascimento **** ///


        // **** sem o sem o endereço **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => '',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o sem o endereço **** /////

        // **** sem o sem o complemento **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => '',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o sem o complemento **** /////


        // **** sem o sem o bairro **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => '',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o sem o bairro **** /////

        // **** sem o sem o cep **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'bairro teste',
            'zip_code' => ''
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'bairro teste',
        ];
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);
        // **** sem o sem o cep **** /////

        // Gera um e-mail aleatório usando o Faker
        $faker = \Faker\Factory::create();
        $randomEmail = $faker->unique()->safeEmail;

        $arrData = [
            'name' => 'semeao 1',
            'email' => $randomEmail,
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->post('api/client',$arrData);
        $data = $response->json();
        $response->assertStatus(201);

        //Error ao criar com o mesmo e-mail
        $response = $this->post('api/client',$arrData);
        $response->assertStatus(403);

        $response = $this->get('/api/client/'.$data['data']['id']);
        $response->assertStatus(200);

        $response = $this->get('/api/client/0');
        $response->assertStatus(500);

        $response = $this->get('/api/client');
        $response->assertStatus(200);

        //erro ao atualiza cliente com a validação de telefone
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => 'teste-teste',
            'date_born' => '1987-07-fdsafads',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        //erro ao atualizar cliente com a data de nascimento errada
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)11111-1111',
            'date_born' => '1987-07-fdsafads',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        // **** sem o nome **** ///
        $arrData = [
            'name' => '',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o nome **** ///

        // **** sem o email **** ///
        $arrData = [
            'name' => 'semeao 1',
            'email' => '',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o email **** ///

        // **** sem o telefone **** ///
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o telefone **** ///

        // **** sem o data de nascimento **** ///
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o data de nascimento **** ///


        // **** sem o sem o endereço **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => '',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'complement' => 'casa',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o sem o endereço **** /////

        // **** sem o sem o complemento **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => '',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'district' => 'Bairro TEst',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o sem o complemento **** /////


        // **** sem o sem o bairro **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => '',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'zip_code' => '12345-000'
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o sem o bairro **** /////

        // **** sem o sem o cep **** /////
        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'bairro teste',
            'zip_code' => ''
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $arrData = [
            'name' => 'semeao 1',
            'email' => 'rafael.semea0@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'bairro teste',
        ];
        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);
        // **** sem o sem o cep **** /////

        $arrData = [
            'name' => 'semeao 1 update',
            'email' => $data['data']['email'],
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'bairro teste',
            "zip_code" => "12345-000"
        ];

        $response = $this->put('/api/client/'.$data['data']['id'],$arrData);
        $response->assertStatus(200);

        $response = $this->delete('/api/client/0');
        $response->assertStatus(500);

        $response = $this->delete('/api/client/'.$data['data']['id']);
        $response->assertStatus(200);

    }
}
