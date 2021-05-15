<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ProcessXmlCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:process-xml');
        $commandTester = new CommandTester($command);
        
        $result = $commandTester->execute([
            'file' => 'coffee_feed_test.xml',
        ]);
        
        $this->assertEquals(0, $result);
    }
}
