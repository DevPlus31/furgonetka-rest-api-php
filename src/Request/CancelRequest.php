<?php

namespace Kwarcek\FurgonetkaRestApi\Request;

use Kwarcek\FurgonetkaRestApi\FurgonetkaClient;
use Kwarcek\FurgonetkaRestApi\Traits\ResponseTrait;
use Kwarcek\FurgonetkaRestApi\Exceptions\FurgonetkaApiException;

/**
 * Class CancelRequest
 * @package Kwarcek\FurgonetkaRestApi\Request
 */
class CancelRequest extends Request
{
    use ResponseTrait;

    protected FurgonetkaClient $client;

    public function __construct(FurgonetkaClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uuid
     *
     * @return array{
     *            code: integer,
     *            data: array{
     *              status: string,
     *              datetime_change: string|null,
     *              errors: object[],
     *              uuid: string,
     *              cancel_command_details: object[],
     *             },
     *        }
     * @throws FurgonetkaApiException
     */
    public function cancelPackagesSummary(string $uuid): array
    {
        $response = $this->client->get("/cancel-command/{$uuid}");

        return $this->response($response);
    }

    /**
     * @param string $uuid
     * @param array[] $uuid
     *
     * @return array{
     *            code: integer,
     *            data: array{
     *              uuid: string,
     *             },
     *        }
     * @throws FurgonetkaApiException
     */
    public function cancelPackages(string $uuid, array $packages): array
    {
        $response = $this->client->put(
            "/cancel-command/{$uuid}", [
                'packages' => $packages,
            ]
        );

        return $this->response($response);
    }
}