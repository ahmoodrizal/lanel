<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;

class Users extends AbstractTable
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
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('username', 'LIKE', "%{$value}%")
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        return QueryBuilder::for(User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'admin');
        }))
            ->defaultSort('id')
            ->allowedSorts(['id', 'username', 'name', 'email', 'roles.id'])
            ->allowedFilters(['id', 'username', 'name', 'email', 'roles.id', $globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'username', 'name', 'email'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('username', sortable: true)
            ->column('email', sortable: true)
            ->column(key: 'roles.name', label: 'Role', classes: 'uppercase')
            // ->rowLink(function (User $user) {
            //     return route('admin.users.edit');
            // })
            ->selectFilter(
                key: 'roles.id',
                options: Role::pluck('name', 'id')->toArray(),
                label: 'Role',
            )
            ->column('action')
            ->paginate(15);
    }
}
