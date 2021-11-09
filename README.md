[![Tests](https://github.com/dennobaby/pathfinder/actions/workflows/tests.yml/badge.svg)](https://github.com/dennobaby/pathfinder/actions/workflows/tests.yml)
# pathfinder

Access and modify arrays or json-documents with path-descriptor.

# Usage & Examples

Let's assume you have this array, potentially much bigger and you don't know if certain paths exist:
```
<?php

use Denno\PathFinder\PathFinder;

$array = [
    'some' => [
        'multi' => [
            'dimensional' => [
                'array' => 'foo',
            ],
        ],
    ],
];
```

Check if a given path exists:
```
echo PathFinder::getPathValue($array, 'some.multi.dimensional.array');
echo PathFinder::getPathValue($array, 'some.multi.nonexisting.key');
```
would return 
```
true
false
```

If you want to modify the value of a given path you could do simply:
```
echo PathFinder::setPathValue($array, 'some.multi.dimensional.array', 'bar');
//would return 'bar'
//let's check it:
echo PathFinder::getPathValue($array, 'some.multi.dimensional.array');
//would return true.

//but a nonexisting path? 
echo PathFinder::setPathValue($array, 'some.multi.nonexisting.key', 'foobar');
//would return false, because the path don't exist!

//but you want it to be created and the value set? No problem:
echo PathFinder::setPathValue($array, 'some.multi.nonexisting.key', 'foobar', true);
//the last parameter, named 'force', will create it for you if set to true and therefor return 'foobar'
```

