<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Queries\Support;

use GraphQL\Type\Definition\Type;
use Illuminate\Database\Query\Builder as QBuilder;
use Illuminate\Database\Eloquent\Builder as EBuilder;

/**
 * Class QueryLimit.
 */
trait QueryLimit
{
    /**
     * @param  array $args
     * @return array
     */
    protected function argumentsWithLimit(array $args): array
    {
        return array_merge($args, [
            '_limit' => [
                'type'        => Type::int(),
                'description' => 'Items per page: in 1...1000 range',
            ],

            '_page' => [
                'type'        => Type::int(),
                'description' => 'Current page number (Usage without "_limit" argument gives no effect)',
            ],
        ]);
    }

    /**
     * @param  EBuilder|QBuilder $builder
     * @param  array             $args
     * @return EBuilder
     */
    protected function queryWithLimit($builder, array &$args = [])
    {
        return $this->paginate($builder, $args);
    }

    /**
     * @param  EBuilder|QBuilder $builder
     * @param  array             $args
     * @return EBuilder
     */
    protected function paginate($builder, array &$args = [])
    {
        $limit = null;

        if (isset($args['_limit'])) {
            $limit = max(1, min(1000, (int) $args['_limit']));

            $builder = $builder->take($limit);

            if (isset($args['_page'])) {
                $page = max(1, (int) $args['_page']);

                $builder = $builder->skip(($page - 1) * $limit);
            }

            unset($args['_limit']);
        }

        if (isset($args['_page'])) {
            unset($args['_page']);
        }

        return $builder;
    }
}