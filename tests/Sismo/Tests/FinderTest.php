<?php

namespace SismoFinder\Tests;

use SismoFinder\Finder;

class FinderTest extends \PHPUnit_Framework_TestCase
{
    public static function getWorkspace()
    {
        return __DIR__.'/../../fixtures/workspace';
    }

    public function testConstructor()
    {
        $finder = new Finder();
        $this->assertInstanceOf('\SismoFinder\Finder', $finder);
        $this->assertEmpty($finder->getProjects());

        $finder = new Finder(array(self::getWorkspace()));
        $this->assertInstanceOf('\SismoFinder\Finder', $finder);
        $this->assertInternalType('array', $finder->getProjects());
    }

    /**
     * @depends testConstructor
     */
    public function testProjectsWithoutWorkspace()
    {
        $finder = new Finder();
        $this->assertEmpty($finder->getProjects());
    }

    /**
     * @depends testConstructor
     */
    public function testAddWorkspace()
    {
        $finder = new Finder();
        $finder->addWorkspace(self::getWorkspace());
        $this->assertInstanceOf('\SismoFinder\Finder', $finder);

        $this->setExpectedException('\InvalidArgumentException');
        $finder->addWorkspace('');
    }

    /**
     * @depends testAddWorkspace
     */
    public function testProjects()
    {
        $finder = new Finder();
        $finder->addWorkspace(self::getWorkspace());

        $projects = $finder->getProjects();

        $this->assertNotEmpty($projects);
        $this->assertInternalType('array', $projects);
        $this->assertEquals(3, count($projects));

        $this->assertEquals('Project A Dist', $projects[0]->getName());
        $this->assertEquals('Project B', $projects[1]->getName());
        $this->assertEquals('Project C', $projects[2]->getName());
    }

    /**
     * @depends testProjects
     */
    public function testDuplicateWorkspace()
    {
        $finder = new Finder();
        $finder->addWorkspace(self::getWorkspace());
        $finder->addWorkspace(self::getWorkspace());
        $projects = $finder->getProjects();

        $this->assertEquals(3, count($projects));
    }

    /**
     * @depends testProjects
     */
    public function testProjectListInConfig()
    {
        $finder = new Finder();
        $finder->addWorkspace(__DIR__.'/../../fixtures/workspace-b');

        $projects = $finder->getProjects();

        $this->assertEquals('Project D Dist', $projects[0]->getName());
        $this->assertEquals('Project D Dist@develop', $projects[1]->getName());
    }

    /**
     * depends testAddWorkspace
     */
    public function testProjectsEmptyWorkspace()
    {
        $tmp = sys_get_temp_dir().'/sismofinder-test';
        mkdir($tmp);

        $finder = new Finder();
        $finder->addWorkspace($tmp);

        $projects = $finder->getProjects();

        $this->assertInternalType('array', $projects);
        $this->assertEmpty($projects);

        rmdir($tmp);
    }
}