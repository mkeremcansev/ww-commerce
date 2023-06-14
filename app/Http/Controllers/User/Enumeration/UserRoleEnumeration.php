<?php

namespace App\Http\Controllers\User\Enumeration;

abstract class UserRoleEnumeration
{
    const ADMINISTRATOR_ROLE = 'Administrator';

    const MODERATOR_ROLE = 'Moderator';

    const CUSTOMER_REPRESENTATIVE_ROLE = 'Customer Representative';

    const MEMBER_ROLE = 'Member';
}
