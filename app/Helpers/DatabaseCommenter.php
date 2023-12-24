<?php

namespace App\Helpers;

class DatabaseCommenter
{
    public static function setCommentBasedOnEnum($enum): string
    {
        $comment = '';
        foreach ($enum::cases() as $enumCase) {
            $comment .= $enumCase->value.' : '.$enumCase->text().' | ';
        }

        return $comment;
    }
}
