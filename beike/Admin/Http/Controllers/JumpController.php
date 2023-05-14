<?php
/**
 * TaxRateController.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2022-07-26 20:00:13
 * @modified   2022-07-26 20:00:13
 */

namespace Beike\Admin\Http\Controllers;

use Beike\Admin\Repositories\JumpUrlRepo;
use Beike\Models\Region;
use Illuminate\Http\Request;

class JumpController
{
    public function index()
    {
        $data = [
            'jumps' => JumpUrlRepo::getList(),
        ];

        $data = hook_filter('admin.jumps.index.data', $data);
        return view('admin::pages.jumps.index', $data);
    }

    public function store(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);
        $taxRate     = JumpUrlRepo::createOrUpdate($requestData);

        return json_success(trans('common.created_success'), $taxRate);
    }

    public function update(Request $request, int $jumpId)
    {
        $requestData       = json_decode($request->getContent(), true);
        $requestData['id'] = $jumpId;
        $jumpUrls          = JumpUrlRepo::createOrUpdate($requestData);

        return json_success(trans('common.updated_success'), $jumpUrls);
    }

    public function destroy(Request $request, int $taxRateId)
    {
        JumpUrlRepo::deleteById($taxRateId);

        return json_success(trans('common.deleted_success'));
    }
}
