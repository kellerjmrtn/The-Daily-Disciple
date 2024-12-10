<?php

namespace App\Enum;

enum Status: string
{
    case PUBLISHED = 'published';
    case UNPUBLISHED = 'unpublished';
    case DRAFT = 'draft';
}