<?php
/**
 * Copyright © MageSpecialist - Skeeller srl. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace MSP\Notifier\Model;

/**
 * Interface SerializerInterface
 * @package MSP\NotifierApi\Api
 * @api
 */
interface SerializerInterface
{
    /**
     * Serialize value
     * @param array $value
     * @return string
     */
    public function serialize(array $value): string;

    /**
     * Unserialize value
     * @param string $value
     * @return array
     */
    public function unserialize(string $value): array;
}
