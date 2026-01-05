<?php

namespace SimpleBus\Serialization\Tests\Message\Envelope;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SimpleBus\Serialization\Envelope\DefaultEnvelope;
use SimpleBus\Serialization\Envelope\DefaultEnvelopeFactory;
use SimpleBus\Serialization\Tests\Fixtures\DummyMessage;

class DefaultEnvelopeFactoryTest extends TestCase
{
    #[Test]
    public function itCreatesADefaultMessageEnvelope(): void
    {
        $factory = new DefaultEnvelopeFactory();

        $message = new DummyMessage();
        $envelope = $factory->wrapMessageInEnvelope($message);
        $this->assertInstanceOf(DefaultEnvelope::class, $envelope);
        $this->assertSame(get_class($message), $envelope->messageType());
        $this->assertSame($message, $envelope->message());
    }

    #[Test]
    public function itReturnsTheClassOfTheDefaultMessageEnvelope(): void
    {
        $factory = new DefaultEnvelopeFactory();

        $defaultEnvelopeClass = DefaultEnvelope::class;
        $this->assertSame($defaultEnvelopeClass, $factory->envelopeClass());
    }
}
