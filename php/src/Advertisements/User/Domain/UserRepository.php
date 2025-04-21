<?php
declare(strict_types=1);

namespace Demo\App\Advertisements\User\Domain;

use Demo\App\Advertisements\Shared\ValueObjects\CivicCenterId;
use Demo\App\Advertisements\Shared\ValueObjects\UserId;

interface UserRepository
{
    public function findAdminById(UserId $id): ?AdminUser;
    public function findMemberByIdOrFail(UserId $id): MemberUser;
    public function findMemberByIdOrNull(UserId $id): ?MemberUser;
    public function findAdminOrMemberById(UserId $id): AdminUser | MemberUser | null;
    public function usersCountByCivicCenter(CivicCenterId $civicCenterId): int;
    public function saveMember(MemberUser $member): void;
}
