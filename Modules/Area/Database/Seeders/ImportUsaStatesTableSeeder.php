<?php

namespace Modules\Area\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Modules\Area\Models\Area;
use Modules\Area\Models\State;

class ImportUsaStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usa_states = json_decode(Storage::get('static_data/usa_states.json'), true);

        foreach ($usa_states as $stateItem) {

            $state = State::create([
                'name'      => $stateItem['name'],
                'code'      => $stateItem['code'],
                'is_active' => 1
            ]);

            $areaItemsAttrs = [];
            foreach (explode(',', $stateItem['area_code']) as $areaItem) {
                $areaItemsAttrs[] = [
                    'state_id'   => $state->id,
                    'name'       => $areaItem,
                    'is_active'  => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            Area::insert($areaItemsAttrs);
        }
    }
}
