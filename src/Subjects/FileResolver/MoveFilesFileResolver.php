<?php

/**
 * TechDivision\Import\Subjects\FileResolver\MoveFilesFileResolver
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Subjects\FileResolver;

use TechDivision\Import\ApplicationInterface;
use TechDivision\Import\ConfigurationInterface;
use TechDivision\Import\Services\RegistryProcessorInterface;

/**
 * A custom file resolver implementation for the move files subject
 * that try's to load the prefix from the configuration.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import
 * @link      http://www.techdivision.com
 */
class MoveFilesFileResolver extends OkFileAwareFileResolver
{

    /**
     * The configuration instance.
     *
     * @var \TechDivision\Import\ConfigurationInterface
     */
    private $configuration;

    /**
     * Initializes the file resolver with the application and the registry instance.
     *
     * @param \TechDivision\Import\ApplicationInterface                $application       The application instance
     * @param \TechDivision\Import\Services\RegistryProcessorInterface $registryProcessor The registry instance
     * @param \TechDivision\Import\ConfigurationInterface              $configuration     The configuration instance
     */
    public function __construct(
        ApplicationInterface $application,
        RegistryProcessorInterface $registryProcessor,
        ConfigurationInterface $configuration
    ) {

        // pass the application + registry processor to the parent class
        parent::__construct($application, $registryProcessor);

        // set the configuration instance
        $this->configuration = $configuration;
    }

    /**
     * Return's the configuration instance.
     *
     * @return \TechDivision\Import\ConfigurationInterface The configuration instance
     */
    protected function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Returns the file resolver configuration instance.
     *
     * @return \TechDivision\Import\Configuration\Subject\FileResolverConfigurationInterface The configuration instance
     */
    protected function getFileResolverConfiguration()
    {

        // load the file resolver configuration from the parent instance
        $fileResolverConfiguration = parent::getFileResolverConfiguration();

        // use the move files prefix from the configuration
        if ($moveFilesPrefix = $this->getConfiguration()->getMoveFilesPrefix()) {
            $fileResolverConfiguration->setPrefix($moveFilesPrefix);
        }

        // return the customized file resolver configuration
        return $fileResolverConfiguration;
    }
}
