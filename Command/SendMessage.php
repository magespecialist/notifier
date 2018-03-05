<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Command;

use Magento\Framework\ObjectManagerInterface;
use MSP\NotifierApi\Api\SendMessageInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMessage extends Command
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * SendMessage constructor.
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager
    ) {
        parent::__construct();
        $this->objectManager = $objectManager;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('msp:notifier:send');
        $this->setDescription('Send a notification message');

        $this->addArgument('channel', InputArgument::REQUIRED, 'Channel');
        $this->addArgument('message', InputArgument::REQUIRED, 'Message');

        parent::configure();
    }

    /**
     * @inheritdoc
     * @SuppressWarnings("PHPMD.UnusedFormalParameter")
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $channel = $input->getArgument('channel');
        $message = $input->getArgument('message');

        // @codingStandardsIgnoreStart
        // Must use object manager here
        $sendMessage = $this->objectManager->get(SendMessageInterface::class);
        // @codingStandardsIgnoreEnd

        if ($sendMessage->execute($channel, $message)) {
            $output->writeln('Message sent');
        } else {
            $output->writeln('Could not send message');
        }
    }
}
