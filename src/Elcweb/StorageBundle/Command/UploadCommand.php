<?php

namespace Elcweb\StorageBundle\Command;

use DateTime;
use Mercantile\Elending\LoanBundle\Entity\PaymentOverride;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\EventDispatcher\GenericEvent;
use Mercantile\EftBundle\Entity\Eft;

class UploadCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('elcweb:storage:upload')
            ->setDescription('This command ....');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fs = $this->getContainer()->get('data_filesystem');
        $adapter = $fs->getAdapter();

        $kernelDir = $this->getContainer()->get('kernel')->getRootDir();
        $filesDir  = '/data';

        //echo $this->getContainer()->get('kernel')->getRootDir().'/data/loan';
        $path = $kernelDir.$filesDir;

        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        foreach($objects as $name => $object){
            if (basename($name) != '.' && basename($name) != '..' && !is_dir($name)) {
                $filename = str_replace($kernelDir.$filesDir."/", "", $name);

                $output->writeln('<info>' . date('Y-m-d H:i:s') . ' - </info>Upload file: <comment>'.$filename.'</comment>');

                $adapter->write($filename, file_get_contents($name));
            }
        }

    }
}
