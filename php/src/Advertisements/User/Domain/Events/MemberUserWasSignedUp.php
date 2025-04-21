<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\User\Domain\Events;

use Demo\App\Advertisements\User\Domain\MemberUser;
use Demo\App\Common\Domain\DomainEvent;

final readonly class MemberUserWasSignedUp extends DomainEvent
{
    private const string EVENT_TYPE = 'user-signed-up';
    private const string AGGREGATE_TYPE = 'user';
    private const string VERSION = '1.0';

    private function __construct(
        public string  $eventType,
        public string  $version,
        public string  $userId,
        public string  $civicCenterId,
    ) {
        parent::__construct($this->userId, self::AGGREGATE_TYPE);
    }

    public static function create(MemberUser $memberUser): MemberUserWasSignedUp
    {
        return new self(
            self::EVENT_TYPE,
            self::VERSION,
            $memberUser->id()->value(),
            $memberUser->civicCenterId()->value(),
        );
    }
}
