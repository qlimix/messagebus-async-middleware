<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

use Qlimix\Serializable\SerializableInterface;

final class AsynchronousMessage
{
    /** @var string */
    private $id;

    /** @var SerializableInterface */
    private $message;

    public function __construct(string $id, SerializableInterface $message)
    {
        $this->id = $id;
        $this->message = $message;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMessage(): SerializableInterface
    {
        return $this->message;
    }
}
