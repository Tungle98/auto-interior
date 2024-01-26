<?php

namespace App\Models\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    use HasFactory;

    public static function storeOrUpdate(array $params = [])
    {
        if (!empty($params['id'])) {
            $model = static::getDetail($params['id']);
        } else {
            $model = (new static());
        }

        if ($model instanceof self) {

            $model->fill($params);
            $model->save();

            return $model;
        }

        return null;
    }

    public static function getDetail(int $id, array $fields = ['*'], array $with = [], string $customCondition = '')
    {
        $query = static::query()->select($fields)->where('id', $id);

        if (!empty($with)) {
            $query = $query->with($with);
        }

        if ($customCondition) {
            $query = $query->whereRaw($customCondition);
        }

        return $query->first();
    }

    public static function getList(array $fields = ['*'], array $with = [], array $wheres = [], $customCondition = '', array $orderBy = [], $paginate = null, bool $delete = false)
    {
        $query = static::query()->select($fields);

        if (!empty($with)) {
            $query = $query->with($with);
        }

        if (!empty($wheres)) {
            if (isset($wheres['value'])) {
                if (is_array($wheres['value'])) {
                    $query->whereIn($wheres['column'], $wheres['value']);
                } else {
                    $query->where($wheres['column'], isset($wheres['operator']) ? $wheres['operator'] : '=', $wheres['value']);
                }
            } else {
                foreach ($wheres as $where) {
                    if (is_array($where['value'])) {
                        $query->whereIn($where['column'], $where['value']);
                    } else {
                        $query->where($where['column'], isset($where['operator']) ? $where['operator'] : '=', $where['value']);
                    }
                }
            }
        }

        if ($customCondition) {
            $query = $query->where($customCondition);
        }

        if (!empty($orderBy)) {
            $query->orderBy($orderBy['column'], $orderBy['type']);
        }

        if ($paginate != null) {
            return $query->paginate($paginate);
        }

        if ($delete) {
            $query->delete();
        } else {
            return $query->get();
        }
    }

    public static function getFirstByWhere(string $where, string $condition, string $attribute, array $with = [], array $fields = ['*'], bool $delete = false)
    {
        $query = static::query()->where($where, $condition, $attribute);

        if (!empty($with)) {
            $query = $query->with($with);
        }

        $query = $query->select($fields);

        if ($delete) {
            $query->first()->delete();
        } else {
            return $query->first();
        }
    }

}
