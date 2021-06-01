<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait GeneralHelperTrait
{
    public function orderNumber(): string
    {

        $order_number = DB::table('order_numbers')->first();
        if (!empty($order_number) && !is_null($order_number)) {
            if ($order_number->code == '9999') {

                $last_ch = ord($order_number->alpha);
                $last_ch = $last_ch + 1;
                $new_character = chr($last_ch);

                if (($last_ch >= 65 && $last_ch <= 90) || ($last_ch >= 97 && $last_ch <= 122)) {
                    DB::table('order_numbers')
                        ->insert([
                            'slug' => 'Q-',
                            'alpha' => $new_character,
                            'code' => '0001'
                        ]);
                }

                $new_order_number = 'Q-' . $new_character . '0001';
            } else {
                $existing_order_number = DB::table('order_numbers')
                    ->where('alpha', $order_number->alpha)
                    ->first();

                if ($existing_order_number) {
                    $new_order_number = $existing_order_number->slug . $existing_order_number->alpha . $existing_order_number->code;
                    DB::table('order_numbers')
                        ->update([
                            'slug' => 'Q-',
                            'alpha' => $order_number->alpha,
                            'code' => $this->code($existing_order_number->code)
                        ]);

                } else {
                    DB::table('order_numbers')
                        ->insert([
                            'slug' => 'Q-',
                            'alpha' => $order_number->alpha,
                            'code' => '0001'
                        ]);
                    $new_order_number = 'Q-' . $order_number->alpha . '0001';
                }
            }
        } else {
            DB::table('order_numbers')
                ->insert([
                    'slug' => 'Q-',
                    'alpha' => 'A',
                    'code' => '0001'
                ]);
            $new_order_number = 'Q-' . 'A' . '0001';
        }


        return $new_order_number;
    }

    public function code(String $code)
    {
        $convert_into_int = (int)$code;
        $incremented_int = $convert_into_int + 1;
        $integer_length = (int)log10($incremented_int) + 1;

        if ($integer_length === 1) {
            $new_code = '000' . $incremented_int;
        } elseif ($integer_length === 2) {
            $new_code = '00' . $incremented_int;
        } elseif ($integer_length === 3) {
            $new_code = '0' . $incremented_int;
        } else {
            $new_code = $incremented_int;
        }

        return $new_code;
    }
}
