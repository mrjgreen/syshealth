<?php namespace Syshealth;

use Syshealth\System\Entity\SystemEntity;

class JsonFormatter
{
    /**
     * @param SystemEntity $systemEntity
     * @return array
     */
    public function format(SystemEntity $systemEntity, $pretty = false)
    {
        $options = $pretty ? JSON_PRETTY_PRINT : 0;

        return json_encode($this->toArray($systemEntity), $options);
    }

    /**
     * @param SystemEntity $systemEntity
     * @return array
     */
    public function toArray(SystemEntity $systemEntity)
    {
        return array(
            'hostname'          => $systemEntity->hostName,
            'host'              => $systemEntity->hostIp,
            'loadavg1'          => $systemEntity->loadAverage->one,
            'loadavg2'          => $systemEntity->loadAverage->five,
            'loadavg3'          => $systemEntity->loadAverage->fifteen,
            'memory_total'      => $systemEntity->memoryEntity->memoryTotal,
            'memory_free'       => $systemEntity->memoryEntity->memoryFree,
            'memory_cache'      => $systemEntity->memoryEntity->memoryCached,
            'memory_used'       => $systemEntity->memoryEntity->memoryUsed,
            'swap_total'        => $systemEntity->memoryEntity->swapTotal,
            'swap_used'         => $systemEntity->memoryEntity->swapUsed,
            'swap_free'         => $systemEntity->memoryEntity->swapFree,
            'cpu_usage'         => $systemEntity->cpu->used,
            'uptime_seconds'    => $systemEntity->uptimeSeconds,
            'disks'             => $systemEntity->disks,
            'cpus'              => $systemEntity->cpus
        );
    }
}
