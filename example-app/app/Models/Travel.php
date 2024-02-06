<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class Travel extends Model
{
    use Uuids;
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'table_travel';
    protected $primaryKey = 'id_travel';
    protected $fillable = [];
}
