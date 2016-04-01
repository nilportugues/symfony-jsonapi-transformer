<?php

namespace NilPortugues\Symfony\JsonApiBundle\Serializer;

use NilPortugues\Api\JsonApi;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

trait JsonApiResponseTrait
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function addHeaders(\Psr\Http\Message\ResponseInterface $response)
    {
        return $response;
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function errorResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Message\ErrorResponse($json)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourceCreatedResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourceCreated($json)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourceDeletedResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourceDeleted($json)));
    }

    /**
     * @param string $type
     * @param string $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourceNotFoundResponse($type, $id)
    {
        $error     = new JsonApi\Server\Errors\NotFoundError($type, $id);
        $error_bag = new JsonApi\Server\Errors\ErrorBag([$error]);

        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourceNotFound($error_bag)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourcePatchErrorResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourcePatchError($json)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourcePostErrorResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourcePostError($json)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourceProcessingResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourceProcessing($json)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function resourceUpdatedResponse($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\ResourceUpdated($json)));
    }

    /**
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function response($json)
    {
        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\Response($json)));
    }

    /**
     * @param string $type
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function unsupportedActionResponse($type)
    {
        $error     = new JsonApi\Server\Errors\InvalidTypeError($type);
        $error_bag = new JsonApi\Server\Errors\ErrorBag([$error]);

        return (new HttpFoundationFactory())
            ->createResponse($this->addHeaders(new JsonApi\Http\Response\UnsupportedAction($error_bag)));
    }
}
