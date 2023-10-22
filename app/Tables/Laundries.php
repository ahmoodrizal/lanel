<?php

namespace App\Tables;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Table\Column;
use Spatie\QueryBuilder\AllowedFilter;

class Laundries extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return QueryBuilder::for(
            Laundry::whereShopId(auth()->user()->shop?->id)
                ->orWhere('user_id', auth()->user()->id)
        )
            ->defaultSort('id');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $roles = auth()->user()->roles->pluck('name')[0];

        $table
            ->column('id')
            ->column(key: $roles == 'customer' ? 'shop.name' : 'user.name', label: $roles == 'customer' ? 'Shop' : 'Customer')
            ->column('claim_code')
            ->column('description')
            ->column('weight', label: 'Berat /Kg')
            ->column('total', label: 'Total Rp.')
            ->column('status')
            ->column($roles == 'customer' ? 'created_at' : 'action')
            ->paginate(15);
    }
}
