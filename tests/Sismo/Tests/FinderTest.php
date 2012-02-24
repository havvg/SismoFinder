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
        $this->assertCount(3, $projects);

        $this->assertProjects(array(
            'Project A Dist',
            'Project B',
            'Project C',
        ), $projects);
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

        $this->assertCount(3, $projects);
    }

    /**
     * @depends testProjects
     */
    public function testProjectListInConfig()
    {
        $finder = new Finder();
        $finder->addWorkspace(__DIR__.'/../../fixtures/workspace-b');

        $projects = $finder->getProjects();

        $this->assertProjects(array(
            'Project D Dist',
            'Project D Dist@develop',
        ), $projects);
    }

    /**
     * @depends testAddWorkspace
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

    /**
     * @depends testProjectListInConfig
     */
    public function testProjectsAreAccessible()
    {
        $finder = new Finder();
        $finder->addWorkspace(__DIR__.'/../../fixtures/workspace-b');

        $projects = $finder->getProjects();

        $this->assertArrayHasKey('Project D Dist', $projects);
        $this->assertArrayHasKey('Project D Dist@develop', $projects);
    }

    protected function assertProjects($expected, $actual)
    {
        $projects = array();
        foreach ($actual as $eachProject) {
            $projects[] = $eachProject->getName();
        }

        foreach ($expected as $eachProjectName) {
            $this->assertTrue(in_array($eachProjectName, $projects), sprintf('The project "%s" has been found.', $eachProjectName));
        }

        $this->assertCount(count($actual), $expected);
    }
}
