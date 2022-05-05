<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Set mass-assignable fields  - Установить массово назначаемые поля (чтобы сохранить весь запрос за один раз)
    protected $fillable = ['title', 'content', 'slug'];


    /**
     * Get the route key for the model.   Получите ключ маршрута для модели.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

