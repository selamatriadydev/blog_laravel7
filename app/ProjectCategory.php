<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $table = 'project_category';
    protected $fillable = ['title', 'link', 'sort', 'is_published'];
}
