<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

use Qlimix\Serializable\GetNameTrait;
use Qlimix\Serializable\SerializableInterface;

final class AsynchronousMessage implements SerializableInterface
{
    use GetNameTrait;

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
     * @inheritDoc
     */
    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'message' => $this->message->serialize(),
            'messageName' => $this->message->getName()
        ];
    }

    /**
     * @inheritDoc
     */
    public static function deserialize(array $data): SerializableInterface
    {
        return new self($data['id'], $data['name']::deserialize($data['message']));
    }

    /**
     * @return SerializableInterface
     */
    public function getMessage(): SerializableInterface
    {
        return $this->message;
    }
}
