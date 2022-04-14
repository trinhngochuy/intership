<?php
if (!function_exists('formatDate')) {
    function formatDate($date, string $format = 'd-m-Y')
    {
        if ($date instanceof \Carbon\Carbon) {
            return $date->format($format);
        }
          try {
            $dateFormat = new DateTime($date);
    } catch (Throwable $e) {
        report($e);
        return false;
    }
        return $dateFormat->format($format);
    }
}


if (!function_exists('getImageDataFromUrl')) {
      function getImageDataFromUrl($url)
    {
        $urlParts = pathinfo($url);
        $extension = $urlParts['extension'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($response);
        return $base64;
    }
}
if (!function_exists('getDataURI')) {
function getDataURI($path) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
   return 'data:image/' . $type . ';base64,' . base64_encode($data);
}
}
?>
