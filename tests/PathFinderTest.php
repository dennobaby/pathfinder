<?php

namespace Denno\PathFinderTests;

use Denno\PathFinder\PathFinder;
use PHPUnit\Framework\TestCase;

final class PathFinderTest extends TestCase
{
    private $array = [
        'some' => [
            'deep' => [
                'path' => 4,
            ],
            'other' => [
                'very' => [
                    'deep' => [
                        'path' => 6
                    ]
                ]
            ]
        ],
        'other' => [
            'level',
            'other' => [
                'level' => [
                    'in' => [
                        'this',
                        [
                            'test' => [
                                'array' => 'some string'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    public function testFind_1()
    {
        $this->assertEquals(4, PathFinder::getPathValue($this->array, 'some.deep.path'));
    }

    public function testFind_2()
    {
        $this->assertEquals(6, PathFinder::getPathValue($this->array, 'some.other.very.deep.path'));
    }

    public function testFind_3()
    {
        $this->assertEquals('some string', PathFinder::getPathValue($this->array, 'other.other.level.in.1.test.array'));
    }

    public function testFind_4()
    {
        $this->assertEquals(
            ['this', [
                'test' => [
                    'array' => 'some string'
                ]
            ]],
            PathFinder::getPathValue($this->array, 'other.other.level.in')
        );
    }

    public function testSet_1()
    {
        PathFinder::setPathValue($this->array, 'some.deep.path', 34);
        $this->assertEquals(34, PathFinder::getPathValue($this->array, 'some.deep.path'));
    }

    public function testCombination_1()
    {
        $sub = [
            'this',
            'that' => [
                'test' => [
                    'array' => 'some string'
                ]
            ]
        ];

        PathFinder::setPathValue(
            $this->array,
            'other.other.level.in',
            $sub
        );

        $this->assertEquals(
            $sub,
            PathFinder::getPathValue($this->array, 'other.other.level.in')
        );
    }

}