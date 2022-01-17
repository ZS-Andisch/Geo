<?php

namespace Foxliscom\Geo\Services;

use Foxliscom\Geo\Factories\FoxlisGeoAccountFactory;
use Foxliscom\Geo\Factories\FoxlisGeoFactory;

class FoxlisGeoService
{
    private $foxlisGeoFactory;
    private $foxlisGeoAccountFactory;

    private $options;

    private $apiDataGeo = [];
    private $apiDataAccount = [];

    public function __construct(array $options)
    {
        $this->options = $options;

        $this->foxlisGeoFactory = new FoxlisGeoFactory();
        $this->foxlisGeoAccountFactory = new FoxlisGeoAccountFactory();
    }

    public function getFoxlisGeo()
    {
        if ($this->isVisitorBot()) {
            return $this->foxlisGeoFactory->getFoxlisGeoEntity()->setOptions($this->options);
        }

        if (empty($data = $this->getVisitorGeoFromSession())) {
            $data = $this->getVisitorGeo();
        }

        return $this->foxlisGeoFactory->getFoxlisGeoEntity()->setOptions($this->options)->setData($data);
    }

    public function getFoxlisGeoAccount()
    {
        return $this->foxlisGeoAccountFactory->getFoxlisGeoAccountEntity()->setData($this->getAccountData());
    }

    private function isVisitorBot()
    {
        if (empty($this->options['foxlis_geo_field_bot_filter'])) {
            return false;
        }

        if (empty($agent = trim($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }

        $bots = $this->options['foxlis_geo_bots_list'];

        foreach ($bots as $bot) {
            if (strpos(strtolower($agent), strtolower($bot)) !== false) {
                return true;
            }
        }

        return false;
    }

    private function getVisitorGeoFromSession()
    {
        $sessionData = [];

        if (empty($this->options['foxlis_geo_field_session'])) {
            return $sessionData;
        }

        if (isset($_SESSION['foxlis_geo_data'])) {
            $sessionData = unserialize($_SESSION['foxlis_geo_data']);
        }

        return $sessionData;
    }

    private function getVisitorGeo()
    {
        if ($this->apiDataGeo) {
            return $this->apiDataGeo;
        }

        $requestGeoTimeout = isset($this->options['foxlis_geo_field_request_geo_timeout'])
            ? $this->options['foxlis_geo_field_request_geo_timeout']
            : '';

        $protocol = $this->options['foxlis_geo_field_protocol'];

        if (
        empty($content = @file_get_contents(
            "{$protocol}://geo.foxlis.com/get-geo-by-ip/{$this->getVisitorIp()}",
            0,
            stream_context_create(["http" => ["timeout" => $requestGeoTimeout]])
        ))
        ) {
            return [];
        }

        $outputArray = json_decode($content, true);

        if (is_array($outputArray)) {
            $_SESSION['foxlis_geo_data'] = serialize($outputArray);
            return $this->apiDataGeo = $outputArray;
        }

        return [];
    }

    private function getVisitorIp()
    {
        $isFakeIp = isset($this->options['foxlis_geo_field_development_fake_ip_enable'])
            ? $this->options['foxlis_geo_field_development_fake_ip_enable']
            : '';

        if ($isFakeIp) {
            return isset($this->options['foxlis_geo_field_development_fake_ip'])
                ? $this->options['foxlis_geo_field_development_fake_ip']
                : '';
        }

        $ipaddress = null;
        if (!empty($_SERVER["HTTP_DO_CONNECTING_IP"])) {
            $ipaddress = $_SERVER["HTTP_DO_CONNECTING_IP"];
        } else if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ipaddress = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }

        return $ipaddress;
    }

    private function getAccountData()
    {
        if ($this->apiDataAccount) {
            return $this->apiDataAccount;
        }

        $requestAccountTimeout = isset($this->options['foxlis_geo_field_request_account_timeout'])
            ? $this->options['foxlis_geo_field_request_account_timeout']
            : '';

        $account = isset($this->options['foxlis_geo_field_account']) ? $this->options['foxlis_geo_field_account'] : '';

        if (
            empty($account)
            ||
            empty($content = @file_get_contents(
                "https://geo.foxlis.com/account/{$account}",
                0,
                stream_context_create(["http" => ["timeout" => $requestAccountTimeout]])
            ))
        ) {
            return [];
        }

        $outputArray = json_decode($content, true);

        if (is_array($outputArray)) {
            return $this->apiDataAccount = $outputArray;
        }

        return [];
    }
}
