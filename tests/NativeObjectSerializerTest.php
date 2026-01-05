<?php

namespace SimpleBus\Serialization\Tests;

use LogicException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SimpleBus\Serialization\Envelope\DefaultEnvelope;
use SimpleBus\Serialization\NativeObjectSerializer;
use SimpleBus\Serialization\Tests\Fixtures\AnotherDummyMessage;
use SimpleBus\Serialization\Tests\Fixtures\DummyMessage;

class NativeObjectSerializerTest extends TestCase
{
    #[Test]
    public function itCanSerializeAndDeserializeADefaultMessageEnvelopeWithASerializedMessage(): void
    {
        $originalEnvelope = DefaultEnvelope::forSerializedMessage(
            DummyMessage::class,
            'serialized message'
        );
        $serializer = new NativeObjectSerializer();

        $serializedEnvelope = $serializer->serialize($originalEnvelope);
        $deserializedEnvelope = $serializer->deserialize($serializedEnvelope, get_class($originalEnvelope));
        $this->assertEquals($originalEnvelope, $deserializedEnvelope);
    }

    #[Test]
    public function itFailsWhenTheDeserializedObjectIsOfTheWrongType(): void
    {
        $expectedType = DummyMessage::class;
        $message = new AnotherDummyMessage();
        $serializer = new NativeObjectSerializer();
        $serializedMessage = $serializer->serialize($message);

        $this->expectException(LogicException::class);
        $serializer->deserialize($serializedMessage, $expectedType);
    }
}
