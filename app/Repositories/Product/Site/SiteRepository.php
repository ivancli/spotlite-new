<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/5/2016
 * Time: 4:07 PM
 */

namespace App\Repositories\Product\Site;


use App\Contracts\Repository\Product\Site\SiteContract;
use App\Filters\QueryFilter;
use App\Libraries\CommonFunctions;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteRepository implements SiteContract
{
    use CommonFunctions;

    protected $site;
    protected $request;

    public function __construct(Request $request, Site $site)
    {
        $this->site = $site;
        $this->request = $request;
    }

    public function getSites()
    {
        $sites = Site::all();
        return $sites;
    }

    public function getSite($id)
    {
        $site = Site::findOrFail($id);
        return $site;
    }

    public function getSiteByColumn($column, $value)
    {
        $sites = Site::where($column, $value)->get();
        return $sites;
    }

    public function createSite($options)
    {
        $options['site_url'] = $this->removeGlobalWebTracking($options['site_url']);
        $site = Site::create($options);
        return $site;
    }

    public function updateSite($id, $options)
    {
        if(isset($options['site_url'])){
            $options['site_url'] = $this->removeGlobalWebTracking($options['site_url']);
        }
        $site = $this->getSite($id);
        $site->update($options);
        return $site;
    }

    public function deleteSite($id)
    {
        $site = $this->getSite($id);
        $site->delete();
        return true;
    }

    public function getSiteCount()
    {
        return $this->site->count();
    }

    public function getDataTablesSites(QueryFilter $queryFilter)
    {
        $sites = $this->site->with("crawler")->with("preference")->filter($queryFilter)->get();
        $output = new \stdClass();
        $output->draw = $this->request->has('draw') ? intval($this->request->get('draw')) : 0;
        $output->recordTotal = $this->getSiteCount();
        if ($this->request->has('search') && $this->request->get('search')['value'] != '') {
            $output->recordsFiltered = $sites->count();
        } else {
            $output->recordsFiltered = $this->getSiteCount();
        }
        $output->data = $sites->toArray();
        return $output;
    }

    public function adoptPreferences($site_id, $target_site_id)
    {
        $site = $this->getSite($site_id);
        $targetSite = $this->getSite($target_site_id);

        $preference = $site->preference;

        $targetPreference = $targetSite->preference;

        $preference->xpath_1 = $targetPreference->xpath_1;
        $preference->xpath_2 = $targetPreference->xpath_2;
        $preference->xpath_3 = $targetPreference->xpath_3;
        $preference->xpath_4 = $targetPreference->xpath_4;
        $preference->xpath_5 = $targetPreference->xpath_5;
        $preference->save();
    }

    public function clearPreferences($site_id)
    {
        $site = $this->getSite($site_id);
        $preference = $site->preference;
        $preference->xpath_1 = null;
        $preference->xpath_2 = null;
        $preference->xpath_3 = null;
        $preference->xpath_4 = null;
        $preference->xpath_5 = null;
        $preference->save();
    }
}