<?php

namespace Tests\Unit;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_order(): void
    {
        // **** Sem o cliente ou diferente de numero **** ///
        $arrData = [
            'client_id' => '',
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'client_id' => 0,
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'client_id' => 'TESTE',
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);
        // **** Sem o cliente **** ///


        // **** Sem o produto  ou diferente de numero ou quantidade inexistente **** ///
        $arrData = [
            'client_id' => 1,
            'products' =>  [
                [
                    'id' => '',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'client_id' => 1,
            'products' =>  [
                [
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'client_id' => 1,
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => ''
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'client_id' => 1,
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => 'TESTE'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);

        $arrData = [
            'client_id' => 1,
            'products' =>  [
                [
                    'id' => '1teste',
                    'quantity' => '1'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];
        $response = $this->post('api/order',$arrData);
        $response->assertStatus(403);
        // **** Sem o produto  ou diferente de numero ou quantidade inexistente **** ///

        $arrData = [
            'client_id' => 1,
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '5'
                ]
            ]
        ];

        $response = $this->post('api/order',$arrData);
        $data = $response->json();
        $response->assertStatus(200);

        $response = $this->get('/api/order/'.$data['data']['id']);
        $response->assertStatus(200);

        $response = $this->get('/api/order/0');
        $response->assertStatus(500);

        $response = $this->get('/api/order');
        $response->assertStatus(200);

        $arrData = [
            'name' => 'semeao 1 update',
            'email' => 'rafael.semea100'. $data['data']['id']+1 .'@teste.com',
            'phone' => '(11)96391-8459',
            'date_born' => '1987-07-13',
            'address' => 'Rua do teste',
            'complement' => 'casa',
            'district' => 'bairro teste',
            "zip_code" => "12345-000"
        ];

        $response = $this->post('api/client',$arrData);
        $dataNewClient = $response->json();
        $response->assertStatus(201);

        $arrData = [
            'client_id' => $dataNewClient['data']['id'],
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '58'
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(200);

        //sem cliente
        $arrData = [
            'client_id' => '',
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '58'
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        //sem cliente
        $arrData = [
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => '58'
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        //sem produto
        $arrData = [
            'client_id' => $dataNewClient['data']['id'],
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '',
                    'quantity' => '58'
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        //sem produto
        $arrData = [
            'client_id' => $dataNewClient['data']['id'],
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'quantity' => '58'
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        //sem quantidade
        $arrData = [
            'client_id' => $dataNewClient['data']['id'],
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4',
                    'quantity' => ''
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        //sem quantidade
        $arrData = [
            'client_id' => $dataNewClient['data']['id'],
            'products' =>  [
                [
                    'id' => '1',
                    'quantity' => '2'
                ],
                [
                    'id' => '4'
                ]
            ]
        ];

        $response = $this->put('api/order/'.$data['data']['id'],$arrData);
        $response->assertStatus(403);

        $response = $this->delete('/api/order/0');
        $response->assertStatus(500);

        $response = $this->delete('/api/order/'.$data['data']['id']);
        $response->assertStatus(200);
    }
}
