<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use Google_Client;
use Google_Service_Sheets;

class GoogleSheetsApiClient
{
    private Google_Client $google;
    private string $googleApiCredentialsPath;

    public function __construct(string $googleApiCredentialsPath)
    {
        $this->googleApiCredentialsPath = $googleApiCredentialsPath;
        $this->google = $this->configure(new Google_Client(), $this->googleApiCredentialsPath);
    }

    public function getGoogleSheetsService(): Google_Service_Sheets
    {
        return new Google_Service_Sheets($this->google);
    }

    private function configure(Google_Client $googleClient, string $googleApiCredentialsPath): Google_Client
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleApiCredentialsPath);
        $googleClient->useApplicationDefaultCredentials();
        $googleClient->setPrompt('select_account consent');
        $googleClient->setIncludeGrantedScopes(true);
        $googleClient->setApplicationName('Google Sheets from XML');
        $googleClient->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $googleClient->setAccessType('offline');

        return $googleClient;
    }
}
