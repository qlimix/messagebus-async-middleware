<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Queue\Envelope;

use Qlimix\Queue\Envelope\EnvelopeInterface;
use Qlimix\Serialize\SerializableInterface;

final class AsyncEnvelope implements EnvelopeInterface
{
    /** @var string */
    private $route;

    /** @var SerializableInterface */
    private $message;

    /**
     * @param string $route
     * @param SerializableInterface $message
     */
    public function __construct(string $route, SerializableInterface $message)
    {
        $this->route = $route;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): SerializableInterface
    {
        return $this->message;
    }
}
