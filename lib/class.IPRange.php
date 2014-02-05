<?php
/**
 * Date: 04/02/14
 * Time: 16:55
 * Author: Jean-Christophe Cuvelier <jcc@morris-chapman.com>
 */

class IPRange extends MCFObject {


    protected $begin_ip;
    protected $end_ip;
    /** @var $begin_ip_num int */
    protected $begin_ip_num;
    /** @var $end_ip_num int */
    protected $end_ip_num;

    protected $country_code;
    protected $country_name;

    public static $table_fields = array(
        'begin_ip' => 'C(15)',
        'end_ip' => 'C(15)',
        'begin_ip_num' => 'BIGINT',
        'end_ip_num' => 'BIGINT',
        'country_code' => 'C(2)',
        'country_name' => 'C(255)',
    );

    protected static $table_fields_indexes = array('begin_ip_num', 'end_ip_num', 'country_code');

    const TABLE_NAME = 'module_ip2country_range';

    /**
     * @param mixed $begin_ip
     */
    public function setBeginIp($begin_ip)
    {
        $this->begin_ip = $begin_ip;
    }

    /**
     * @return mixed
     */
    public function getBeginIp()
    {
        return $this->begin_ip;
    }

    /**
     * @param int $begin_ip_num
     */
    public function setBeginIpNum($begin_ip_num)
    {
        $this->begin_ip_num = $begin_ip_num;
    }

    /**
     * @return int
     */
    public function getBeginIpNum()
    {
        return $this->begin_ip_num;
    }

    /**
     * @param mixed $country_name
     */
    public function setCountryName($country_name)
    {
        $this->country_name = $country_name;
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->country_name;
    }

    /**
     * @param mixed $country_code
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * @param int $end_ip_num
     */
    public function setEndIpNum($end_ip_num)
    {
        $this->end_ip_num = $end_ip_num;
    }

    /**
     * @return int
     */
    public function getEndIpNum()
    {
        return $this->end_ip_num;
    }

    /**
     * @param mixed $end_ip
     */
    public function setEndIp($end_ip)
    {
        $this->end_ip = $end_ip;
    }

    /**
     * @return mixed
     */
    public function getEndIp()
    {
        return $this->end_ip;
    }

    /**
     * @param $ip
     * @return IPRange|null
     */
    protected static function getRangeFromIP($ip)
    {
        $iplong = ip2long($ip);
        $c = new MCFCriteria();
        $c->add('begin_ip_num', $iplong, MCFCriteria::LESS_EQUAL);
        $c->add('end_ip_num', $iplong, MCFCriteria::GREATER_EQUAL);

        return self::doSelectOne($c);
    }

    public static function getCountryISOFromIP($ip)
    {
        if($range = self::getRangeFromIP($ip))
        {
            return $range->getCountryCode();
        }
        return null;
    }

    public static function getCountryNameFromIP($ip)
    {
        if($range = self::getRangeFromIP($ip))
        {
            return $range->getCountryName();
        }
        return 'An unknown country';
    }
} 