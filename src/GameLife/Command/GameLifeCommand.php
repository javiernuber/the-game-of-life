<?php

/*
 * This file is part of the GameLife package.
 * (c) Fco Javier Núñez Berrocoso <javiernuber@gmail.com>
 */

namespace GameLife\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GameLife\Universe;

class GameLifeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('gamelife')
            ->setDescription('Run game of life')
            ->addArgument('dimension', InputArgument::REQUIRED, 'Board dimension')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('---------------------------');
        $output->writeln('Welcome to the game of life');
        $output->writeln('---------------------------');

        $dimension = $input->getArgument('dimension');
        $universe = new Universe($dimension);
        $universe->buildRandomUniverse();
        while (true) {
            echo $universe->paint();
            $universe->envolve();
        }
    }
}