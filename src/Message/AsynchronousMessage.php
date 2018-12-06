<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

use Qlimix\Serialize\SerializableInterface;

final class AsynchronousMessage
{
    /** @var string */
    private $id;

    /** @var SerializableInterface */
    private $message;

    /**
     * @param string $id
     * @param SerializableInterface $message
     */
    public function __construct(string $id, SerializableInterface $message)
    {
        $this->id = $id;
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return SerializableInterface
     */
    public function getMessage(): SerializableInterface
    {
        return $this->message;
    }
}
