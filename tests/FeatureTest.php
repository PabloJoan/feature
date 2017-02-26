<?php

namespace CafeMedia\Feature\Tests;

use CafeMedia\Feature\Feature;
use PHPUnit\Framework\TestCase;

class FeatureTest extends TestCase
{
    private $feature;

    public function setUp()
    {
        $this->feature = (new Feature([
                                 'testFeature' => [
                                     'description' => 'this is the description',
                                     'enabled' => [
                                         'test1' => 20,
                                         'test2' => 30,
                                         'test3' => 15,
                                         'test4' => 35
                                     ],
                                     'users' => ['user1', 'user2', 'user3'],
                                     'groups' => ['group1', 'group2', 'group3'],
                                     'sources' => ['source1', 'source2'],
                                     'admin' => 'test3',
                                     'internal' => 'test1',
                                     'public_url_override' => true,
                                     'bucketing' => 'random',
                                     'exclude_from' => [
                                         'zips' => [10014, 10023],
                                         'countries' => ['us', 'rd'],
                                         'regions' => ['ny', 'nj', 'ca']
                                     ],
                                     'start' => 20170314,
                                     'end' => 20170530
                                 ]
                             ]))
                             ->addUrl('feature')
                             ->addSource('')
                             ->addUser([
                                 'user-uaid' => 'as54gerfd',
                                 'user-id' => 5,
                                 'user-name' => 'testUserName',
                                 'is-admin' => false,
                                 'user-group' => 'group',
                                 'internal-ip' => false
                             ]);
        $this->assertEquals($this->feature instanceof Feature, true);
    }

    public function testIsEnabled()
    {
        $this->assertEquals($this->feature->isEnabled('testFeature'), false);
    }

    public function testIsEnabledFor()
    {
        $this->assertEquals(
            $this->feature->isEnabledFor(
                'testFeature',
                [
                    'user-uaid' => 'as54gerfd',
                    'user-id' => 5,
                    'user-name' => 'testUserName',
                    'is-admin' => false,
                    'user-group' => 'group',
                    'internal-ip' => false
                ]
            ),
            false
        );
    }

    public function testIsEnabledBucketingBy()
    {
        $this->assertEquals(
            $this->feature->isEnabledBucketingBy('testFeature', 'test'),
            false
        );
    }

    public function testVariant()
    {
        $this->assertEquals($this->feature->variant('testFeature'), 'off');
    }

    public function testVariantFor()
    {
        $this->assertEquals(
            $this->feature->variantFor(
                'testFeature',
                [
                    'user-uaid' => 'as54gerfd',
                    'user-id' => 5,
                    'user-name' => 'testUserName',
                    'is-admin' => false,
                    'user-group' => 'group',
                    'internal-ip' => false
                ]
            ),
            'off'
        );
    }

    public function testVariantBucketingBy()
    {
        $this->assertEquals(
            $this->feature->variantBucketingBy('testFeature', 'test'),
            'off'
        );
    }

    public function testDescription()
    {
        $this->assertEquals(
            $this->feature->description('testFeature'),
            'this is the description'
        );
    }
}
