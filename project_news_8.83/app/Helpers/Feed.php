<?php
namespace App\Helpers;

class Feed
{

    public static function read($itemRss)
    {
        $result = [];
        foreach ($itemRss as $value) {
            switch ($value['source']) {
                case 'VnExpress':
                    $result = array_merge_recursive($result, self::ReadVnExpress($value['link']));
                    break;

                case 'ThannNien':
                    $result = array_merge_recursive($result, self::ReadThanhNien($value['link']));
                    break;
            }
        }
        return $result;
    }
    public static function ReadVnExpress($link)
    {

        try {
            $data = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
            $data = json_decode(json_encode($data), true);
            $data = $data['channel']['item'];
            foreach ($data as $key => $value) {
                unset($data[$key]['guid']);
                $thumb = [];
                $description = [];
                preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $value['description'], $thumb);
                preg_match("/<\/a><\/br>(.*)/i", $value['description'], $description);
                $data[$key]['description'] = $description[1];
                $data[$key]['thumb'] = $thumb[1];

            }
            return $data;
        } catch (\Throwable $th) {
            return [];
        }

    }

    public static function ReadThanhNien($link)
    {

        try {
            $data = simplexml_load_file($link, "SimpleXMLElement", LIBXML_NOCDATA);
            $data = json_decode(json_encode($data), true);
            $data = $data['channel']['item'];
     
            foreach ($data as $key => $value) {
                unset($data[$key]['guid']);
                $thumb = [];
                $description = [];
                preg_match('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $value['description'], $thumb);
                preg_match("/<\/a>(.*)/i", $value['description'], $description);
                $data[$key]['description'] = $description[1];
                $data[$key]['thumb'] = $thumb[1];
       
    
            }
            return $data;
        } catch (\Throwable $th) {
            return [];
        }

    }

    public static function getGold()
    {

        $link ='https://sjc.com.vn/xml/tygiavang.xml';
        $data = simplexml_load_file($link);
        $data = json_decode(json_encode($data), true);
        $data = array_column( $data['ratelist']['city'][0]['item'],'@attributes');
        return  $data;

    }

    public static function getCoin()
    {
        $url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
          'start' => '1',
          'limit' => '10',
          'convert' => 'USD'
        ];
        
        $headers = [
          'Accepts: application/json',
          'X-CMC_PRO_API_KEY: 2e80a8cb-d753-4236-897c-55b86c8ed83'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL
        
        
        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
          CURLOPT_URL => $request,            // set the request URL
          CURLOPT_HTTPHEADER => $headers,     // set the headers 
          CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));
        
        $response = curl_exec($curl); // Send the request, save the response
       $data = json_decode($response , true); // print json decoded response
       $data =  $data['data'];
       curl_close($curl); // Close request
      
       $result =[];
       foreach ($data as $key => $value) {
        $result[ $key]['name'] = $value['name'];
        $result[ $key]['price'] = $value['quote']['USD']['price'];
        $result[ $key]['percent_change_24h'] = $value['quote']['USD']['percent_change_24h'];
       }
      
        return $result;
    }

}
