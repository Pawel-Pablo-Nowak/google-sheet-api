# Google Sheets API

## Requirements

- PHP 7.4.9

- Google API Account credentials in  **service_key.json**  located in config folder with data as below:


        {
          "type": "service_account",
          "project_id": "XXX",
          "private_key_id": "",
          "private_key": "-----BEGIN PRIVATE KEY----------END PRIVATE KEY-----\n",
          "client_email": "",
          "client_id": "",
          "auth_uri": "https://accounts.google.com/o/oauth2/auth",
          "token_uri": "https://oauth2.googleapis.com/token",
          "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
          "client_x509_cert_url": ""
        }


- Id of newly created empty spreadSheet on docs.google.com as below:

`
https://docs.google.com/spreadsheets/d/{spreadhSheetId}/edit#gid=0`


## Installation:
` composer install`

## Configuration:

- variables in .env:

**GOOGLE_APPLICATION_CREDENTIALS=./config/service_key.json

SPREADSHEET_ID=**

 
## Testing:
`  composer test`
  
  
## Command run:
` php bin/console app:process-xml cofee_feed.xml`

## Result:

After command run data wil be send to Spreadsheet of given SpreadsheetId 

https://drive.google.com/file/d/1ybxnEkZHXuNOaPCpOA-IZB4YJEqfh2XJ/preview

