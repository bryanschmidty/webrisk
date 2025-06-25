<?php

use App\Models\Game;
use App\Models\GameLand;
use App\Models\GamePlayer;

if (!function_exists('game_info')) {
    function game_info(Game $game): string
    {
        $players = $game->players()->with('player')->orderBy('order_num')->get();
        $info = $players->map(function ($gp) use ($game) {
            $lands = GameLand::where('game_id', $game->game_id)
                ->where('player_id', $gp->player_id)
                ->count();
            $cards = $gp->cards ? count(array_filter(explode(' ', $gp->cards))) : 0;
            return [
                'order' => $gp->order_num,
                'username' => $gp->player->username ?? '',
                'state' => $gp->state,
                'armies' => $gp->armies,
                'land' => $lands,
                'cards' => $cards,
            ];
        });

        $extra = $game->extra_info ? json_decode($game->extra_info, true) : [];
        $tradeValues = $extra['trade_values'] ?? [];
        $tradeHtml = $tradeValues ? trade_table($tradeValues, $extra['trade_count'] ?? 0) : '';

        $playerId = session('player_id');
        $player = $playerId ? $game->players()->where('player_id', $playerId)->first() : null;
        $conquerProgress = '';
        $conquerHtml = '';
        if ($player && isset($extra['conquer_type'])) {
            $limit = calculate_conquer_limit($game, $player);
            $playerExtra = $player->extra_info ? json_decode($player->extra_info, true) : [];
            $conquered = (int)($playerExtra['conquered'] ?? 0);
            $percent = $limit > 0 ? min(100, ($conquered / $limit) * 100) : 0;
            $conquerHtml = conquer_limit_table($extra, $limit);
            $conquerProgress = view('components.conquer-progress', [
                'conquered' => $conquered,
                'limit' => $limit,
                'percent' => $percent,
            ])->render();
        } elseif (isset($extra['conquer_type'])) {
            $conquerHtml = conquer_limit_table($extra);
        }

        return view('games.partials.game_info', [
            'game' => $game,
            'players' => $info,
            'tradeHtml' => $tradeHtml,
            'conquerHtml' => $conquerHtml,
            'conquerProgress' => $conquerProgress,
        ])->render();
    }
}

if (!function_exists('game_map')) {
    function game_map(): string
    {
        return view('games.partials.game_map')->render();
    }
}


if (!function_exists('trade_table')) {
    function trade_table(array $tradeValues, int $tradeCount = 0): string
    {
        $tradeCount++;
        $rows = [];
        $prev = 0;
        foreach ($tradeValues as $trade => $value) {
            $idx = $trade + 1;
            if (is_string($value) && $value !== '' && $value[0] === '-') {
                $next = $prev;
                while (0 < $next) {
                    $next += (int) $value;
                    if (0 >= $next) {
                        $idx--;
                        break;
                    }
                    $rows[] = ['idx' => $idx, 'value' => $next];
                    $idx++;
                }
                while ($idx <= $tradeCount) {
                    $rows[] = ['idx' => $idx, 'value' => 0];
                    $idx++;
                }
                $rows[] = ['idx' => $idx, 'value' => 0];
                $idx++;
                $rows[] = ['idx' => $idx, 'value' => 0];
                $idx++;
                $rows[] = ['idx' => $idx, 'value' => '...'];
            } elseif (is_string($value) && $value[0] === '+') {
                $next = $prev;
                while ($idx <= $tradeCount) {
                    $next += (int) $value;
                    $rows[] = ['idx' => $idx, 'value' => $next];
                    $idx++;
                }
                for ($i = 1; $i <= 3; $i++) {
                    $next += (int) $value;
                    $rows[] = ['idx' => $idx, 'value' => $next];
                    $idx++;
                }
                $rows[] = ['idx' => $idx, 'value' => '(' . $value . ')'];
            } else {
                $rows[] = ['idx' => $idx, 'value' => $value];
                $prev = $value;
            }
        }
        $last = end($tradeValues);
        if (!is_string($last) || !in_array($last[0], ['+', '-'])) {
            $idx = count($tradeValues) + 1;
            $value = $last;
            while ($idx <= $tradeCount) {
                $rows[] = ['idx' => $idx, 'value' => $value];
                $idx++;
            }
            $rows[] = ['idx' => $idx, 'value' => $value];
            $idx++;
            $rows[] = ['idx' => $idx, 'value' => $value];
            $idx++;
            $rows[] = ['idx' => $idx, 'value' => '...'];
        }
        foreach ($rows as &$r) {
            $r['highlight'] = ($r['idx'] === $tradeCount);
        }
        return view('components.trade-table', ['rows' => $rows])->render();
    }
}

