<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 30-09-15
 * Time: 05:52
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $timestamps = true;

    private $id;
    private $ics;
    private $date;
    private $title;
    private $description;
    private $dateEnd;
    private $intervalleRepeat;
    private $daysRepeat;
    private $untilRepeat;
}