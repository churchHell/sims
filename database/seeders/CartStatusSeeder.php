<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CartStatus;

class CartStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create(1, 3, 'added', __('cart.added'));
        $this->create(2, 4, 'not-added', __('cart.not-added'));
        $this->create(3, 4, 'less-qty', __('cart.less-qty'));
        $this->create(4, 4, 'diff-qty', __('cart.diff-qty'));
        $this->create(5, 5, 'changed', __('cart.changed'));
    }

    private function create(int $id, int $status_id, string $slug, string $name): void
    {
        CartStatus::firstOrCreate(compact('id', 'status_id', 'slug', 'name'));
    }
}
