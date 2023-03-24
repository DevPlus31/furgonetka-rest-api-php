<?php

namespace Kwarcek\FurgonetkaRestApi\Test\Unit\Request;

use Kwarcek\FurgonetkaRestApi\Entity\Agreement;
use Kwarcek\FurgonetkaRestApi\Entity\Credential;
use Kwarcek\FurgonetkaRestApi\Request\AccountRequest;
use Kwarcek\FurgonetkaRestApi\Test\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Class AccountRequestTest
 * @package Kwarcek\FurgonetkaRestApi\Test
 */
class AccountRequestTest extends TestCase
{
    protected AccountRequest $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new AccountRequest($this->client);
    }

    public function test_account_request_get_carrier_list(): void
    {
        $response = $this->request->getCarrierList();

        $this->assertEquals(200, $response['code']);
        $this->assertGreaterThan(0, count($response['data']['services']));
    }

    public function test_account_request_get_oauth_data(): void // todo
    {
        $response = $this->request->getOAuthData('');

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_get_account_advanced_settings(): void
    {
        $response = $this->request->getAccountAdvancedSettings();

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('user_reference_number', $response['data']);
    }

    public function test_account_request_get_list_of_shipment_templates(): void
    {
        $response = $this->request->getlistOfShipmentTemplates();

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
    }

    public function test_account_request_get_list_of_entries_in_the_address_book(): void
    {
        $response = $this->request->getListOfEntriesInTheAddressBook();

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
    }

    public function test_account_request_dhl_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->user = '';
        $credentials->password = '';
        $credentials->sap = '';

        $additionalCredentials = new Credential();
        $additionalCredentials->user = '';
        $additionalCredentials->password = '';

        $agreement = new Agreement();
        $agreement->name = '';
        $agreement->credential = $credentials;
        $agreement->serviceId = '';
        $agreement->additionalCredential = $additionalCredentials;

        $response = $this->request->dhlAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_dpd_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->login = '';
        $credentials->password = '';
        $credentials->master_fid = '';

        $additionalCredentials = new Credential();
        $additionalCredentials->login = '';
        $additionalCredentials->password = '';
        $additionalCredentials->master_fid = '';

        $agreement = new Agreement();
        $agreement->name = 'Agreement DPD';
        $agreement->credential = $credentials;
        $agreement->serviceId = '';
        $agreement->additionalCredential = $additionalCredentials;

        $response = $this->request->dpdAgreement($uuid, $agreement);

        sleep(2);

        $this->account_request_agreement_summary($uuid);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_fedex_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->account_number = '';
        $credentials->key = '';

        $additionalCredentials = new Credential();
        $additionalCredentials->account_number = '';
        $additionalCredentials->meter_number = '';
        $additionalCredentials->key = '';
        $additionalCredentials->password = '';

        $agreement = new Agreement();
        $agreement->name = 'Agreement Fedex';
        $agreement->credential = $credentials;
        $agreement->serviceId = null;
        $agreement->additionalCredential = $additionalCredentials;

        $response = $this->request->fedexAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_gls_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->user = '';
        $credentials->password = '';

        $agreement = new Agreement();
        $agreement->name = 'Agreement GLS';
        $agreement->credential = $credentials;
        $agreement->serviceId = null;

        $response = $this->request->glsAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_inpost_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->shipx_client_id = '';
        $credentials->shipx_token = '';
        $credentials->allegro_deal = '';

        $agreement = new Agreement();
        $agreement->name = 'Agreement Inpost';
        $agreement->credential = $credentials;
        $agreement->serviceId = null;

        $response = $this->request->inpostAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_orlen_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->user = '';
        $credentials->password = '';

        $agreement = new Agreement();
        $agreement->name = '';
        $agreement->credential = $credentials;
        $agreement->serviceId = '';

        $response = $this->request->orlenAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_poczta_polska_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->email = '';
        $credentials->password = '';
        $credentials->post_office_id = '';

        $agreement = new Agreement();
        $agreement->name = '';
        $agreement->credential = $credentials;
        $agreement->serviceId = '';

        $response = $this->request->pocztaPolskaAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_ups_agreement(): void //todo
    {
        $uuid = Uuid::uuid4()->toString();

        $credentials = new Credential();
        $credentials->shipper_number = '';
        $credentials->user_id = '';
        $credentials->password = '';

        $agreement = new Agreement();
        $agreement->name = '';
        $agreement->credential = $credentials;
        $agreement->serviceId = '';

        $response = $this->request->upsAgreement($uuid, $agreement);

        $this->assertEquals(200, $response['code']);
    }

    public function account_request_agreement_summary(string $uuid): void //todo
    {
        $response = $this->request->agreementSummary($uuid);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_delete_agreement(): void //todo
    {
        $serviceId = '8800592';

        $response = $this->request->deleteAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
    }

    public function test_account_request_get_dhl_agreement(): void
    {
        $serviceId = '8800600';

        $response = $this->request->getDhlAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_dpd_agreement(): void
    {
        $serviceId = '8800592';

        $response = $this->request->getDpdAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_fedex_agreement(): void
    {
        $serviceId = '8800593';

        $response = $this->request->getFedexAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_gls_agreement(): void
    {
        $serviceId = '8800595';

        $response = $this->request->getGlsAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_inpost_agreement(): void
    {
        $serviceId = '8800597';

        $response = $this->request->getInpostAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_orlen_agreement(): void
    { // todo
        $serviceId = '8800596';

        $response = $this->request->getOrlenAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_poczta_polska_agreement(): void
    {
        $serviceId = '8800596';

        $response = $this->request->getPocztaPolskaAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }

    public function test_account_request_get_ups_agreement(): void
    {
        $serviceId = '8800594';

        $response = $this->request->getUpsAgreement($serviceId);

        $this->assertEquals(200, $response['code']);
        $this->assertLessThan(count($response['data']), 0);
        $this->assertArrayHasKey('credentials',$response['data']);
    }
}
