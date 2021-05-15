<?php

declare(strict_types=1);

namespace App\Command;

use App\Infrastructure\ArrayData\XmlArrayData;
use App\Infrastructure\Service\GoogleSheetsApiClient;
use Exception;
use Google_Service_Sheets_ValueRange;
use Google_Service_Sheets_BatchUpdateValuesRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Psr\Log\LoggerInterface;

class GoogleSheetsCommand extends Command
{
    protected static $defaultName = 'app:process-xml';
    private $googleApiCredentials;
    private $spreadsheetId;
    private LoggerInterface $logger;

    public function __construct($googleApiCredentials, $spreadsheetId, LoggerInterface $logger)
    {
        parent::__construct();
        $this->googleApiCredentials = $googleApiCredentials;
        $this->spreadsheetId = $spreadsheetId;
        $this->logger = $logger;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'The filename of XML to process.')
            ->setDescription('Process XML into Spreadsheet')
            ->setHelp('This command process XML to Google Spreadsheet...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $service = null;

        try {
            $googleClient = new GoogleSheetsApiClient($this->googleApiCredentials);
            $service = $googleClient->getGoogleSheetsService();
        } catch (Exception $e) {
            $output->write('Google SheetsService failed');
            $this->logger->error($e->getMessage());
        }

        $range = 'A1:S5000';
        $output->writeln([
            'XML Processor',
            '============',
            '',
        ]);
        $output->write('XML will be processed to Google Spreadsheet');

        try {
            // CsvArrayData if csv is as parameter left as alternative data provider
            //   $arrOutput = CsvArrayData::serveArrayData('./public/' . $input->getArgument('file'));
            $arrOutput = XmlArrayData::serveArrayData('./public/' . $input->getArgument('file'));
            $body = $this->createBodyFromData($range, $arrOutput);
            $result = $service->spreadsheets_values->batchUpdate($this->spreadsheetId, $body);
            $output->writeln([
                '',
                "\n",
                printf("%d cells updated.\n", $result->getTotalUpdatedCells()),
                '',
                'XML Processor succeed',
                '============',
                '',
            ]);
        } catch (Exception $e) {
            $output->writeln([
                '',
                'XML Processor Failed',
                '============',
                '',
            ]);
            $this->logger->error($e->getMessage());
        }

        return 0;
    }

    protected function createBodyFromData(
        string $range,
        array $arrOutput
    ): Google_Service_Sheets_BatchUpdateValuesRequest {
        $data = [];
        $data[] = new Google_Service_Sheets_ValueRange([
            'range' => $range,
            'values' => $arrOutput
        ]);
        return new Google_Service_Sheets_BatchUpdateValuesRequest([
            'valueInputOption' => 'RAW',
            'data' => $data
        ]);
    }
}