if (!function_exists('calculate_conquer_limit')) {
    function calculate_conquer_limit(Game $game, GamePlayer $player): int
    {
        $extra = $game->extra_info ? json_decode($game->extra_info, true) : [];
        $type = $extra['conquer_type'] ?? 'none';
        if ($type === 'none') {
            return 0;
        }
        $skip = (int)($extra['conquer_skip'] ?? 0);
        $startAt = (int)($extra['conquer_start_at'] ?? 0);
        $conquestsPer = (int)($extra['conquer_conquests_per'] ?? 1);
        $perNumber = (int)($extra['conquer_per_number'] ?? 0);
        if (!$perNumber) {
            $perNumber = match ($type) {
                'trade_value' => 10,
                'trade_count' => 2,
                'rounds' => 1,
                'turns' => 1,
                'land' => 3,
                'continents' => 1,
                'armies' => 10,
                default => 1,
            };
        }
        $minimum = (int)($extra['conquer_minimum'] ?? 1);
        if ($minimum < 1) {
            $minimum = 1;
        }
        $maximum = (int)($extra['conquer_maximum'] ?? 42);
        $startCount = in_array($type, ['trade_value', 'trade_count', 'continents']) ? 0 : 1;

        $info = $player->extra_info ? json_decode($player->extra_info, true) : [];
        $amount = 0;
        switch ($type) {
            case 'trade_value':
                $amount = $game->get_trade_value();
                break;
            case 'trade_count':
                $amount = (int)($extra['trade_count'] ?? 0);
                break;
            case 'rounds':
                $amount = (int)($info['round'] ?? 1);
                break;
            case 'turns':
                $amount = (int)($info['turn'] ?? 1);
                break;
            case 'land':
                $amount = GameLand::where('game_id', $game->game_id)
                    ->where('player_id', $player->player_id)
                    ->count();
                break;
            case 'armies':
                $amount = GameLand::where('game_id', $game->game_id)
                    ->where('player_id', $player->player_id)
                    ->sum('armies');
                break;
            default:
                $amount = 1;
        }
        $limit = max((((((int) floor(($amount - $startCount) / $perNumber)) + 1) - $skip) * $conquestsPer), 0) + $startAt;
        $limit = max($minimum, min($limit, $maximum));
        return (int)$limit;
    }
}

if (!function_exists('conquer_limit_table')) {
    function conquer_limit_table(array $extra, int $highlight = 0): string
    {
        if (($extra['conquer_type'] ?? 'none') === 'none') {
            return '';
        }
        $type = $extra['conquer_type'];
        $skip = (int)($extra['conquer_skip'] ?? 0);
        $startAt = (int)($extra['conquer_start_at'] ?? 0);
        $conquestsPer = (int)($extra['conquer_conquests_per'] ?? 1);
        $perNumber = (int)($extra['conquer_per_number'] ?? 0);
        if (!$perNumber) {
            $perNumber = match ($type) {
                'trade_value' => 10,
                'trade_count' => 2,
                'rounds' => 1,
                'turns' => 1,
                'land' => 3,
                'continents' => 1,
                'armies' => 10,
                default => 1,
            };
        }
        $minimum = (int)($extra['conquer_minimum'] ?? 1);
        if ($minimum < 1) {
            $minimum = 1;
        }
        $maximum = (int)($extra['conquer_maximum'] ?? 42);
        $startCount = in_array($type, ['trade_value', 'trade_count', 'continents']) ? 0 : 1;
        $conquests = [];
        $repeats = 0;
        $prev = 0;
        for ($n = 0; $n <= 200; $n++) {
            $limit = max((((((int) floor(($n - $startCount) / $perNumber)) + 1) - $skip) * $conquestsPer), 0) + $startAt;
            $limit = max($minimum, min($limit, $maximum));
            if ($limit !== $prev) {
                $prev = $limit;
            } elseif ($limit === $maximum) {
                $repeats++;
            }
            $conquests[$n] = $limit;
            if ($repeats >= 3) {
                $conquests['...'] = $limit;
                break;
            }
        }
        if (!in_array($type, ['trade_value', 'trade_count', 'continents'])) {
            unset($conquests[0]);
        }
        $equation = "max( ( ( ( floor( (x - {$startCount}) / <span class=\"per_number\">{$perNumber}</span> ) + 1 ) - <span class=\"skip\">{$skip}</span> ) * <span class=\"conquests_per\">{$conquestsPer}</span> ) , 0 ) + <span class=\"start_at\">{$startAt}</span>";
        return view('components.conquer-limit-table', [
            'type' => $type,
            'limits' => $conquests,
            'equation' => $equation,
            'highlight' => $highlight,
        ])->render();
    }
}
