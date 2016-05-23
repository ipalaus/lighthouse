<?php

namespace Nuwave\Relay\Tests\Config;

use Nuwave\Relay\Tests\TestCase;
use GraphQL\Type\Definition\ObjectType;

class GraphQLFileConfigTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('relay.schema.register', __DIR__ . '/../Support/schema.php');
    }

    /**
     * @test
     */
    public function itCanRegisterTypesWithSchemaFile()
    {
        $graphql = app('graphql');
        $this->assertInstanceOf(ObjectType::class, $graphql->type('userConfig'));
        $this->assertContains('userQueryConfig', $graphql->queries()->keys());
        $this->assertContains('updateEmailConfig', $graphql->mutations()->keys());
    }
}
