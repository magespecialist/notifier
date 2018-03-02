<?php
/**
 * Automatically created by MageSpecialist CodeMonkey
 * https://github.com/magespecialist/m2-MSP_CodeMonkey
 */

declare(strict_types=1);

namespace MSP\Notifier\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class Channel extends AbstractExtensibleModel implements
    \MSP\NotifierApi\Api\Data\ChannelInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(\MSP\Notifier\Model\ResourceModel\Channel::class);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * @inheritdoc
     */
    public function setCode($value)
    {
        return $this->setData(self::CODE, $value);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($value)
    {
        return $this->setData(self::NAME, $value);
    }

    /**
     * @inheritdoc
     */
    public function getAdapterCode()
    {
        return $this->getData(self::ADAPTER_CODE);
    }

    /**
     * @inheritdoc
     */
    public function setAdapterCode($value)
    {
        return $this->setData(self::ADAPTER_CODE, $value);
    }

    /**
     * @inheritdoc
     */
    public function getEnabled()
    {
        return $this->getData(self::ENABLED);
    }

    /**
     * @inheritdoc
     */
    public function setEnabled($value)
    {
        return $this->setData(self::ENABLED, $value);
    }

    /**
     * @inheritdoc
     */
    public function getConfigurationJson()
    {
        return $this->getData(self::CONFIGURATION_JSON);
    }

    /**
     * @inheritdoc
     */
    public function setConfigurationJson($value)
    {
        return $this->setData(self::CONFIGURATION_JSON, $value);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(
        \MSP\NotifierApi\Api\Data\ChannelExtensionInterface $extensionAttributes
    ) {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
