<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model\AdapterEngine;

interface ParamsValidatorInterface
{
    /**
     * Must:
     *  - Throw an InvalidArgumentException in case of failure
     *  - Return true on success
     *
     * @param array $params
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function execute(array $params): bool;
}
