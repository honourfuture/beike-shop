<?php
/**
 * JumpUrlRepo.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2022-07-27 11:21:14
 * @modified   2022-07-27 11:21:14
 */

namespace Beike\Admin\Repositories;

use Beike\Models\JumpUrl;
use Beike\Models\JumpUrlDetail;

class JumpUrlRepo
{
    public static function getList()
    {
        $t =  JumpUrl::query()->with([
            'toUrls','toUrlVisitor'
        ])->get();
//        print_r($t->toArray());die;
        return $t;
    }

    public static function createOrUpdate($data)
    {
        $id = $data['id'] ?? 0;
        if ($id) {
            $jumpUrl = JumpUrl::query()->findOrFail($id);
        } else {
            $jumpUrl = new JumpUrl();
        }
        $jumpUrl->fill([
            'url' => trim($data['url']),
        ]);

        $jumpUrl->saveOrFail();

        $to_urls = array_filter(explode("\n", $data['to_urls']));

        $url_details = JumpUrlDetail::where('page_id', $jumpUrl->id)->get();


        foreach ($url_details as $detail) {
            if (!in_array($detail->to_url, $to_urls)) {
                JumpUrlDetail::where('id', $detail->id)->delete();
            }
        }
        foreach ($to_urls as $url) {
            $to_url = $url_details->where('to_url', $url)->first();
            if (!$to_url) {

                JumpUrlDetail::create([
                    'to_url' => $url,
                    'page_id' => $jumpUrl->id,
                ]);
            }
        }

        return JumpUrl::where('id', $jumpUrl->id)->with(['toUrls','toUrlVisitor'])->first();
    }

    public static function deleteById($id)
    {
        $jumpUrl = JumpUrl::query()->findOrFail($id);
        $jumpUrl->delete();
    }

    public static function getNameByRateId($jumpUrlId)
    {
        $jumpUrl = JumpUrl::query()->findOrFail($jumpUrlId);

        return $jumpUrl->name;
    }
}
