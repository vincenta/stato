<?php

namespace Stato\Orm;

use Post, MyPost;

require_once __DIR__ . '/../TestsHelper.php';

require_once __DIR__ . '/files/post.php';

class EntityTest extends TestCase
{
    protected $fixtures = array('posts');
    
    public function setup()
    {
        parent::setup();
        Entity::setConnection($this->connection);
    }
    
    public function testPropertyAccess()
    {
        $post = new Post();
        $post->title = 'Test Driven Developement';
        $this->assertEquals('Test Driven Developement', $post->title);
    }
    
    public function testInstanciation()
    {
        $post = new Post(array('title' => 'Test Driven Developement'));
        $this->assertEquals('Test Driven Developement', $post->title);
    }
    
    public function testDefaultValues()
    {
        $post = new Post;
        $this->assertNull($post->title);
    }
    
    public function testGetTableName()
    {
        $this->assertEquals('posts', Post::getTablename());
        $this->assertEquals('posts', MyPost::getTablename());
    }
    
    public function testGet()
    {
        $post = Post::get(1);
        $this->assertEquals('Frameworks : A new hope...', $post->title);
    }
    
    public function testFilterBy()
    {
        $posts = Post::filterBy(array('author' => 'John Doe'))->all();
        $this->assertEquals('Frameworks : A new hope...', $posts[0]->title);
        $this->assertEquals('PHP6 and namespaces', $posts[1]->title);
    }
    
    public function testFilterWithClosure()
    {
        $posts = Post::filter(function($p) { return $p->author->like('%Doe'); });
        $posts = $posts->all();
        $this->assertEquals('Frameworks : A new hope...', $posts[0]->title);
        $this->assertEquals('PHP6 and namespaces', $posts[1]->title);
    }
}