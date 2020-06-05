<?php
    namespace App;

    session_start();

    class GoogleAPI {
        public static function getClient() {
            $client = new \Google_Client();
            $client->setApplicationName('Formation Google API');
            $client->addScope("https://www.googleapis.com/auth/spreadsheets");
            $client->setAuthConfig('credentials.json');
            $client->setAccessType('offline');
            $client->setApprovalPrompt("force");
    
            if(isset($_SESSION["access_token"])) {
                $access_token = $_SESSION["access_token"];
                $client->setAccessToken($access_token);
    
                if($client->isAccessTokenExpired()) {
                    $refresh_token = $_COOKIE["refresh_token"];
                    $client->refreshToken($refresh_token);
                }
            } else {
                $authUrl = $client->createAuthUrl();
                header("Location: " . $authUrl);
            }
    
            return $client;
        }

        public static function sheetAppend($id, $range, $values) {
            $client = self::getClient();
    
            $sheet = new \Google_Service_Sheets($client);
    
            $requestBody = new \Google_Service_Sheets_ValueRange([
                "range" => $range,
                "majorDimension" => "ROWS",
                "values" => $values
            ]);
    
            $response = $sheet->spreadsheets_values->append(
                $id,
                $range,
                $requestBody,
                [
                    "valueInputOption" => "USER_ENTERED"
                ]
            );
    
            return $response;
        }
    }