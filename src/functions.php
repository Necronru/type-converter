<?php

namespace Necronru;

function arrayOf($className): string {
    return sprintf('%s[]', $className);
}
