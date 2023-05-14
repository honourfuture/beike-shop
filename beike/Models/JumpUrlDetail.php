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

class JumpUrlDetail extends Base
{
    protected $guarded = [];
    use SoftDeletes;

}
