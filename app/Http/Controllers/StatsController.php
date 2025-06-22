<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        $players = DB::table('player')
            ->join('wr_player', 'player.player_id', '=', 'wr_player.player_id')
            ->select('player.username', 'wr_player.wins', 'wr_player.kills', 'wr_player.losses', 'wr_player.last_online')
            ->orderBy('player.username')
            ->get();

        $stats = $this->rollStats();

        return view('stats.index', [
            'players' => $players,
            'actual' => $stats['actual'],
            'theoretical' => $stats['theor'],
            'values' => $stats['values'],
            'count' => $stats['count'],
        ]);
    }

    protected function rollStats()
    {
        $where = [
            '1v1' => 'attack_2 IS NULL AND defend_2 IS NULL',
            '2v1' => 'attack_2 IS NOT NULL AND attack_3 IS NULL AND defend_2 IS NULL',
            '3v1' => 'attack_3 IS NOT NULL AND defend_2 IS NULL',
            '1v2' => 'attack_2 IS NULL AND defend_2 IS NOT NULL',
            '2v2' => 'attack_2 IS NOT NULL AND attack_3 IS NULL AND defend_2 IS NOT NULL',
            '3v2' => 'attack_3 IS NOT NULL AND defend_2 IS NOT NULL',
        ];

        $theor = [
            '1v1' => ['attack' => 0.4167, 'defend' => 0.5833],
            '2v1' => ['attack' => 0.5787, 'defend' => 0.4213],
            '3v1' => ['attack' => 0.6597, 'defend' => 0.3403],
            '1v2' => ['attack' => 0.2546, 'defend' => 0.7454],
            '2v2' => ['attack' => 0.2276, 'defend' => 0.4483, 'both' => 0.3241],
            '3v2' => ['attack' => 0.3717, 'defend' => 0.2926, 'both' => 0.3358],
        ];

        $fights = ['1v1', '2v1', '3v1', '1v2', '2v2', '3v2'];
        $wins = ['attack', 'defend', 'both'];

        $count['total'] = DB::table('roll_logs')->count();
        foreach ($fights as $fight) {
            $count[$fight] = DB::table('roll_logs')->whereRaw($where[$fight])->count();
        }

        $values = [];
        $actual = [];
        foreach ($fights as $fight) {
            foreach ($wins as $win) {
                if ($win === 'both' && !in_array($fight, ['2v2', '3v2'])) {
                    continue;
                }
                $query = DB::table('roll_logs')->whereRaw($where[$fight]);
                switch ($win) {
                    case 'attack':
                        $query->whereColumn('attack_1', '>', 'defend_1')
                            ->where(function ($q) {
                                $q->whereColumn('attack_2', '>', 'defend_2')
                                    ->orWhereNull('attack_2')
                                    ->orWhereNull('defend_2');
                            });
                        break;
                    case 'defend':
                        $query->whereColumn('attack_1', '<=', 'defend_1')
                            ->where(function ($q) {
                                $q->whereColumn('attack_2', '<=', 'defend_2')
                                    ->orWhereNull('attack_2')
                                    ->orWhereNull('defend_2');
                            });
                        break;
                    case 'both':
                        $query->where(function ($q) {
                            $q->where(function ($q) {
                                $q->whereColumn('attack_1', '>', 'defend_1')
                                    ->whereColumn('attack_2', '<=', 'defend_2');
                            })->orWhere(function ($q) {
                                $q->whereColumn('attack_1', '<=', 'defend_1')
                                    ->whereColumn('attack_2', '>', 'defend_2');
                            });
                        });
                        break;
                }
                $value = $query->count();
                $values[$fight][$win] = $value;
                $actual[$fight][$win] = $count[$fight] ? $value / $count[$fight] : 0;
            }
        }

        return compact('count', 'values', 'theor', 'actual');
    }
}
