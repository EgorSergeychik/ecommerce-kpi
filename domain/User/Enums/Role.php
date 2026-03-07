<?php

namespace Domain\User\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}
