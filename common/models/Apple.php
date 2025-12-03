<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Apple model
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer|null $fell_at
 * @property string $color
 * @property string $status
 * @property integer $intact_percent
 */
class Apple extends ActiveRecord
{
    const TIME_BEFORE_ROTTED = 5 * 60 * 60;

    const STATUS_ON_TREE = 'on_tree';
    const STATUS_FELL = 'fell';
    const STATUS_ROTTED = 'rotted';
    const STATUS_EMPTY = 'empty';

    const COLOR_GREEN = 'green';
    const COLOR_RED = 'red';
    const COLOR_YELLOW = 'yellow';

    const AVAILABLE_COLORS = [
        self::COLOR_GREEN,
        self::COLOR_RED,
        self::COLOR_YELLOW,
    ];

    public static function addAppleOnTree() {
        $apple = new static();
        $apple->created_at = mt_rand(0, time());
        $apple->color = self::AVAILABLE_COLORS[array_rand(self::AVAILABLE_COLORS)];
        $apple->status = self::STATUS_ON_TREE;
        $apple->intact_percent = 100;
        $apple->save();
    }

    public function canFall(): bool {
        return $this->status === self::STATUS_ON_TREE;
    }

    public function fall() {
        if (!$this->canFall()) {
            return;
        }

        $this->status = self::STATUS_FELL;
        $this->fell_at = time();
        $this->save();
    }

    public function canTakeABit(): bool {
        return $this->status === self::STATUS_FELL
            && $this->intact_percent > 0
            && time() < $this->fell_at + self::TIME_BEFORE_ROTTED;
    }

    public function takeABit(int $percent) {
        if (!$this->canTakeABit()) {
            return;
        }

        if ($percent > $this->intact_percent) {
            return;
        }

        $this->intact_percent -= $percent;
        if ($this->intact_percent === 0) {
            $this->status = self::STATUS_EMPTY;
        }
        $this->save();
    }

    public function makeRotten() {
        if (time() < $this->fell_at + self::TIME_BEFORE_ROTTED || $this->status !== self::STATUS_FELL) {
            return;
        }

        $this->status = self::STATUS_ROTTED;
        $this->intact_percent = 0;
        $this->save();
    }
}
