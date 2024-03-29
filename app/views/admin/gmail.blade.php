<html>
<head>
    <meta name="robots" content="noindex" />
    <title>Email address list - Import Gmail or Google contacts</title>
    <style type="text/css">
        a:link {color:Chocolate;text-decoration: none;}
        a:hover {color:CornflowerBlue;}
        .logo{width:100%;height:110px;border:2px solid black;background-color:#666666;}
    </style>
</head>
<body>
<div class="logo" >
    <div align="center" >
        <a  style="font-size:25px;font-weight:bold;" href="https://accounts.google.com/o/oauth2/auth?client_id=your_client_id_goes_here&redirect_uri=your_redirest_urls_goes_here&scope=https://www.google.com/m8/feeds/&response_type=code">Click here to Import Gmail Contacts</a>
    </div>
</div>
<br/>

<br/>
<div style="padding-left: 50px;">
    <?php
    $client_id='1076007705119-tidu3379njiav4up0pdoi8tiu0259rjk.apps.googleusercontent.com';
    $client_secret='m9FPBiMpyIRVtUZhvz4lZbF9';
    $redirect_uri='https://www.example.com/oauth2callback';
    $max_results = 25;

    $auth_code = $_GET["code"];

    function curl_file_get_contents($url)
    {
        $curl = curl_init();
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

        curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.

        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
        curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);	//To stop cURL from verifying the peer's certificate.

        $contents = curl_exec($curl);
        curl_close($curl);
        return $contents;
    }

    $fields=array(
        'code'=>  urlencode($auth_code),
        'client_id'=>  urlencode($client_id),
        'client_secret'=>  urlencode($client_secret),
        'redirect_uri'=>  urlencode($redirect_uri),
        'grant_type'=>  urlencode('authorization_code')
    );
    $post = '';
    foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
    $post = rtrim($post,'&');

    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
    curl_setopt($curl,CURLOPT_POST,5);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,FALSE);
    $result = curl_exec($curl);
    curl_close($curl);

    $response =  json_decode($result);
    $accesstoken = $response->access_token;

    $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
    $xmlresponse =  curl_file_get_contents($url);
    if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0)) //At times you get Authorization error from Google.
    {
        echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
        exit();
    }
    echo "<h3>email Addresses:</h3>";
    $xml =  new SimpleXMLElement($xmlresponse);
    $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
    $result = $xml->xpath('//gd:email');

    foreach ($result as $title) {
        echo $title->attributes()->address . "<br>";
    }
    ?>
</div>
</body></html>