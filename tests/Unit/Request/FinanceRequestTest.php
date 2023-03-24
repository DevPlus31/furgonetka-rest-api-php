<?php

namespace Kwarcek\FurgonetkaRestApi\Test\Unit\Request;

use Kwarcek\FurgonetkaRestApi\Request\FinanceRequest;
use Kwarcek\FurgonetkaRestApi\Test\TestCase;

/**
 * Class FinanceRequestTest
 * @package Kwarcek\FurgonetkaRestApi\Test
 */
class FinanceRequestTest extends TestCase
{
    private FinanceRequest $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new FinanceRequest($this->client);
    }

    public function test_finance_get_list_of_transfers(): void
    {
        $response = $this->request->getListOfTransfers();

        $this->assertEquals(200, $response['code']);
        $this->assertArrayHasKey('transfers', $response['data']);
    }
}
