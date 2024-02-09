<?php
require '../../vendor/autoload.php';
/*
if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}
*/
function getClient(){

    $client = new Google_Client();
    $client->setApplicationName('G Suite Directory API PHP Quickstart');
    $client->setScopes(Google_Service_Directory::ADMIN_DIRECTORY_USER_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;

}


    // Get the API client and construct the service object.
    $client = getClient();
    $service = new Google_Service_Directory($client);

    // Print the first 10 users in the domain.
    $optParams = array(
      'customer' => 'my_customer',
      'maxResults' => 500,
      'orderBy' => 'email',
      'query' => 'andres_rodriguezr@cun.edu.co sergio_gamboa@cun.edu.co',
    );

    $results = $service->users->listUsers($optParams);

    $nextPageToken = $results->nextPageToken;


    if (count($results->getUsers()) == 0) {
      
        echo "No existe";

    }else{
      foreach ($results->getUsers() as $user) {


        $email = $user->getPrimaryEmail();
        $ultimo_login = $user->lastLoginTime;
        $nombre = $user->name->fullName;

        $datos_estudiante = array(
            'email' => $email,
            'ultimo_login' => $ultimo_login,
            'nombre' => $nombre
        );


        print_r($datos_estudiante);

      }
    }

