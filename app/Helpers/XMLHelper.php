<?php

namespace App\Helpers;

class XMLHelper
{
    public static function convertArrayToXml(array $data, \SimpleXMLElement $xml = null): bool|string
    {
        if ($xml === null) {
            $xml = new \SimpleXMLElement('<root/>');
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                self::convertArrayToXml($value, $xml->addChild(is_numeric($key) ? "item$key" : $key));
            } else {
                $formattedValue = is_bool($value) ? ($value ? '1' : '0') : htmlspecialchars($value);
                $xml->addChild(is_numeric($key) ? "item$key" : $key, $formattedValue);
            }
        }

        return $xml->asXML();
    }
}
