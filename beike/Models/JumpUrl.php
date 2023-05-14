<?php
/**
 * TaxRate.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2022-07-21 18:39:38
 * @modified   2022-07-21 18:39:38
 */

namespace Beike\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class JumpUrl extends Base
{
    use SoftDeletes;
    protected $guarded = [];

    public function toUrls()
    {
        return $this->hasMany(JumpUrlDetail::class, 'page_id');
    }

    public function toUrlVisitor()
    {
        return $this->hasOne(JumpUrlDetail::class, 'page_id')->select([
            'page_id',
            DB::raw('SUM(visitor) as visitorTotal'),
        ])->groupBy('page_id');;
    }
}
