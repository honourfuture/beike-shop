<?php

namespace App\Http\Middleware;

use Beike\Models\Customer;
use Beike\Models\JumpUrl;
use Beike\Models\JumpUrlCounterDetail;
use Beike\Models\JumpUrlDetail;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Jump extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param string[] ...$guards
     * @return mixed
     *
     * @throws AuthenticationException
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        $path = '/index.php/' . $request->path() . '/';

        $ip = $request->getClientIp();

        $jump_url = JumpUrl::whereRaw("url = '{$path}'")->with(['toUrls', 'toUrlVisitor'])->first();
        if ($jump_url) {

            $visitor = $jump_url->toUrlVisitor->visitorTotal;

            $jump_to_urls = $jump_url->toUrls->count();
            $visitor = $visitor + 1;
            $index = $this->_visitor_index($visitor, $jump_to_urls);

            $index = $index - 1;
            $to_url = $jump_url->toUrls[$index];
            $to_url->update([
                'visitor' => $to_url->visitor + 1,
                'visitor_time' => date('Y-m-d H:i:s')
            ]);

            $day = date('Y-m-d');
            $counter = JumpUrlCounterDetail::where('page_id', $jump_url->id)
                ->where('url_id', $to_url->id)
                ->where('visitor_day', $day)
                ->where('ip', $ip)
                ->first();

            if (!$counter) {
                JumpUrlCounterDetail::create([
                    'url_id' => $to_url->id,
                    'page_id' => $jump_url->id,
                    'visitor' => 1,
                    'visitor_day' => $day,
                    'ip' => $ip,
                    'to_url' => $to_url->to_url,
                ]);
            }else{
                $counter->update([
                    'visitor' => $counter->visitor + 1,
                    'visitor_day' => $day,
                ]);
            }
            return redirect($to_url->to_url, 301);
        }

        return $next($request);
    }

    private function _visitor_index($visitor, $page_count)
    {
        if ($visitor == $page_count) {
            return $page_count;
        }

        if ($visitor > $page_count) {
            $page = intval($visitor / $page_count) * $page_count;
            if ($page == $visitor) {
                return $page_count;
            }

            return $visitor - $page;
        }

        return $visitor;
    }
}
