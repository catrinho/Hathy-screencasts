<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My RSS Reader</title>
</head>
<body>
    <form>
            Enter feed URL here: <input name="feed_url"/>
            <input type="submit" value="Read"/>
        </form>

        <?php
           //if (isset($_REQUEST['feed_url'])) {

                require './vendor/autoload.php';
                $myClient = new GuzzleHttp\Client([
                     // Base URI is used with relative requests
                    'base_uri' => 'http://www.diarioinsular.com',
                    'headers' => ['User-Agent'=>'MyReader']
                ]);
                    $feedResponse= $myClient->request('POST', '/?cmd=noticia&id=75328',[
                        'form_params' => [
                            'nome' => '1007',
                            'chave' => '204911',
                            'action' => 'login'
                            ],
                            'cookies' => true
                    ]);
                    //$feedResponse = $myClient->request('GET', 'rss/iphone.asp');
                    echo $feedResponse->getStatusCode();

                //$feedResponse = $myClient->request('GET', $_REQUEST['feed_url']);

                // if ($feedResponse->getStatusCode() == 200) { // HTTP OK
                    if ($feedResponse->hasHeader('content-length')) {
                        $contentLength = $feedResponse->getHeader('content-length')[0];
                        echo "<p> Downloaded $contentLength bytes of data. </p>";
                    }

                      $body = $feedResponse->getBody();
                //     $xml = new SimpleXMLElement($body);

                //     // foreach($xml->channel->item as $item) {
                //     //     echo "<h3>" . $item->title . "</h3>";
                //     //     echo "<p>" . $item->description . "</p>";
                //     // }

                //     print_r($xml->channel);
                // }
           //}
        ?>
      
</body>
</html>