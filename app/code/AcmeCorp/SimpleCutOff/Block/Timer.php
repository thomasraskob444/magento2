<?php
namespace AcmeCorp\SimpleCutOff\Block;

class Timer extends \Magento\Framework\View\Element\Template
{
    public function getCutOffStartTime() {
        $timezone = new \DateTimeZone('GMT');
        $start_time_string = $this->_scopeConfig->getValue('acmecorp_simplecutoff/general/start_time');
        $start_time_string = gmdate("m/d/Y ").$start_time_string;
        $start_time = \DateTime::createFromFormat("m/d/Y g:i:s A", $start_time_string, $timezone);
        return $start_time;
    }

    public function getCutOffEndTime() {
        $timezone = new \DateTimeZone('GMT');
        $end_time_string = $this->_scopeConfig->getValue('acmecorp_simplecutoff/general/end_time');
        $end_time_string = gmdate("m/d/Y ").$end_time_string;
        $end_time = \DateTime::createFromFormat("m/d/Y g:i:s A", $end_time_string, $timezone);
        return $end_time;
    }

    public function getCurrentTime() {
        $now = new \DateTime();
        return $now;
    }

    public function getRemainingTime() {
        $start_time = $this->getCutOffStartTime();
        $end_time = $this->getCutOffEndTime();
        $now = $this->getCurrentTime();
        if (($start_time <= $now) && ($now <= $end_time)) {
            $diff = $end_time->getTimestamp() - $now->getTimestamp();
            $hours = (int)($diff / 3600);
            $mins = (int)($diff / 60) - $hours * 60;
            return "{$hours}Hrs {$mins}Mins";
        }
        return false;
    }
}
