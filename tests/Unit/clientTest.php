<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class clientTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function getAll(): void
    {
        $response = $this->get("/api/client");
        echo "<PRE>";
        print_r($response);
        $response->assertStatus(200);
    }
}
