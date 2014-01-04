<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @category Piwik_Plugins
 * @package CoreConsole
 */

namespace Piwik\Plugins\CoreConsole\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package CoreConsole
 */
class GenerateApi extends GeneratePluginBase
{
    protected function configure()
    {
        $this->setName('generate:api')
            ->setDescription('Adds an API to an existing plugin')
            ->addOption('pluginname', null, InputOption::VALUE_REQUIRED, 'The name of an existing plugin which does not have an API yet');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pluginName = $this->getPluginName($input, $output);

        $exampleFolder  = PIWIK_INCLUDE_PATH . '/plugins/ExamplePlugin';
        $replace        = array('ExamplePlugin' => $pluginName);
        $whitelistFiles = array('/API.php');

        $this->copyTemplateToPlugin($exampleFolder, $pluginName, $replace, $whitelistFiles);

        $this->writeSuccessMessage($output, array(
             sprintf('API.php for %s generated.', $pluginName),
             'You can now start adding API methods',
             'Enjoy!'
        ));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return array
     * @throws \RunTimeException
     */
    protected function getPluginName(InputInterface $input, OutputInterface $output)
    {
        $pluginNames = $this->getPluginNamesHavingNotSpecificFile('API.php');
        $invalidName = 'You have to enter the name of an existing plugin which does not already have an API';

        return parent::getPluginName($input, $output, $pluginNames, $invalidName);
    }

}