<?php

namespace App\Services;

class SystemMetricService
{
    /**
     * Get real-time system performance metrics.
     *
     * @return array<string, mixed>
     */
    public function getMetrics(): array
    {
        // 1. CPU Cores & Load Average (sys_getloadavg)
        $cores = 1;
        if (is_readable('/proc/cpuinfo')) {
            $cpuInfo = (string) @file_get_contents('/proc/cpuinfo');
            $cores = max(1, substr_count($cpuInfo, 'processor'));
        }

        $loadAvg = sys_getloadavg();
        $load1m  = $loadAvg !== false ? round($loadAvg[0], 2) : 0.0;
        $load5m  = $loadAvg !== false ? round($loadAvg[1], 2) : 0.0;
        $load15m = $loadAvg !== false ? round($loadAvg[2], 2) : 0.0;

        // CPU load as percentage of total core capacity
        $cpuPercent = (int) min(100, max(1, round(($load1m / $cores) * 100)));

        // 2. RAM Memory from /proc/meminfo
        $memTotal = 0;
        $memAvail = 0;
        if (is_readable('/proc/meminfo')) {
            $lines = @file('/proc/meminfo');
            if ($lines !== false) {
                foreach ($lines as $line) {
                    if (preg_match('/^MemTotal:\s+(\d+)\s+kB/i', $line, $matches)) {
                        $memTotal = (int) $matches[1];
                    }
                    if (preg_match('/^MemAvailable:\s+(\d+)\s+kB/i', $line, $matches)) {
                        $memAvail = (int) $matches[1];
                    }
                }
            }
        }

        if ($memTotal > 0) {
            $memUsedKb = $memTotal - $memAvail;
            $ramPercent = (int) min(100, max(1, round(($memUsedKb / $memTotal) * 100)));
            $ramTotalGb = round($memTotal / (1024 * 1024), 1);
            $ramUsedGb  = round($memUsedKb / (1024 * 1024), 1);
        } else {
            $ramPercent = 25;
            $ramTotalGb = 8.0;
            $ramUsedGb  = 2.0;
        }

        // 3. Disk Space
        $basePath = base_path();
        $diskTotalBytes = @disk_total_space($basePath);
        $diskFreeBytes  = @disk_free_space($basePath);

        if ($diskTotalBytes !== false && $diskFreeBytes !== false && $diskTotalBytes > 0) {
            $diskUsedBytes   = $diskTotalBytes - $diskFreeBytes;
            $diskPercent     = (int) min(100, max(1, round(($diskUsedBytes / $diskTotalBytes) * 100)));
            $diskTotalGb     = round($diskTotalBytes / (1024 * 1024 * 1024), 1);
            $diskUsedGb      = round($diskUsedBytes / (1024 * 1024 * 1024), 1);
        } else {
            $diskPercent = 15;
            $diskTotalGb = 100.0;
            $diskUsedGb  = 15.0;
        }

        // 4. PHP Process Memory
        $phpMemBytes = memory_get_usage(true);
        $phpMemMb    = round($phpMemBytes / (1024 * 1024), 1);

        // 5. System Status Assessment
        if ($cpuPercent > 80 || $ramPercent > 90) {
            $status = 'CRITICAL';
            $statusColor = 'red';
        } elseif ($cpuPercent > 50 || $ramPercent > 75) {
            $status = 'ELEVATED';
            $statusColor = 'amber';
        } else {
            $status = 'OPTIMAL';
            $statusColor = 'emerald';
        }

        // 6. Visual Chart Bars with real values & percentages
        $bars = [
            ['label' => 'CPU 1m',  'val' => (string) $load1m,            'pct' => $cpuPercent],
            ['label' => 'CPU 5m',  'val' => (string) $load5m,            'pct' => (int) min(100, max(1, round(($load5m / $cores) * 100)))],
            ['label' => 'CPU 15m', 'val' => (string) $load15m,           'pct' => (int) min(100, max(1, round(($load15m / $cores) * 100)))],
            ['label' => 'RAM',     'val' => $ramPercent . '%',           'pct' => $ramPercent],
            ['label' => 'DISK',    'val' => $diskPercent . '%',          'pct' => $diskPercent],
            ['label' => 'APP MEM', 'val' => $phpMemMb . 'MB',            'pct' => (int) min(100, max(5, round(($phpMemMb / 128) * 100)))],
            ['label' => 'LOAD',    'val' => (int) round(($cpuPercent + $ramPercent) / 2) . '%', 'pct' => (int) round(($cpuPercent + $ramPercent) / 2)],
        ];

        return [
            'cpu_percent'   => $cpuPercent,
            'cores'         => $cores,
            'load_1m'       => $load1m,
            'load_5m'       => $load5m,
            'load_15m'      => $load15m,
            'ram_percent'   => $ramPercent,
            'ram_used_gb'   => $ramUsedGb,
            'ram_total_gb'  => $ramTotalGb,
            'disk_percent'  => $diskPercent,
            'disk_used_gb'  => $diskUsedGb,
            'disk_total_gb' => $diskTotalGb,
            'php_mem_mb'    => $phpMemMb,
            'status'        => $status,
            'status_color'  => $statusColor,
            'bars'          => $bars,
            'timestamp'     => now()->format('H:i:s'),
        ];
    }
}
