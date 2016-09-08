<?php

namespace Parser\Provader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Cookie\FileCookieJar;
use Parser\Provader\XML;

class ProvaderPageSkHouse extends ProvaderPage
{
    const BASE_URI = 'http://sk-house.ua';
    const COOKIE_FILE = 'brands_parsers/SKHouse/cookie';
    const LOGIN_PAGE = '/Account/Login';
    const USER_AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36';
    const ACCEPT = 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
    const REQUEST_VERIFICATION_TOKEN = 'GCMumsnurw7cNi64lzDE0htTQwr3qTzlxwFlPt-7cPsQl3hNWXDy37DWf7bBPyHw3sVu261pZBEf5pl_Z8JSFPFxs4cizBBKFNxjdKUAAWI1';
    const LOGIN = 'vmakewear';
    const PASS = 'qqqqqqqqq';
    const INIT_COOKIE = 'ASP.NET_SessionId=1w5pao51eylrkbbrsr115lz2; __RequestVerificationToken=d6K773YIRqkoIcQoFEFJ33zuFgOQ33wmqVenJpK3jH1rzVQWQ4GO4ADE7SyWVzAgnJvudPNYydSFXzBLWzqGE-NETDRdqRtpVetH60cP_p81; _ym_uid=1467657322940715375; _ym_isad=2; jv_enter_ts_d2hsfE4AhP=1467657323914; jv_refer_d2hsfE4AhP=http%3A%2F%2Fsk-house.ua%2FAccount%2FLogin; jv_visits_count_d2hsfE4AhP=1; .AspNet.Application=DJ6gHThMCFDQRVzmczVN0aF3wb3j5PH_EJ-kNdPE-l5bIsulViY7KHTv591sef-XRielsB9CkB2oQCQ2eu8P9_onMjmSmcP8UyJ5z7ymC_mAUzfrK4mz0bNxmEcqFQS81zmF9mMUABaXfFxv4M8RoCCCyyXzsziU3Imms0OD18wtgpS0ESExvAXGzwa7hFzZ_G4esIxgQiasgzNdziVRuA; jv_invitation_time_d2hsfE4AhP=1467660950818; _gat=1; _ga=GA1.2.753074821.1467657322; _ym_visorc_23418052=w; jv_pages_count_d2hsfE4AhP=11; jv_gui_state_d2hsfE4AhP=WIDGET';

    /**
     * getWebPAgeFromSkHouse extends ProvaderPage
     * @param string $cookieFile
     */
    public function getWebPage($cookieFile)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $client = new Client([
            'timeout' => 20.0,
            'cookies' => $jar
        ]);
        try {
            $response = $client->request('GET',
                "http://sk-house.ua/Products/SetCurrency?cur=%D0%93%D0%A0%D0%9D",
                [
                    "curl" => [
                        CURLOPT_REFERER => $this->url
                    ]
                ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }
        $this->pageBody = $response ? $response->getBody()->getContents() : null;
        $this->statusCode = $response ? $response->getStatusCode() : 'none';
        $this->reason = $response ? $response->getReasonPhrase() : 'none';

    }

    public function login()
    {
        $jar = new FileCookieJar('brands_parsers/SKHouse/cookie', true);
        $jar->clear();

        $client = new Client(
            array(
                'timeout' => 100.0,
                'cookies' => $jar,
                'base_uri' => self::BASE_URI,
            )
        );

        try {
            $client->request(
                'POST',
                'http://sk-house.ua/Account/Login?ReturnUrl=',
                [
                    'form_params' => [
                        '__RequestVerificationToken' => self::REQUEST_VERIFICATION_TOKEN,
                        'UserName' => self::LOGIN,
                        'Password' => self::PASS,
                    ],
                    'headers' => [
                        'User-Agent' => self::USER_AGENT,
                        'Accept' => self::ACCEPT,
                        'Referer' => self::BASE_URI . self::LOGIN_PAGE,
                        'Cookie' => self::INIT_COOKIE,
                    ]
                ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
        }

        return $this;
    }

    public function getXML()
    {
        $jar = new FileCookieJar(self::COOKIE_FILE, true);

        $client = new Client(
            array(
                'timeout' => 70.0,
                'cookies' => $jar,
            )
        );

        try {
            $response = $client->request('GET', XML::XML_URL_SK_HOUSE, [
                'headers' => [
                    'User-Agent' => self::USER_AGENT,
                    'Accept' => self::ACCEPT,
                    'Referer' => self::BASE_URI,
                ]
            ]);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        if ($response && 200 === $response->getStatusCode()) {
            $xml = $response
                ->getBody()
                ->getContents();
            file_put_contents(XML::XML_FILE_PATH_SK_HOUSE, $xml);
        }

        return $this;
    }

    public function convertXMLtoJSON()
    {
        $xmlSkHouse = new XML();
        $xmlSkHouse->getDataFromXML(XML::XML_FILE_PATH_SK_HOUSE);

        $products = array();

        foreach ($xmlSkHouse->xml->shop->offers->offer as $item) {
            $cod = $item->vendorCode->__toString();
            $products[$cod] = json_decode(json_encode($item), true);
        }

        file_put_contents(XML::JSON_FILE_PATH_SK_HOUSE, json_encode($products));
    }
}
