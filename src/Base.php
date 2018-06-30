<?php

namespace BrUtils;

class Base
{
    public function clear(string $text): string
    {

        return \preg_replace('/[^0-9]/is', '', $text);
    }

}
